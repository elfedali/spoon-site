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
    public function index(Request $request): View
    {
        $places = Place::all();

        return view('place.index', compact('places'));
    }

    public function create(Request $request): View
    {
        return view('place.create');
    }

    public function store(PlaceStoreRequest $request): RedirectResponse
    {
        //dd($request->validated());

        $place = Place::create($request->validated());

        $request->session()->flash('place.id', $place->id);

        return redirect()->route('places.index');
    }

    public function show(Request $request, Place $place): View
    {
        return view('place.show', compact('place'));
    }

    public function edit(Request $request, Place $place): View
    {
        return view('place.edit', compact('place'));
    }

    public function update(PlaceUpdateRequest $request, Place $place): RedirectResponse
    {
        $place->update($request->validated());

        $request->session()->flash('place.id', $place->id);

        return redirect()->route('places.index');
    }

    public function destroy(Request $request, Place $place): RedirectResponse
    {
        $place->delete();

        return redirect()->route('places.index');
    }
}
