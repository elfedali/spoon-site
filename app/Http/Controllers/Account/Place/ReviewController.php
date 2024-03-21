<?php

namespace App\Http\Controllers\Account\Place;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReviewStoreRequest;
use App\Http\Requests\ReviewUpdateRequest;
use App\Models\Review;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReviewController extends Controller
{
    public function index(Request $request): View
    {
        $reviews = Review::all();

        return view('review.index', compact('reviews'));
    }

    public function create(Request $request): View
    {
        return view('review.create');
    }

    public function store(ReviewStoreRequest $request): RedirectResponse
    {
        $review = Review::create($request->validated());

        $request->session()->flash('review.id', $review->id);

        return redirect()->route('reviews.index');
    }

    public function show(Request $request, Review $review): View
    {
        return view('review.show', compact('review'));
    }

    public function edit(Request $request, Review $review): View
    {
        return view('review.edit', compact('review'));
    }

    public function update(ReviewUpdateRequest $request, Review $review): RedirectResponse
    {
        $review->update($request->validated());

        $request->session()->flash('review.id', $review->id);

        return redirect()->route('reviews.index');
    }

    public function destroy(Request $request, Review $review): RedirectResponse
    {
        $review->delete();

        return redirect()->route('reviews.index');
    }
}
