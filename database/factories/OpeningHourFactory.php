<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\OpeningHour;
use App\Models\Place;

class OpeningHourFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OpeningHour::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'place_id' => Place::factory(),
            'day' => $this->faker->word(),
            'open' => $this->faker->time(),
            'close' => $this->faker->time(),
        ];
    }
}
