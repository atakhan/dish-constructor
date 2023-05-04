<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'type_id', 'title', 'price',
    ];

    public function ingredientType()
    {
        return $this->belongsTo(IngredientType::class, 'foreign_key');
    }
}
