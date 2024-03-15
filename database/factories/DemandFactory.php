<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Demand;
use App\Models\User;

class DemandFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Demand::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'approver_id' => User::factory(),
            'date_start' => $this->faker->dateTime(),
            'date_end' => $this->faker->dateTime(),
            'description' => $this->faker->text(),
            'status' => $this->faker->word(),
        ];
    }
}
