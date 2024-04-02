<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\MenuCategory;
use App\Models\place;

class MenuCategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MenuCategory::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'place_id' => place::factory(),
            'name' => $this->faker->name(),
            'position' => $this->faker->numberBetween(-10000, 10000),
        ];
    }
}
