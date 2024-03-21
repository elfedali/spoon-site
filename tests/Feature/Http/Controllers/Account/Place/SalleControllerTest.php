<?php

namespace Tests\Feature\Http\Controllers\Account\Place;

use App\Models\Restaurant;
use App\Models\Salle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Account\Place\SalleController
 */
final class SalleControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $salles = Salle::factory()->count(3)->create();

        $response = $this->get(route('salles.index'));

        $response->assertOk();
        $response->assertViewIs('salle.index');
        $response->assertViewHas('salles');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('salles.create'));

        $response->assertOk();
        $response->assertViewIs('salle.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Account\Place\SalleController::class,
            'store',
            \App\Http\Place\SalleStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $restaurant = Restaurant::factory()->create();
        $name = $this->faker->name();
        $description = $this->faker->text();

        $response = $this->post(route('salles.store'), [
            'restaurant_id' => $restaurant->id,
            'name' => $name,
            'description' => $description,
        ]);

        $salles = Salle::query()
            ->where('restaurant_id', $restaurant->id)
            ->where('name', $name)
            ->where('description', $description)
            ->get();
        $this->assertCount(1, $salles);
        $salle = $salles->first();

        $response->assertRedirect(route('salles.index'));
        $response->assertSessionHas('salle.id', $salle->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $salle = Salle::factory()->create();

        $response = $this->get(route('salles.show', $salle));

        $response->assertOk();
        $response->assertViewIs('salle.show');
        $response->assertViewHas('salle');
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $salle = Salle::factory()->create();

        $response = $this->get(route('salles.edit', $salle));

        $response->assertOk();
        $response->assertViewIs('salle.edit');
        $response->assertViewHas('salle');
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Account\Place\SalleController::class,
            'update',
            \App\Http\Place\SalleUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $salle = Salle::factory()->create();
        $restaurant = Restaurant::factory()->create();
        $name = $this->faker->name();
        $description = $this->faker->text();

        $response = $this->put(route('salles.update', $salle), [
            'restaurant_id' => $restaurant->id,
            'name' => $name,
            'description' => $description,
        ]);

        $salle->refresh();

        $response->assertRedirect(route('salles.index'));
        $response->assertSessionHas('salle.id', $salle->id);

        $this->assertEquals($restaurant->id, $salle->restaurant_id);
        $this->assertEquals($name, $salle->name);
        $this->assertEquals($description, $salle->description);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $salle = Salle::factory()->create();

        $response = $this->delete(route('salles.destroy', $salle));

        $response->assertRedirect(route('salles.index'));

        $this->assertModelMissing($salle);
    }
}
