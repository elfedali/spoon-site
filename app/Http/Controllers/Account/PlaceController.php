<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlaceStoreRequest;
use App\Http\Requests\PlaceUpdateRequest;
use App\Models\Place;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PlaceController extends Controller
{

    public const LISTING_VIEW = 'table'; # table or card

    public function index(Request $request): View
    {
        $listingView = $request->get('view', self::LISTING_VIEW);

        /**
         * @var \App\Models\User 
         */
        $user = auth()->user();

        if ($user->hasRole('SuperAdmin')) {
            $places = Place::all()->sortByDesc('id');
        } else {
            $places = $user->places()->get()->sortByDesc('id');
        }

        return view('place.index', compact('places', 'listingView'));
    }

    public function create(Request $request): View
    {
        return view('place.create');
    }

    public function store(PlaceStoreRequest $request): RedirectResponse
    {
        //dd($request->validated());

        $place = Place::create($request->validated());



        return redirect()->route('places.edit', $place->id)->with('success', __('label.model_created'));
    }

    public function show(Request $request, Place $place): View
    {
        return view('place.show', compact('place'));
    }

    public function edit(Request $request, Place $place): View
    {
        // -- Add edit_place_general as global variable or constant
        $current_page = $request->get('current_page', 'place_edit_general');

        return view('place.edit', compact('place', 'current_page'));;
    }

    public function update(PlaceUpdateRequest $request, Place $place): RedirectResponse
    {

        $place->update(
            $request->validated()

        );


        return redirect()->route('places.edit', $place->id)->with('success', __('label.model_updated'));
    }

    public function destroy(Request $request, Place $place): RedirectResponse
    {
        $place->delete();

        return redirect()->route('places.index');
    }
}
