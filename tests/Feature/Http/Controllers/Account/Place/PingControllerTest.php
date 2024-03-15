<?php

namespace Tests\Feature\Http\Controllers\Account\Place;

use App\Models\Ping;
use App\Models\Place;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Account\Place\PingController
 */
final class PingControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $pings = Ping::factory()->count(3)->create();

        $response = $this->get(route('pings.index'));

        $response->assertOk();
        $response->assertViewIs('ping.index');
        $response->assertViewHas('pings');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('pings.create'));

        $response->assertOk();
        $response->assertViewIs('ping.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Account\Place\PingController::class,
            'store',
            \App\Http\Requests\Account\Place\PingStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $place = Place::factory()->create();
        $date_start = Carbon::parse($this->faker->dateTime());

        $response = $this->post(route('pings.store'), [
            'place_id' => $place->id,
            'date_start' => $date_start->toDateTimeString(),
        ]);

        $pings = Ping::query()
            ->where('place_id', $place->id)
            ->where('date_start', $date_start)
            ->get();
        $this->assertCount(1, $pings);
        $ping = $pings->first();

        $response->assertRedirect(route('pings.index'));
        $response->assertSessionHas('ping.id', $ping->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $ping = Ping::factory()->create();

        $response = $this->get(route('pings.show', $ping));

        $response->assertOk();
        $response->assertViewIs('ping.show');
        $response->assertViewHas('ping');
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $ping = Ping::factory()->create();

        $response = $this->get(route('pings.edit', $ping));

        $response->assertOk();
        $response->assertViewIs('ping.edit');
        $response->assertViewHas('ping');
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Account\Place\PingController::class,
            'update',
            \App\Http\Requests\Account\Place\PingUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $ping = Ping::factory()->create();
        $place = Place::factory()->create();
        $date_start = Carbon::parse($this->faker->dateTime());

        $response = $this->put(route('pings.update', $ping), [
            'place_id' => $place->id,
            'date_start' => $date_start->toDateTimeString(),
        ]);

        $ping->refresh();

        $response->assertRedirect(route('pings.index'));
        $response->assertSessionHas('ping.id', $ping->id);

        $this->assertEquals($place->id, $ping->place_id);
        $this->assertEquals($date_start, $ping->date_start);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $ping = Ping::factory()->create();

        $response = $this->delete(route('pings.destroy', $ping));

        $response->assertRedirect(route('pings.index'));

        $this->assertModelMissing($ping);
    }
}
