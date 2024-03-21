<?php

namespace Tests\Feature\Http\Controllers\Account;

use App\Models\Author;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Account\PostController
 */
final class PostControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $posts = Post::factory()->count(3)->create();

        $response = $this->get(route('posts.index'));

        $response->assertOk();
        $response->assertViewIs('post.index');
        $response->assertViewHas('posts');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('posts.create'));

        $response->assertOk();
        $response->assertViewIs('post.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Account\PostController::class,
            'store',
            \App\Http\PostStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $title = $this->faker->sentence(4);
        $slug = $this->faker->slug();
        $author = Author::factory()->create();
        $is_active = $this->faker->boolean();

        $response = $this->post(route('posts.store'), [
            'title' => $title,
            'slug' => $slug,
            'author_id' => $author->id,
            'is_active' => $is_active,
        ]);

        $posts = Post::query()
            ->where('title', $title)
            ->where('slug', $slug)
            ->where('author_id', $author->id)
            ->where('is_active', $is_active)
            ->get();
        $this->assertCount(1, $posts);
        $post = $posts->first();

        $response->assertRedirect(route('posts.index'));
        $response->assertSessionHas('post.id', $post->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $post = Post::factory()->create();

        $response = $this->get(route('posts.show', $post));

        $response->assertOk();
        $response->assertViewIs('post.show');
        $response->assertViewHas('post');
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $post = Post::factory()->create();

        $response = $this->get(route('posts.edit', $post));

        $response->assertOk();
        $response->assertViewIs('post.edit');
        $response->assertViewHas('post');
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Account\PostController::class,
            'update',
            \App\Http\PostUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $post = Post::factory()->create();
        $title = $this->faker->sentence(4);
        $slug = $this->faker->slug();
        $author = Author::factory()->create();
        $is_active = $this->faker->boolean();

        $response = $this->put(route('posts.update', $post), [
            'title' => $title,
            'slug' => $slug,
            'author_id' => $author->id,
            'is_active' => $is_active,
        ]);

        $post->refresh();

        $response->assertRedirect(route('posts.index'));
        $response->assertSessionHas('post.id', $post->id);

        $this->assertEquals($title, $post->title);
        $this->assertEquals($slug, $post->slug);
        $this->assertEquals($author->id, $post->author_id);
        $this->assertEquals($is_active, $post->is_active);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $post = Post::factory()->create();

        $response = $this->delete(route('posts.destroy', $post));

        $response->assertRedirect(route('posts.index'));

        $this->assertModelMissing($post);
    }
}
