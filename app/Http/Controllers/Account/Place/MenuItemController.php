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
        $menuItems = MenuItem::all();

        return view('menuItem.index', compact('menuItems'));
    }

    public function create(Request $request): View
    {
        return view('menuItem.create');
    }

    public function store(MenuItemStoreRequest $request): RedirectResponse
    {
        $menuItem = MenuItem::create($request->validated());

        $menuCategory = MenuCategory::find($request->menu_category_id);

        return redirect()->route('places.menu.index', [
            'place' => $menuCategory->place_id
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

    public function update(MenuItemUpdateRequest $request, MenuItem $menuItem): RedirectResponse
    {
        $menuItem->update($request->validated());

        $request->session()->flash('menuItem.id', $menuItem->id);

        return redirect()->route('menuItems.index');
    }

    public function destroy(Request $request, MenuItem $menuItem): RedirectResponse
    {
        $menuItem->delete();

        return redirect()->route('menuItems.index');
    }
}
