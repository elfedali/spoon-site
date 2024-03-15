<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Place;
use App\Models\Street;
use App\Models\User;

class PlaceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Place::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'owner_id' => User::factory(),
            'approver_id' => User::factory(),
            'place_type' => $this->faker->word(),
            'street_id' => Street::factory(),
            'name' => $this->faker->name(),
            'slug' => $this->faker->slug(),
            'address' => $this->faker->word(),
            'email' => $this->faker->safeEmail(),
            'website' => $this->faker->word(),
            'description' => $this->faker->text(),
            'excerpt' => $this->faker->text(),
            'type_cuisine' => $this->faker->word(),
            'type_service' => $this->faker->word(),
            'type_amenity' => $this->faker->word(),
            'position' => $this->faker->numberBetween(-10000, 10000),
            'status' => $this->faker->word(),
            'reservation_required' => $this->faker->boolean(),
        ];
    }
}
