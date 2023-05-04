<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Ingredient;
use App\Models\IngredientType;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class DishConstructorTest extends TestCase
{
    protected $makeRequest;

    public function setUp() :void
    {
        parent::setUp();

        Artisan::call('migrate:refresh');
        Artisan::call('db:seed');

        $user = User::factory()->create();
 
        $this->makeRequest = $this
            ->actingAs($user)
            ->withSession(['banned' => false]);
    }

    public function test_index(): void
    {
        $ingredientTypes = IngredientType::all();
        $ingredients = Ingredient::all();
        $this->makeRequest->get('/api')
            ->assertStatus(200)
            ->assertJson([
                'ingredient_types' => $ingredientTypes->toArray(),
                'ingredients' => $ingredients->toArray()
            ]);
    }

    public function test_ingredient_types(): void
    {
        $ingredientTypes = IngredientType::all();
        $this->makeRequest->get('/api/ingredient_types')
            ->assertStatus(200)
            ->assertJson($ingredientTypes->toArray());
    }

    public function test_ingredients(): void
    {
        $ingredients = Ingredient::all();
        $this->makeRequest->get('/api/ingredients')
            ->assertStatus(200)
            ->assertJson($ingredients->toArray());
    }

    public function test_make_combinations(): void
    {
        $response = $this->makeRequest->get('/api/constructor/dci')
            ->assertStatus(200)
            ->assertJsonCount(24);
    }

    public function test_make_combinations2(): void
    {
        $response = $this->makeRequest->get('/api/constructor/dc')
            ->assertStatus(200)
            ->assertJsonCount(6);
        // dd($response->json());
    }
}
