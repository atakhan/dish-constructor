<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Ingredient;
use App\Models\IngredientType;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Ingredient types
        IngredientType::factory()->create([
            'title' => 'Тесто',
            'code' => 'd',
        ]);
        IngredientType::factory()->create([
            'title' => 'Сыр',
            'code' => 'c',
        ]);
        IngredientType::factory()->create([
            'title' => 'Начинка',
            'code' => 'i',
        ]);

        // Ingredients
        Ingredient::factory()->create([
            'type_id' => 1,
            'title'   => 'Тонкое тесто', 
            'price'   => 100.00
        ]);
        Ingredient::factory()->create([
            'type_id' => 1,
            'title'   => 'Пышное тесто', 
            'price'   => 110.00
        ]);
        Ingredient::factory()->create([
            'type_id' => 1,
            'title'   => 'Ржаное тесто', 
            'price'   => 150.00
        ]);
        Ingredient::factory()->create([
            'type_id' => 2,
            'title'   => 'Моцарелла', 
            'price'   => 50.00
        ]);
        Ingredient::factory()->create([
            'type_id' => 2,
            'title'   => 'Рикотта', 
            'price'   => 70.00
        ]);
        Ingredient::factory()->create([
            'type_id' => 3,
            'title'   => 'Колбаса', 
            'price'   => 30.00
        ]);
        Ingredient::factory()->create([
            'type_id' => 3,
            'title'   => 'Ветчина', 
            'price'   => 35.00
        ]);
        Ingredient::factory()->create([
            'type_id' => 3,
            'title'   => 'Грибы', 
            'price'   => 50.00
        ]);
        Ingredient::factory()->create([
            'type_id' => 3,
            'title'   => 'Томаты', 
            'price'   => 10.00
        ]);
    }
}
