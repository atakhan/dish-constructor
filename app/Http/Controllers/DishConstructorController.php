<?php

namespace App\Http\Controllers;

use App\Services\MakeCombinationsService;
use App\Models\Ingredient;
use App\Models\IngredientType;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DishConstructorController extends Controller
{
    /**
     * List of Ingredient types and Ingredients
     */
    public function index()
    {
        return new JsonResponse([
            'ingredient_types' => IngredientType::get()->toArray(),
            'ingredients' => Ingredient::get()->toArray()
        ], 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function getIngredientTypes()
    {
        return new JsonResponse(
            IngredientType::get()->toArray(), 
            200, [], JSON_UNESCAPED_UNICODE
        );
    }

    public function getIngredients()
    {
        return new JsonResponse(
            Ingredient::get()->toArray(), 
            200, [], JSON_UNESCAPED_UNICODE);
    }

    public function makeCombinations(Request $request, $code)
    {
        return new JsonResponse(
            (new MakeCombinationsService($code))->run(),
            200, [], JSON_UNESCAPED_UNICODE);
    }
}
