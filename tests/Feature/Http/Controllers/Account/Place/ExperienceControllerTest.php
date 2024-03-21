<?php

namespace Tests\Feature\Http\Controllers\Account\Place;

use App\Models\Experience;
use App\Models\Place;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Account\Place\ExperienceController
 */
final class ExperienceControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $experiences = Experience::factory()->count(3)->create();

        $response = $this->get(route('experiences.index'));

        $response->assertOk();
        $response->assertViewIs('experience.index');
        $response->assertViewHas('experiences');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('experiences.create'));

        $response->assertOk();
        $response->assertViewIs('experience.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Account\Place\ExperienceController::class,
            'store',
            \App\Http\Place\ExperienceStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $place = Place::factory()->create();
        $date_start = Carbon::parse($this->faker->dateTime());

        $response = $this->post(route('experiences.store'), [
            'place_id' => $place->id,
            'date_start' => $date_start->toDateTimeString(),
        ]);

        $experiences = Experience::query()
            ->where('place_id', $place->id)
            ->where('date_start', $date_start)
            ->get();
        $this->assertCount(1, $experiences);
        $experience = $experiences->first();

        $response->assertRedirect(route('experiences.index'));
        $response->assertSessionHas('experience.id', $experience->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $experience = Experience::factory()->create();

        $response = $this->get(route('experiences.show', $experience));

        $response->assertOk();
        $response->assertViewIs('experience.show');
        $response->assertViewHas('experience');
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $experience = Experience::factory()->create();

        $response = $this->get(route('experiences.edit', $experience));

        $response->assertOk();
        $response->assertViewIs('experience.edit');
        $response->assertViewHas('experience');
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Account\Place\ExperienceController::class,
            'update',
            \App\Http\Place\ExperienceUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $experience = Experience::factory()->create();
        $place = Place::factory()->create();
        $date_start = Carbon::parse($this->faker->dateTime());

        $response = $this->put(route('experiences.update', $experience), [
            'place_id' => $place->id,
            'date_start' => $date_start->toDateTimeString(),
        ]);

        $experience->refresh();

        $response->assertRedirect(route('experiences.index'));
        $response->assertSessionHas('experience.id', $experience->id);

        $this->assertEquals($place->id, $experience->place_id);
        $this->assertEquals($date_start, $experience->date_start);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $experience = Experience::factory()->create();

        $response = $this->delete(route('experiences.destroy', $experience));

        $response->assertRedirect(route('experiences.index'));

        $this->assertModelMissing($experience);
    }
}
