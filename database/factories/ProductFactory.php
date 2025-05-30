<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            
            'name'=>$this->faker->name(),
            'price'=>$this->faker->randomFloat(2,1,100),
            'description'=>$this->faker->sentence(),
            'image'=>$this->faker->imageUrl(640, 480, 'products', true),
            'user_id'=>1,
            'category_id'=>1,
            'created_at'=>$this->faker->dateTime(),
            'updated_at'=>$this->faker->dateTime(),
        ];
    }
}
