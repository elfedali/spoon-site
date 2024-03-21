<?php

namespace Tests\Feature\Http\Controllers\Account;

use App\Models\Demand;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Account\DemandController
 */
final class DemandControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $demands = Demand::factory()->count(3)->create();

        $response = $this->get(route('demands.index'));

        $response->assertOk();
        $response->assertViewIs('demand.index');
        $response->assertViewHas('demands');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('demands.create'));

        $response->assertOk();
        $response->assertViewIs('demand.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Account\DemandController::class,
            'store',
            \App\Http\DemandStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $user = User::factory()->create();
        $date_start = Carbon::parse($this->faker->dateTime());
        $status = $this->faker->word();

        $response = $this->post(route('demands.store'), [
            'user_id' => $user->id,
            'date_start' => $date_start->toDateTimeString(),
            'status' => $status,
        ]);

        $demands = Demand::query()
            ->where('user_id', $user->id)
            ->where('date_start', $date_start)
            ->where('status', $status)
            ->get();
        $this->assertCount(1, $demands);
        $demand = $demands->first();

        $response->assertRedirect(route('demands.index'));
        $response->assertSessionHas('demand.id', $demand->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $demand = Demand::factory()->create();

        $response = $this->get(route('demands.show', $demand));

        $response->assertOk();
        $response->assertViewIs('demand.show');
        $response->assertViewHas('demand');
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $demand = Demand::factory()->create();

        $response = $this->get(route('demands.edit', $demand));

        $response->assertOk();
        $response->assertViewIs('demand.edit');
        $response->assertViewHas('demand');
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Account\DemandController::class,
            'update',
            \App\Http\DemandUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $demand = Demand::factory()->create();
        $user = User::factory()->create();
        $date_start = Carbon::parse($this->faker->dateTime());
        $status = $this->faker->word();

        $response = $this->put(route('demands.update', $demand), [
            'user_id' => $user->id,
            'date_start' => $date_start->toDateTimeString(),
            'status' => $status,
        ]);

        $demand->refresh();

        $response->assertRedirect(route('demands.index'));
        $response->assertSessionHas('demand.id', $demand->id);

        $this->assertEquals($user->id, $demand->user_id);
        $this->assertEquals($date_start, $demand->date_start);
        $this->assertEquals($status, $demand->status);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $demand = Demand::factory()->create();

        $response = $this->delete(route('demands.destroy', $demand));

        $response->assertRedirect(route('demands.index'));

        $this->assertModelMissing($demand);
    }
}
