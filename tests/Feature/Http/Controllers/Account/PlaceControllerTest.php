<?php

namespace Tests\Feature\Http\Controllers\Account;

use App\Models\Owner;
use App\Models\Place;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Account\PlaceController
 */
final class PlaceControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $places = Place::factory()->count(3)->create();

        $response = $this->get(route('places.index'));

        $response->assertOk();
        $response->assertViewIs('place.index');
        $response->assertViewHas('places');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('places.create'));

        $response->assertOk();
        $response->assertViewIs('place.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Account\PlaceController::class,
            'store',
            \App\Http\Requests\Account\PlaceStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $owner = Owner::factory()->create();
        $place_type = $this->faker->word();
        $name = $this->faker->name();
        $slug = $this->faker->slug();
        $position = $this->faker->numberBetween(-10000, 10000);
        $status = $this->faker->word();
        $reservation_required = $this->faker->boolean();

        $response = $this->post(route('places.store'), [
            'owner_id' => $owner->id,
            'place_type' => $place_type,
            'name' => $name,
            'slug' => $slug,
            'position' => $position,
            'status' => $status,
            'reservation_required' => $reservation_required,
        ]);

        $places = Place::query()
            ->where('owner_id', $owner->id)
            ->where('place_type', $place_type)
            ->where('name', $name)
            ->where('slug', $slug)
            ->where('position', $position)
            ->where('status', $status)
            ->where('reservation_required', $reservation_required)
            ->get();
        $this->assertCount(1, $places);
        $place = $places->first();

        $response->assertRedirect(route('places.index'));
        $response->assertSessionHas('place.id', $place->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $place = Place::factory()->create();

        $response = $this->get(route('places.show', $place));

        $response->assertOk();
        $response->assertViewIs('place.show');
        $response->assertViewHas('place');
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $place = Place::factory()->create();

        $response = $this->get(route('places.edit', $place));

        $response->assertOk();
        $response->assertViewIs('place.edit');
        $response->assertViewHas('place');
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Account\PlaceController::class,
            'update',
            \App\Http\Requests\Account\PlaceUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $place = Place::factory()->create();
        $owner = Owner::factory()->create();
        $place_type = $this->faker->word();
        $name = $this->faker->name();
        $slug = $this->faker->slug();
        $position = $this->faker->numberBetween(-10000, 10000);
        $status = $this->faker->word();
        $reservation_required = $this->faker->boolean();

        $response = $this->put(route('places.update', $place), [
            'owner_id' => $owner->id,
            'place_type' => $place_type,
            'name' => $name,
            'slug' => $slug,
            'position' => $position,
            'status' => $status,
            'reservation_required' => $reservation_required,
        ]);

        $place->refresh();

        $response->assertRedirect(route('places.index'));
        $response->assertSessionHas('place.id', $place->id);

        $this->assertEquals($owner->id, $place->owner_id);
        $this->assertEquals($place_type, $place->place_type);
        $this->assertEquals($name, $place->name);
        $this->assertEquals($slug, $place->slug);
        $this->assertEquals($position, $place->position);
        $this->assertEquals($status, $place->status);
        $this->assertEquals($reservation_required, $place->reservation_required);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $place = Place::factory()->create();

        $response = $this->delete(route('places.destroy', $place));

        $response->assertRedirect(route('places.index'));

        $this->assertModelMissing($place);
    }
}
