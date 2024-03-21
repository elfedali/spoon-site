<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\PageStoreRequest;
use App\Http\PageUpdateRequest;
use App\Models\Page;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PageController extends Controller
{
    public function index(Request $request): View
    {
        $pages = Page::all();

        return view('page.index', compact('pages'));
    }

    public function create(Request $request): View
    {
        return view('page.create');
    }

    public function store(PageStoreRequest $request): RedirectResponse
    {
        $page = Page::create(
            array_merge(
                $request->validated(),
                ['author_id' => $request->user()->id]
            )
        );
        return redirect()->route('pages.index')->with('success', __('label.model_created'));
    }

    public function show(Request $request, Page $page): View
    {
        return view('page.show', compact('page'));
    }

    public function edit(Request $request, Page $page): View
    {
        return view('page.edit', compact('page'));
    }

    public function update(PageUpdateRequest $request, Page $page): RedirectResponse
    {
        $page->update($request->validated());

        $request->session()->flash('page.id', $page->id);

        return redirect()->route('pages.index');
    }

    public function destroy(Request $request, Page $page): RedirectResponse
    {
        $page->delete();

        return redirect()->route('pages.index');
    }
}
