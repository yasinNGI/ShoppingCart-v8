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
        $title = $this->faker->company.' Product';
        return [
            'title'       => $title,
            'slug'        => str_replace( ' ' , '-' , strtolower( $title ) ),
            'description' => $this->faker->paragraph,
            'image'       => null,
            'price'       => $this->faker->numberBetween(30,1500),
            'status'      => 1,
        ];
    }
}
