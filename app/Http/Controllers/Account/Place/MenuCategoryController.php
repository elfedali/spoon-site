<?php

namespace App\Http\Controllers\Account\Place;

use App\Http\Controllers\Controller;
use App\Http\Requests\MenuCategoryStoreRequest;
use App\Http\Requests\MenuCategoryUpdateRequest;
use App\Models\MenuCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MenuCategoryController extends Controller
{
    public function index(Request $request): View
    {
        $menuCategories = MenuCategory::all();

        return view('menuCategory.index', compact('menuCategories'));
    }

    public function create(Request $request): View
    {
        return view('menuCategory.create');
    }

    public function store(MenuCategoryStoreRequest $request): RedirectResponse
    {
        $menuCategory = MenuCategory::create($request->validated());

        $request->session()->flash('menuCategory.id', $menuCategory->id);

        return redirect()->route('menuCategories.index');
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

        $request->session()->flash('menuCategory.id', $menuCategory->id);

        return redirect()->route('menuCategories.index');
    }

    public function destroy(Request $request, MenuCategory $menuCategory): RedirectResponse
    {
        $menuCategory->delete();

        return redirect()->route('menuCategories.index');
    }
}
