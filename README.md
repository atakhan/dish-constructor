# Установка и запуск

1. Clone project
    ``` 
    git clone git@github.com:atakhan/dish-constructor.git
    ```
2. Go to project folder
    ``` 
    cd dish-constructor 
    ```
3. Install composer packages
    ``` 
    composer install 
    ``` 
    or 
    ``` 
    composer update
    ```
4. Create env
    ```
    ./vendor/bin/sail up -d
    ```
5. Run tests
    ```
    phpunit
    ```
<br>
<br>

# Time tracking
|Time| Actions |
|-------|-------|
| 21:20 | Start |
| 21:20 - 21:57 | Choosing stack. Choosed Laravel |
| 21:59 - 22:16 | Installed docker, laravel   |
| 22:20 - 23:23 | Make app carcas (migrations, seeds, models, routes, controller) |
| -- | <i>breaktime</i> |
| 05:05 - 06:12 |  Start work on base algorithm |
| 06:13 - 06:50 |  Make endpoints for ingredient_types, ingredients, and constructor. Added Tests. |
| 06:50 - 07:15 |  Added tests for combinations. Refactored |
| -- | <i>breaktime</i> |
| 08:00 - 08:25 |  Added Readme  |

<br>
<br>

# ТЗ
Необходимо разработать простой конструктор блюд

В приложенном архиве дамп базы данных, содержащий исходные данные для конструктора. 

В базе содержится две таблицы

- В таблице ingredient_type содержатся типы возможных ингредиентов. Каждому типу соответствует уникальный 1-буквенный код

- В таблице ingredient хранятся конкретные ингредиенты с ценой

На вход конструктора поступает строка, содержащая 
коды ингредиентов, которые должны входит в полученное блюдо. 

Один ингредиент может быть указан несколько раз. 
Например, строка «dcciii» означает блюдо, состоящее 
из одного теста, двух видов сыра и трёх видов начинки.

Необходимо сформировать набор всех возможных комбинаций ингредиентов, 
соответствующих заданному шаблону. 
При этом один ингредиент не может встречаться в блюде дважды.

Результатом работу конструктора должен быть JSON-массив, 
содержащий все возможные комбинации. 

Пример вывода для входной строки "dcii":
```
[
	{
        “products”: [
            {“type”:”Тесто”,”value”:”Тонкое тесто”},
            {“type”:”Сыр”,”value”:”Моцарелла”},
            {“type”:”Начинка”,”value”:”Ветчина”},
            {“type”:”Начинка”,”value”:”Колбаса”},
        ],
        “price”: 215
    },
    {
        “products”: [
            {“type”:”Тесто”,”value”:”Тонкое тесто”},
            {“type”:”Сыр”,”value”:”Моцарелла”},
            {“type”:”Начинка”,”value”:”Ветчина”},
            {“type”:”Начинка”,”value”:” Грибы”},
        ],
        “price”: 235
    },
    ...,
]
```

Конструктор может быть реализован в виде REST-API 
или в виде консольного приложения. 

Платформа для реализации также выбирается на усмотрение соискателя. <br><br><br>

