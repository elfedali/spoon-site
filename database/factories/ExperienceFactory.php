<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Experience;
use App\Models\Place;

class ExperienceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Experience::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'place_id' => Place::factory(),
            'date_start' => $this->faker->dateTime(),
            'date_end' => $this->faker->dateTime(),
            'description' => $this->faker->text(),
        ];
    }
}
