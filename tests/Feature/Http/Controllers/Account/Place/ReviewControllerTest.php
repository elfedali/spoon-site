<?php

namespace Tests\Feature\Http\Controllers\Account\Place;

use App\Models\Review;
use App\Models\Reviewer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Account\Place\ReviewController
 */
final class ReviewControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $reviews = Review::factory()->count(3)->create();

        $response = $this->get(route('reviews.index'));

        $response->assertOk();
        $response->assertViewIs('review.index');
        $response->assertViewHas('reviews');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('reviews.create'));

        $response->assertOk();
        $response->assertViewIs('review.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Account\Place\ReviewController::class,
            'store',
            \App\Http\Requests\Account\Place\ReviewStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $reviewer = Reviewer::factory()->create();
        $rating = $this->faker->numberBetween(-10000, 10000);

        $response = $this->post(route('reviews.store'), [
            'reviewer_id' => $reviewer->id,
            'rating' => $rating,
        ]);

        $reviews = Review::query()
            ->where('reviewer_id', $reviewer->id)
            ->where('rating', $rating)
            ->get();
        $this->assertCount(1, $reviews);
        $review = $reviews->first();

        $response->assertRedirect(route('reviews.index'));
        $response->assertSessionHas('review.id', $review->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $review = Review::factory()->create();

        $response = $this->get(route('reviews.show', $review));

        $response->assertOk();
        $response->assertViewIs('review.show');
        $response->assertViewHas('review');
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $review = Review::factory()->create();

        $response = $this->get(route('reviews.edit', $review));

        $response->assertOk();
        $response->assertViewIs('review.edit');
        $response->assertViewHas('review');
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Account\Place\ReviewController::class,
            'update',
            \App\Http\Requests\Account\Place\ReviewUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $review = Review::factory()->create();
        $reviewer = Reviewer::factory()->create();
        $rating = $this->faker->numberBetween(-10000, 10000);

        $response = $this->put(route('reviews.update', $review), [
            'reviewer_id' => $reviewer->id,
            'rating' => $rating,
        ]);

        $review->refresh();

        $response->assertRedirect(route('reviews.index'));
        $response->assertSessionHas('review.id', $review->id);

        $this->assertEquals($reviewer->id, $review->reviewer_id);
        $this->assertEquals($rating, $review->rating);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $review = Review::factory()->create();

        $response = $this->delete(route('reviews.destroy', $review));

        $response->assertRedirect(route('reviews.index'));

        $this->assertModelMissing($review);
    }
}
