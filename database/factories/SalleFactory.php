<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\place;
use App\Models\Salle;

class SalleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Salle::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'place_id' => place::factory(),
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),
            'capacity' => $this->faker->numberBetween(-10000, 10000),
        ];
    }
}
