<?php

namespace Tests\Feature\Http\Controllers\Account\Place;

use App\Models\Favorite;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Account\Place\FavoriteController
 */
final class FavoriteControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $favorites = Favorite::factory()->count(3)->create();

        $response = $this->get(route('favorites.index'));

        $response->assertOk();
        $response->assertViewIs('favorite.index');
        $response->assertViewHas('favorites');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('favorites.create'));

        $response->assertOk();
        $response->assertViewIs('favorite.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Account\Place\FavoriteController::class,
            'store',
            \App\Http\Requests\Account\Place\FavoriteStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $user = User::factory()->create();

        $response = $this->post(route('favorites.store'), [
            'user_id' => $user->id,
        ]);

        $favorites = Favorite::query()
            ->where('user_id', $user->id)
            ->get();
        $this->assertCount(1, $favorites);
        $favorite = $favorites->first();

        $response->assertRedirect(route('favorites.index'));
        $response->assertSessionHas('favorite.id', $favorite->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $favorite = Favorite::factory()->create();

        $response = $this->get(route('favorites.show', $favorite));

        $response->assertOk();
        $response->assertViewIs('favorite.show');
        $response->assertViewHas('favorite');
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $favorite = Favorite::factory()->create();

        $response = $this->get(route('favorites.edit', $favorite));

        $response->assertOk();
        $response->assertViewIs('favorite.edit');
        $response->assertViewHas('favorite');
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Account\Place\FavoriteController::class,
            'update',
            \App\Http\Requests\Account\Place\FavoriteUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $favorite = Favorite::factory()->create();
        $user = User::factory()->create();

        $response = $this->put(route('favorites.update', $favorite), [
            'user_id' => $user->id,
        ]);

        $favorite->refresh();

        $response->assertRedirect(route('favorites.index'));
        $response->assertSessionHas('favorite.id', $favorite->id);

        $this->assertEquals($user->id, $favorite->user_id);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $favorite = Favorite::factory()->create();

        $response = $this->delete(route('favorites.destroy', $favorite));

        $response->assertRedirect(route('favorites.index'));

        $this->assertModelMissing($favorite);
    }
}
