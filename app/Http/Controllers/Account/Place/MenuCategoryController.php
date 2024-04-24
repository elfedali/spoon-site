<?php

namespace App\Http\Controllers\Account\Place;

use App\Http\Controllers\Controller;
use App\Http\Requests\MenuCategoryStoreRequest;
use App\Http\Requests\MenuCategoryUpdateRequest;
use App\Models\MenuCategory;
use App\Models\Place;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MenuCategoryController extends Controller
{
    public function index(Request $request, Place $place): View
    {
        // Load menu categories with their menu items ordered by position
        $place->load(['menuCategories' => function ($query) {
            $query->with(['menuItems' => function ($query) {
                $query->ordered(); // Apply the scope to order menu items
            }]);
        }]);
        return view('menuCategory.index', compact('place'));
    }

    public function create(Request $request): View
    {
        return view('menuCategory.create');
    }

    public function store(MenuCategoryStoreRequest $request): RedirectResponse
    {
        $menuCategory = MenuCategory::create($request->validated());

        return redirect()->route(
            'places.menu.index',
            $menuCategory->place_id
        )->with('success', __('label.model_created'));
    }

    public function show(Request $request, MenuCategory $menuCategory): View
    {
        return view('menuCategory.show', compact('menuCategory'));
    }

    public function edit(Request $request, MenuCategory $menuCategory): View
    {
        return view('menuCategory.edit', compact('menuCategory'));
    }

    public function update(MenuCategoryUpdateRequest $request, MenuCategory $menuCategory): RedirectResponse
    {
        $menuCategory->update($request->validated());



        return redirect()->route(
            'places.menu.index',
            $menuCategory->place_id

        )->with('success', __('label.model_updated'));
    }

    public function destroy(Request $request, Place $place, MenuCategory $menu): RedirectResponse
    {

        $menu->menuItems()->delete();
        $menu->delete();

        return redirect()->route(
            'places.menu.index',
            ['place' => $place->id]
        )->with('success', __('label.model_deleted'));
    }
}
