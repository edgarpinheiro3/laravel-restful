<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

   /*
     $factory->define(Product::class, function (Faker $faker) {
        return [
            'name' => $faker->word,
            'description' => $faker->sentence(),
        ];
    });
    */

    class ProductFactory extends Factory
    {
        /**
         * Define the model's default state.
         *
         * @return array<string, mixed>
         */
        public function definition()
        {
            return [
                'name' => fake()->word(),
                'description' => fake()->sentence(),
            ];
        }

    }



