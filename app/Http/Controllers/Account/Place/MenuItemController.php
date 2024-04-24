<?php

namespace App\Http\Controllers\Account\Place;

use App\Http\Controllers\Controller;
use App\Http\Requests\MenuItemStoreRequest;
use App\Http\Requests\MenuItemUpdateRequest;
use App\Models\MenuCategory;
use App\Models\MenuItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MenuItemController extends Controller
{
    public function index(Request $request): View
    {
        $menuItems = MenuItem::all()->sortBy('position');

        return view('menuItem.index', compact('menuItems'));
    }

    public function create(Request $request): View
    {
        return view('menuItem.create');
    }

    public function store(MenuItemStoreRequest $request): RedirectResponse
    {


        $menuItem = MenuItem::create(
            [
                'menu_category_id' => $request->menu_category_id,
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'position' => $request->position,
                'is_available' => $request->is_available ?? false,
                'is_vegetarian' => $request->is_vegetarian ?? false,
            ]
        );

        $menuCategory = MenuCategory::find($request->menu_category_id);

        return redirect()->route('places.menu.index', [
            'place' => $menuCategory->place_id,
            'scrollTo' => $menuItem->id, // adding this to scroll to the created item
        ])->with(
            'success',
            __('label.model_created')
        );
    }

    public function show(Request $request, MenuItem $menuItem): View
    {
        return view('menuItem.show', compact('menuItem'));
    }

    public function edit(Request $request, MenuItem $menuItem): View
    {
        return view('menuItem.edit', compact('menuItem'));
    }

    public function update(MenuItemUpdateRequest $request, MenuItem $item): RedirectResponse
    {
        $item->update($request->validated());

        return redirect()->route('places.menu.index', [
            'place' => $item->menuCategory->place_id,
            'scrollTo' => $item->id, // adding this to scroll to the updated item

        ])->with(
            'success',
            __('label.model_updated')
        );
    }

    public function destroy(Request $request, MenuItem $item): RedirectResponse
    {
        $item->delete();

        return redirect()->route('places.menu.index', [
            'place' => $item->menuCategory->place_id
        ])->with(
            'success',
            __('label.model_deleted')
        );
    }
}
