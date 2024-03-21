<?php

namespace Tests\Feature\Http\Controllers\Account;

use App\Models\City;
use App\Models\Street;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Account\StreetController
 */
final class StreetControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $streets = Street::factory()->count(3)->create();

        $response = $this->get(route('streets.index'));

        $response->assertOk();
        $response->assertViewIs('street.index');
        $response->assertViewHas('streets');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('streets.create'));

        $response->assertOk();
        $response->assertViewIs('street.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Account\StreetController::class,
            'store',
            \App\Http\StreetStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $city = City::factory()->create();
        $name = $this->faker->name();
        $slug = $this->faker->slug();
        $is_active = $this->faker->boolean();

        $response = $this->post(route('streets.store'), [
            'city_id' => $city->id,
            'name' => $name,
            'slug' => $slug,
            'is_active' => $is_active,
        ]);

        $streets = Street::query()
            ->where('city_id', $city->id)
            ->where('name', $name)
            ->where('slug', $slug)
            ->where('is_active', $is_active)
            ->get();
        $this->assertCount(1, $streets);
        $street = $streets->first();

        $response->assertRedirect(route('streets.index'));
        $response->assertSessionHas('street.id', $street->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $street = Street::factory()->create();

        $response = $this->get(route('streets.show', $street));

        $response->assertOk();
        $response->assertViewIs('street.show');
        $response->assertViewHas('street');
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $street = Street::factory()->create();

        $response = $this->get(route('streets.edit', $street));

        $response->assertOk();
        $response->assertViewIs('street.edit');
        $response->assertViewHas('street');
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Account\StreetController::class,
            'update',
            \App\Http\StreetUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $street = Street::factory()->create();
        $city = City::factory()->create();
        $name = $this->faker->name();
        $slug = $this->faker->slug();
        $is_active = $this->faker->boolean();

        $response = $this->put(route('streets.update', $street), [
            'city_id' => $city->id,
            'name' => $name,
            'slug' => $slug,
            'is_active' => $is_active,
        ]);

        $street->refresh();

        $response->assertRedirect(route('streets.index'));
        $response->assertSessionHas('street.id', $street->id);

        $this->assertEquals($city->id, $street->city_id);
        $this->assertEquals($name, $street->name);
        $this->assertEquals($slug, $street->slug);
        $this->assertEquals($is_active, $street->is_active);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $street = Street::factory()->create();

        $response = $this->delete(route('streets.destroy', $street));

        $response->assertRedirect(route('streets.index'));

        $this->assertModelMissing($street);
    }
}
