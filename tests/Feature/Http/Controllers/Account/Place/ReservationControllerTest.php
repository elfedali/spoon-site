<?php

namespace Tests\Feature\Http\Controllers\Account\Place;

use App\Models\Client;
use App\Models\Reservation;
use App\Models\Table;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Account\Place\ReservationController
 */
final class ReservationControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $reservations = Reservation::factory()->count(3)->create();

        $response = $this->get(route('reservations.index'));

        $response->assertOk();
        $response->assertViewIs('reservation.index');
        $response->assertViewHas('reservations');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('reservations.create'));

        $response->assertOk();
        $response->assertViewIs('reservation.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Account\Place\ReservationController::class,
            'store',
            \App\Http\Requests\Account\Place\ReservationStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $table = Table::factory()->create();
        $client = Client::factory()->create();
        $arrival_date = Carbon::parse($this->faker->dateTime());
        $status = $this->faker->randomElement(/** enum_attributes **/);

        $response = $this->post(route('reservations.store'), [
            'table_id' => $table->id,
            'client_id' => $client->id,
            'arrival_date' => $arrival_date->toDateTimeString(),
            'status' => $status,
        ]);

        $reservations = Reservation::query()
            ->where('table_id', $table->id)
            ->where('client_id', $client->id)
            ->where('arrival_date', $arrival_date)
            ->where('status', $status)
            ->get();
        $this->assertCount(1, $reservations);
        $reservation = $reservations->first();

        $response->assertRedirect(route('reservations.index'));
        $response->assertSessionHas('reservation.id', $reservation->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $reservation = Reservation::factory()->create();

        $response = $this->get(route('reservations.show', $reservation));

        $response->assertOk();
        $response->assertViewIs('reservation.show');
        $response->assertViewHas('reservation');
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $reservation = Reservation::factory()->create();

        $response = $this->get(route('reservations.edit', $reservation));

        $response->assertOk();
        $response->assertViewIs('reservation.edit');
        $response->assertViewHas('reservation');
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Account\Place\ReservationController::class,
            'update',
            \App\Http\Requests\Account\Place\ReservationUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $reservation = Reservation::factory()->create();
        $table = Table::factory()->create();
        $client = Client::factory()->create();
        $arrival_date = Carbon::parse($this->faker->dateTime());
        $status = $this->faker->randomElement(/** enum_attributes **/);

        $response = $this->put(route('reservations.update', $reservation), [
            'table_id' => $table->id,
            'client_id' => $client->id,
            'arrival_date' => $arrival_date->toDateTimeString(),
            'status' => $status,
        ]);

        $reservation->refresh();

        $response->assertRedirect(route('reservations.index'));
        $response->assertSessionHas('reservation.id', $reservation->id);

        $this->assertEquals($table->id, $reservation->table_id);
        $this->assertEquals($client->id, $reservation->client_id);
        $this->assertEquals($arrival_date, $reservation->arrival_date);
        $this->assertEquals($status, $reservation->status);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $reservation = Reservation::factory()->create();

        $response = $this->delete(route('reservations.destroy', $reservation));

        $response->assertRedirect(route('reservations.index'));

        $this->assertModelMissing($reservation);
    }
}
