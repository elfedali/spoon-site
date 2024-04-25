<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Place;
use App\Models\Street;
use App\Models\User;
use Spatie\Permission\Models\Role;

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

        // Get users with the "Manager" role
        $managerRole = Role::where('name', 'Manager')->first();
        $managerUsers = $managerRole->users;

        // Randomly select one user as owner and another as approver
        $owner = $managerUsers->random();
        $approver = $managerUsers->random();

        return [
            'owner_id' => $owner->id,
            'approver_id' => $approver->id,
            'place_type' => $this->faker->word(),
            'street_id' => Street::factory(),
            'title' => $title = $this->faker->sentence(4),
            'slug' => Str::slug($title) . '_' . Str::random(10),
            'address' => $this->faker->address(),
            'email' => $this->faker->safeEmail(),
            'website' => $this->faker->word(),
            'description' => $this->faker->text(),
            'excerpt' => $this->faker->text(),
            'type_cuisine' => $this->faker->word(),
            'type_service' => $this->faker->word(),
            'type_amenity' => $this->faker->word(),
            'status' => $this->faker->randomElement(['draft', 'published']),
            'reservation_required' => $this->faker->boolean(),
        ];
    }
}
