<?php

namespace Tests\Feature\Http\Controllers\Account\Place;

use App\Models\OpeningHour;
use App\Models\Place;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Account\Place\OpeningHourController
 */
final class OpeningHourControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $openingHours = OpeningHour::factory()->count(3)->create();

        $response = $this->get(route('opening-hours.index'));

        $response->assertOk();
        $response->assertViewIs('openingHour.index');
        $response->assertViewHas('openingHours');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('opening-hours.create'));

        $response->assertOk();
        $response->assertViewIs('openingHour.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Account\Place\OpeningHourController::class,
            'store',
            \App\Http\Place\OpeningHourStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $place = Place::factory()->create();
        $day = $this->faker->word();

        $response = $this->post(route('opening-hours.store'), [
            'place_id' => $place->id,
            'day' => $day,
        ]);

        $openingHours = OpeningHour::query()
            ->where('place_id', $place->id)
            ->where('day', $day)
            ->get();
        $this->assertCount(1, $openingHours);
        $openingHour = $openingHours->first();

        $response->assertRedirect(route('openingHours.index'));
        $response->assertSessionHas('openingHour.id', $openingHour->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $openingHour = OpeningHour::factory()->create();

        $response = $this->get(route('opening-hours.show', $openingHour));

        $response->assertOk();
        $response->assertViewIs('openingHour.show');
        $response->assertViewHas('openingHour');
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $openingHour = OpeningHour::factory()->create();

        $response = $this->get(route('opening-hours.edit', $openingHour));

        $response->assertOk();
        $response->assertViewIs('openingHour.edit');
        $response->assertViewHas('openingHour');
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Account\Place\OpeningHourController::class,
            'update',
            \App\Http\Place\OpeningHourUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $openingHour = OpeningHour::factory()->create();
        $place = Place::factory()->create();
        $day = $this->faker->word();

        $response = $this->put(route('opening-hours.update', $openingHour), [
            'place_id' => $place->id,
            'day' => $day,
        ]);

        $openingHour->refresh();

        $response->assertRedirect(route('openingHours.index'));
        $response->assertSessionHas('openingHour.id', $openingHour->id);

        $this->assertEquals($place->id, $openingHour->place_id);
        $this->assertEquals($day, $openingHour->day);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $openingHour = OpeningHour::factory()->create();

        $response = $this->delete(route('opening-hours.destroy', $openingHour));

        $response->assertRedirect(route('openingHours.index'));

        $this->assertModelMissing($openingHour);
    }
}
