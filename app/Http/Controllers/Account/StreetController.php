<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\StreetStoreRequest;
use App\Http\StreetUpdateRequest;
use App\Models\Street;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StreetController extends Controller
{
    public function index(Request $request): View
    {
        $streets = Street::all();

        return view('street.index', compact('streets'));
    }

    public function create(Request $request): View
    {
        return view('street.create');
    }

    public function store(StreetStoreRequest $request): RedirectResponse
    {
        $street = Street::create($request->validated());

        $request->session()->flash('street.id', $street->id);

        return redirect()->route('streets.index');
    }

    public function show(Request $request, Street $street): View
    {
        return view('street.show', compact('street'));
    }

    public function edit(Request $request, Street $street): View
    {
        return view('street.edit', compact('street'));
    }

    public function update(StreetUpdateRequest $request, Street $street): RedirectResponse
    {
        $street->update($request->validated());

        $request->session()->flash('street.id', $street->id);

        return redirect()->route('streets.index');
    }

    public function destroy(Request $request, Street $street): RedirectResponse
    {
        $street->delete();

        return redirect()->route('streets.index');
    }
}
