<?php

namespace App\Services;

use App\Models\Ingredient;
use App\Models\IngredientType;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MakeCombinationsService
{
    protected $template;

    public function __construct($template)
    {
        $this->template = str_split($template);
    }

    /**
     *  АЛГОРИТМ:
     *      0. На вход подается строка-шаблон из кодов
     *      1. Выборка типов и ингридиентов из БД
     *      2. Преобразуем шаблон-строку в шаблон-массив из id типов
     *      3. Собираем для каждого шаблона массив ингредиентов
     *      4. Находим всевозможные комбинации
     *      5. Удаляем значения-дубликаты
     *      6. Удаляем массивы-дубликаты
     *      7. Форматируем в нужную структуру
     *      8. Выдаем результат
     * 
     * 
     */
    public function run() : mixed
    {
        $types               = collect(IngredientType::get()->toArray())->keyBy('code');
        $types_keyby_id      = collect(IngredientType::get()->toArray())->keyBy('id');
        $ingredients         = collect(Ingredient::get()->toArray())->keyBy('id');

        $types_by_template       = $this->getTypesByCode($types);
        $ingridients_by_template = $this->getIngridientsByCode($types_by_template, $ingredients);
        
        $combinations            = $this->combinations($ingridients_by_template);
        $unique_val_combinations = $this->removeDublicateValues($combinations);
        $unique_arr_combinations = $this->removeDublicateArrays($unique_val_combinations);

        return $this->makeRecipes($unique_arr_combinations, $types_keyby_id, $ingredients);
    }

    protected function getTypesByCode($types)
    {
        $result = [];
        foreach ($this->template as $code) {
            if ($types[$code]) {
                $result[] = $types[$code]['id'];
            }
        }
        return $result;
    }

    protected function getIngridientsByCode($types_by_code, $ingredients)
    {
        $result = [];
        foreach ($types_by_code as $key => $type_id) {
            foreach ($ingredients as $ingredient) {
                if ($type_id === $ingredient['type_id']) {
                    $result[$key][] = $ingredient['id'];
                }
            }
        }
        return $result;
    }

    protected function combinations($arrays, $i = 0)
    {
        if (!isset($arrays[$i]))
            return array();

        if ($i == count($arrays) - 1)
            return $arrays[$i];
      
        $tmp = $this->combinations($arrays, $i + 1);
      
        $result = array();
      
        foreach ($arrays[$i] as $v) {
            foreach ($tmp as $t) {
                $result[] = is_array($t) 
                    ? array_merge(array($v), $t) 
                    : array($v, $t);
            }
        }
      
        return $result;
    }

    protected function removeDublicateValues($combinations)
    {
        $result = [];
        foreach ($combinations as $combination) {
            if (count($combination) !== count(array_unique($combination))) {
                continue;
            }
            $result[] = $combination;
        }
        return $result;
    }

    protected function removeDublicateArrays($combinations)
    {
        $tmp = [];
        foreach ($combinations as $key => $combination) {
            sort($combination);
            $tmp[$key] = implode(",", $combination);
        }
        $tmp = array_unique($tmp);
        $result = [];
        foreach ($tmp as $key => $value) {
            $result[$key] = explode(",", $value);
        }
        return $result;
    }

    protected function makeRecipes($combinations, $types, $ingredients)
    {
        $result = [];
        foreach ($combinations as $i => $combination) {
            $price = 0;
            foreach ($combination as $k => $ingredient_id) {
                $ingredient = $ingredients[$ingredient_id];
                $result[$i]['products'][$k]['type'] = $types[$ingredient['type_id']]['title'];
                $result[$i]['products'][$k]['value'] = $ingredient['title'];
                $price += $ingredient['price'];
            }
            $result[$i]['price'] = $price;
        }
        return $result;
    }
}
