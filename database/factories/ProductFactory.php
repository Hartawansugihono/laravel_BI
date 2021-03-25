<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'product_category_id' => ProductCategory::factory()->create(),
            'name' => $this->faker->name,
            'price' => $this->faker->randomDigit,
            'amount' => $this->faker->randomDigit,
            'qty' => $this->faker->randomDigit
        ];
    }
}
