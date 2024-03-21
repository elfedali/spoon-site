<?php

namespace Tests\Feature\Http\Controllers\Account;

use App\Models\City;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Account\CityController
 */
final class CityControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $cities = City::factory()->count(3)->create();

        $response = $this->get(route('cities.index'));

        $response->assertOk();
        $response->assertViewIs('city.index');
        $response->assertViewHas('cities');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('cities.create'));

        $response->assertOk();
        $response->assertViewIs('city.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Account\CityController::class,
            'store',
            \App\Http\CityStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $name = $this->faker->name();
        $slug = $this->faker->slug();
        $is_active = $this->faker->boolean();

        $response = $this->post(route('cities.store'), [
            'name' => $name,
            'slug' => $slug,
            'is_active' => $is_active,
        ]);

        $cities = City::query()
            ->where('name', $name)
            ->where('slug', $slug)
            ->where('is_active', $is_active)
            ->get();
        $this->assertCount(1, $cities);
        $city = $cities->first();

        $response->assertRedirect(route('cities.index'));
        $response->assertSessionHas('city.id', $city->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $city = City::factory()->create();

        $response = $this->get(route('cities.show', $city));

        $response->assertOk();
        $response->assertViewIs('city.show');
        $response->assertViewHas('city');
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $city = City::factory()->create();

        $response = $this->get(route('cities.edit', $city));

        $response->assertOk();
        $response->assertViewIs('city.edit');
        $response->assertViewHas('city');
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Account\CityController::class,
            'update',
            \App\Http\CityUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $city = City::factory()->create();
        $name = $this->faker->name();
        $slug = $this->faker->slug();
        $is_active = $this->faker->boolean();

        $response = $this->put(route('cities.update', $city), [
            'name' => $name,
            'slug' => $slug,
            'is_active' => $is_active,
        ]);

        $city->refresh();

        $response->assertRedirect(route('cities.index'));
        $response->assertSessionHas('city.id', $city->id);

        $this->assertEquals($name, $city->name);
        $this->assertEquals($slug, $city->slug);
        $this->assertEquals($is_active, $city->is_active);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $city = City::factory()->create();

        $response = $this->delete(route('cities.destroy', $city));

        $response->assertRedirect(route('cities.index'));

        $this->assertModelMissing($city);
    }
}
