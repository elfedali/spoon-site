<?php

namespace Tests\Feature\Http\Controllers\Account\Place;

use App\Models\MenuCategory;
use App\Models\Restaurant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Account\Place\MenuCategoryController
 */
final class MenuCategoryControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $menuCategories = MenuCategory::factory()->count(3)->create();

        $response = $this->get(route('menu-categories.index'));

        $response->assertOk();
        $response->assertViewIs('menuCategory.index');
        $response->assertViewHas('menuCategories');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('menu-categories.create'));

        $response->assertOk();
        $response->assertViewIs('menuCategory.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Account\Place\MenuCategoryController::class,
            'store',
            \App\Http\Requests\Account\Place\MenuCategoryStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $restaurant = Restaurant::factory()->create();
        $name = $this->faker->name();
        $position = $this->faker->numberBetween(-10000, 10000);

        $response = $this->post(route('menu-categories.store'), [
            'restaurant_id' => $restaurant->id,
            'name' => $name,
            'position' => $position,
        ]);

        $menuCategories = MenuCategory::query()
            ->where('restaurant_id', $restaurant->id)
            ->where('name', $name)
            ->where('position', $position)
            ->get();
        $this->assertCount(1, $menuCategories);
        $menuCategory = $menuCategories->first();

        $response->assertRedirect(route('menuCategories.index'));
        $response->assertSessionHas('menuCategory.id', $menuCategory->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $menuCategory = MenuCategory::factory()->create();

        $response = $this->get(route('menu-categories.show', $menuCategory));

        $response->assertOk();
        $response->assertViewIs('menuCategory.show');
        $response->assertViewHas('menuCategory');
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $menuCategory = MenuCategory::factory()->create();

        $response = $this->get(route('menu-categories.edit', $menuCategory));

        $response->assertOk();
        $response->assertViewIs('menuCategory.edit');
        $response->assertViewHas('menuCategory');
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Account\Place\MenuCategoryController::class,
            'update',
            \App\Http\Requests\Account\Place\MenuCategoryUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $menuCategory = MenuCategory::factory()->create();
        $restaurant = Restaurant::factory()->create();
        $name = $this->faker->name();
        $position = $this->faker->numberBetween(-10000, 10000);

        $response = $this->put(route('menu-categories.update', $menuCategory), [
            'restaurant_id' => $restaurant->id,
            'name' => $name,
            'position' => $position,
        ]);

        $menuCategory->refresh();

        $response->assertRedirect(route('menuCategories.index'));
        $response->assertSessionHas('menuCategory.id', $menuCategory->id);

        $this->assertEquals($restaurant->id, $menuCategory->restaurant_id);
        $this->assertEquals($name, $menuCategory->name);
        $this->assertEquals($position, $menuCategory->position);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $menuCategory = MenuCategory::factory()->create();

        $response = $this->delete(route('menu-categories.destroy', $menuCategory));

        $response->assertRedirect(route('menuCategories.index'));

        $this->assertModelMissing($menuCategory);
    }
}
