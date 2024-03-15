<?php

namespace Tests\Feature\Http\Controllers\Account\Place;

use App\Models\Category;
use App\Models\MenuItem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Account\Place\MenuItemController
 */
final class MenuItemControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $menuItems = MenuItem::factory()->count(3)->create();

        $response = $this->get(route('menu-items.index'));

        $response->assertOk();
        $response->assertViewIs('menuItem.index');
        $response->assertViewHas('menuItems');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('menu-items.create'));

        $response->assertOk();
        $response->assertViewIs('menuItem.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Account\Place\MenuItemController::class,
            'store',
            \App\Http\Requests\Account\Place\MenuItemStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $category = Category::factory()->create();
        $name = $this->faker->name();
        $description = $this->faker->text();
        $price = $this->faker->randomFloat(/** decimal_attributes **/);
        $position = $this->faker->numberBetween(-10000, 10000);

        $response = $this->post(route('menu-items.store'), [
            'category_id' => $category->id,
            'name' => $name,
            'description' => $description,
            'price' => $price,
            'position' => $position,
        ]);

        $menuItems = MenuItem::query()
            ->where('category_id', $category->id)
            ->where('name', $name)
            ->where('description', $description)
            ->where('price', $price)
            ->where('position', $position)
            ->get();
        $this->assertCount(1, $menuItems);
        $menuItem = $menuItems->first();

        $response->assertRedirect(route('menuItems.index'));
        $response->assertSessionHas('menuItem.id', $menuItem->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $menuItem = MenuItem::factory()->create();

        $response = $this->get(route('menu-items.show', $menuItem));

        $response->assertOk();
        $response->assertViewIs('menuItem.show');
        $response->assertViewHas('menuItem');
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $menuItem = MenuItem::factory()->create();

        $response = $this->get(route('menu-items.edit', $menuItem));

        $response->assertOk();
        $response->assertViewIs('menuItem.edit');
        $response->assertViewHas('menuItem');
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Account\Place\MenuItemController::class,
            'update',
            \App\Http\Requests\Account\Place\MenuItemUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $menuItem = MenuItem::factory()->create();
        $category = Category::factory()->create();
        $name = $this->faker->name();
        $description = $this->faker->text();
        $price = $this->faker->randomFloat(/** decimal_attributes **/);
        $position = $this->faker->numberBetween(-10000, 10000);

        $response = $this->put(route('menu-items.update', $menuItem), [
            'category_id' => $category->id,
            'name' => $name,
            'description' => $description,
            'price' => $price,
            'position' => $position,
        ]);

        $menuItem->refresh();

        $response->assertRedirect(route('menuItems.index'));
        $response->assertSessionHas('menuItem.id', $menuItem->id);

        $this->assertEquals($category->id, $menuItem->category_id);
        $this->assertEquals($name, $menuItem->name);
        $this->assertEquals($description, $menuItem->description);
        $this->assertEquals($price, $menuItem->price);
        $this->assertEquals($position, $menuItem->position);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $menuItem = MenuItem::factory()->create();

        $response = $this->delete(route('menu-items.destroy', $menuItem));

        $response->assertRedirect(route('menuItems.index'));

        $this->assertModelMissing($menuItem);
    }
}
