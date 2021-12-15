<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Car::factory(2)->create()->each(function ($car) {
            \App\Models\CarColor::create([
                'car_id' => $car->id,
                'color_id' => \App\Models\Color::factory()->create()->id,
            ]);
        });
    }
}
