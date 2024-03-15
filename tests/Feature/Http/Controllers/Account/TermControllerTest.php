<?php

namespace Tests\Feature\Http\Controllers\Account;

use App\Models\Term;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Account\TermController
 */
final class TermControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $terms = Term::factory()->count(3)->create();

        $response = $this->get(route('terms.index'));

        $response->assertOk();
        $response->assertViewIs('term.index');
        $response->assertViewHas('terms');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('terms.create'));

        $response->assertOk();
        $response->assertViewIs('term.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Account\TermController::class,
            'store',
            \App\Http\Requests\Account\TermStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $name = $this->faker->name();
        $slug = $this->faker->slug();
        $taxonomy = $this->faker->word();

        $response = $this->post(route('terms.store'), [
            'name' => $name,
            'slug' => $slug,
            'taxonomy' => $taxonomy,
        ]);

        $terms = Term::query()
            ->where('name', $name)
            ->where('slug', $slug)
            ->where('taxonomy', $taxonomy)
            ->get();
        $this->assertCount(1, $terms);
        $term = $terms->first();

        $response->assertRedirect(route('terms.index'));
        $response->assertSessionHas('term.id', $term->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $term = Term::factory()->create();

        $response = $this->get(route('terms.show', $term));

        $response->assertOk();
        $response->assertViewIs('term.show');
        $response->assertViewHas('term');
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $term = Term::factory()->create();

        $response = $this->get(route('terms.edit', $term));

        $response->assertOk();
        $response->assertViewIs('term.edit');
        $response->assertViewHas('term');
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Account\TermController::class,
            'update',
            \App\Http\Requests\Account\TermUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $term = Term::factory()->create();
        $name = $this->faker->name();
        $slug = $this->faker->slug();
        $taxonomy = $this->faker->word();

        $response = $this->put(route('terms.update', $term), [
            'name' => $name,
            'slug' => $slug,
            'taxonomy' => $taxonomy,
        ]);

        $term->refresh();

        $response->assertRedirect(route('terms.index'));
        $response->assertSessionHas('term.id', $term->id);

        $this->assertEquals($name, $term->name);
        $this->assertEquals($slug, $term->slug);
        $this->assertEquals($taxonomy, $term->taxonomy);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $term = Term::factory()->create();

        $response = $this->delete(route('terms.destroy', $term));

        $response->assertRedirect(route('terms.index'));

        $this->assertModelMissing($term);
    }
}
