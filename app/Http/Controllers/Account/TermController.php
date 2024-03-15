<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\Account\TermStoreRequest;
use App\Http\Requests\Account\TermUpdateRequest;
use App\Models\Term;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TermController extends Controller
{
    public function index(Request $request): View
    {
        $terms = Term::all();

        return view('term.index', compact('terms'));
    }

    public function create(Request $request): View
    {
        return view('term.create');
    }

    public function store(TermStoreRequest $request): RedirectResponse
    {
        $term = Term::create($request->validated());

        $request->session()->flash('term.id', $term->id);

        return redirect()->route('terms.index');
    }

    public function show(Request $request, Term $term): View
    {
        return view('term.show', compact('term'));
    }

    public function edit(Request $request, Term $term): View
    {
        return view('term.edit', compact('term'));
    }

    public function update(TermUpdateRequest $request, Term $term): RedirectResponse
    {
        $term->update($request->validated());

        $request->session()->flash('term.id', $term->id);

        return redirect()->route('terms.index');
    }

    public function destroy(Request $request, Term $term): RedirectResponse
    {
        $term->delete();

        return redirect()->route('terms.index');
    }
}
