<?php

namespace Database\Factories;

use App\Models\V1\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;
    
    public function definition()
    {
        return [
            'name'          => $this->faker->name,
            'description'   => $this->faker->text(200)
        ];
    }
}
