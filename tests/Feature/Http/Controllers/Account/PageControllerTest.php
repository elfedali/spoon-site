<?php

namespace Tests\Feature\Http\Controllers\Account;

use App\Models\Author;
use App\Models\Page;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Account\PageController
 */
final class PageControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $pages = Page::factory()->count(3)->create();

        $response = $this->get(route('pages.index'));

        $response->assertOk();
        $response->assertViewIs('page.index');
        $response->assertViewHas('pages');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('pages.create'));

        $response->assertOk();
        $response->assertViewIs('page.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Account\PageController::class,
            'store',
            \App\Http\PageStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $title = $this->faker->sentence(4);
        $slug = $this->faker->slug();
        $author = Author::factory()->create();
        $is_active = $this->faker->boolean();

        $response = $this->post(route('pages.store'), [
            'title' => $title,
            'slug' => $slug,
            'author_id' => $author->id,
            'is_active' => $is_active,
        ]);

        $pages = Page::query()
            ->where('title', $title)
            ->where('slug', $slug)
            ->where('author_id', $author->id)
            ->where('is_active', $is_active)
            ->get();
        $this->assertCount(1, $pages);
        $page = $pages->first();

        $response->assertRedirect(route('pages.index'));
        $response->assertSessionHas('page.id', $page->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $page = Page::factory()->create();

        $response = $this->get(route('pages.show', $page));

        $response->assertOk();
        $response->assertViewIs('page.show');
        $response->assertViewHas('page');
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $page = Page::factory()->create();

        $response = $this->get(route('pages.edit', $page));

        $response->assertOk();
        $response->assertViewIs('page.edit');
        $response->assertViewHas('page');
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Account\PageController::class,
            'update',
            \App\Http\PageUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $page = Page::factory()->create();
        $title = $this->faker->sentence(4);
        $slug = $this->faker->slug();
        $author = Author::factory()->create();
        $is_active = $this->faker->boolean();

        $response = $this->put(route('pages.update', $page), [
            'title' => $title,
            'slug' => $slug,
            'author_id' => $author->id,
            'is_active' => $is_active,
        ]);

        $page->refresh();

        $response->assertRedirect(route('pages.index'));
        $response->assertSessionHas('page.id', $page->id);

        $this->assertEquals($title, $page->title);
        $this->assertEquals($slug, $page->slug);
        $this->assertEquals($author->id, $page->author_id);
        $this->assertEquals($is_active, $page->is_active);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $page = Page::factory()->create();

        $response = $this->delete(route('pages.destroy', $page));

        $response->assertRedirect(route('pages.index'));

        $this->assertModelMissing($page);
    }
}
