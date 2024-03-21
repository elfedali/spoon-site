<?php

namespace Tests\Feature\Http\Controllers\Account\Place;

use App\Models\Salle;
use App\Models\Table;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Account\Place\TableController
 */
final class TableControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $tables = Table::factory()->count(3)->create();

        $response = $this->get(route('tables.index'));

        $response->assertOk();
        $response->assertViewIs('table.index');
        $response->assertViewHas('tables');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('tables.create'));

        $response->assertOk();
        $response->assertViewIs('table.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Account\Place\TableController::class,
            'store',
            \App\Http\Place\TableStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $salle = Salle::factory()->create();
        $name = $this->faker->name();
        $capacity = $this->faker->numberBetween(-10000, 10000);
        $position = $this->faker->numberBetween(-10000, 10000);

        $response = $this->post(route('tables.store'), [
            'salle_id' => $salle->id,
            'name' => $name,
            'capacity' => $capacity,
            'position' => $position,
        ]);

        $tables = Table::query()
            ->where('salle_id', $salle->id)
            ->where('name', $name)
            ->where('capacity', $capacity)
            ->where('position', $position)
            ->get();
        $this->assertCount(1, $tables);
        $table = $tables->first();

        $response->assertRedirect(route('tables.index'));
        $response->assertSessionHas('table.id', $table->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $table = Table::factory()->create();

        $response = $this->get(route('tables.show', $table));

        $response->assertOk();
        $response->assertViewIs('table.show');
        $response->assertViewHas('table');
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $table = Table::factory()->create();

        $response = $this->get(route('tables.edit', $table));

        $response->assertOk();
        $response->assertViewIs('table.edit');
        $response->assertViewHas('table');
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Account\Place\TableController::class,
            'update',
            \App\Http\Place\TableUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $table = Table::factory()->create();
        $salle = Salle::factory()->create();
        $name = $this->faker->name();
        $capacity = $this->faker->numberBetween(-10000, 10000);
        $position = $this->faker->numberBetween(-10000, 10000);

        $response = $this->put(route('tables.update', $table), [
            'salle_id' => $salle->id,
            'name' => $name,
            'capacity' => $capacity,
            'position' => $position,
        ]);

        $table->refresh();

        $response->assertRedirect(route('tables.index'));
        $response->assertSessionHas('table.id', $table->id);

        $this->assertEquals($salle->id, $table->salle_id);
        $this->assertEquals($name, $table->name);
        $this->assertEquals($capacity, $table->capacity);
        $this->assertEquals($position, $table->position);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $table = Table::factory()->create();

        $response = $this->delete(route('tables.destroy', $table));

        $response->assertRedirect(route('tables.index'));

        $this->assertModelMissing($table);
    }
}
