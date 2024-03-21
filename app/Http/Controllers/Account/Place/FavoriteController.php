<?php

namespace App\Http\Controllers\Account\Place;

use App\Http\Controllers\Controller;
use App\Http\Place\FavoriteStoreRequest;
use App\Http\Place\FavoriteUpdateRequest;
use App\Models\Favorite;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FavoriteController extends Controller
{
    public function index(Request $request): View
    {
        $favorites = Favorite::all();

        return view('favorite.index', compact('favorites'));
    }

    public function create(Request $request): View
    {
        return view('favorite.create');
    }

    public function store(FavoriteStoreRequest $request): RedirectResponse
    {
        $favorite = Favorite::create($request->validated());

        $request->session()->flash('favorite.id', $favorite->id);

        return redirect()->route('favorites.index');
    }

    public function show(Request $request, Favorite $favorite): View
    {
        return view('favorite.show', compact('favorite'));
    }

    public function edit(Request $request, Favorite $favorite): View
    {
        return view('favorite.edit', compact('favorite'));
    }

    public function update(FavoriteUpdateRequest $request, Favorite $favorite): RedirectResponse
    {
        $favorite->update($request->validated());

        $request->session()->flash('favorite.id', $favorite->id);

        return redirect()->route('favorites.index');
    }

    public function destroy(Request $request, Favorite $favorite): RedirectResponse
    {
        $favorite->delete();

        return redirect()->route('favorites.index');
    }
}
