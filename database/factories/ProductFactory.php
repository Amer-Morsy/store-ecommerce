<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;


class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->text(60),
            'description' => $this->faker->paragraph(),
            'price' => $this->faker->numberBetween(10, 9000),
            'manage_stock' => false,
            'in_stock' => $this->faker->boolean(),
            'slug' => $this->faker->slug(),
            'sku' => $this->faker->word(),
            'is_active' => $this->faker->boolean(),
        ];
    }
}
