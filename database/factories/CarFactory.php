<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => 'car ' . Str::random(5),
            'manufacturer_id' => function() {
                return \App\Models\Manufacturer::factory()->create()->id;
            },
            'type_id' => function() {
                return \App\Models\Type::factory()->create()->id;
            },
        ];
    }
}
