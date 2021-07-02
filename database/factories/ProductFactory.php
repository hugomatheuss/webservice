<?php

namespace Database\Factories;

use App\Models\Product;
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
            'title' => $this->faker->word(),
            'type' => $this->faker->word(),
            'description' => $this->faker->paragraph(),
            'filename' => $this->faker->image('storage/app/images', 400, 300, null, false),
            'height' => $this->faker->randomDigit(),
            'width' => $this->faker->randomDigit(),
            'price' => $this->faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = NULL),
            'rating' => $this->faker->randomDigit(),
        ];
    }
}