<?php

namespace App\Http\Controllers\Account\Place;

use App\Http\Controllers\Controller;
use App\Http\Place\OpeningHourStoreRequest;
use App\Http\Place\OpeningHourUpdateRequest;
use App\Models\OpeningHour;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OpeningHourController extends Controller
{
    public function index(Request $request): View
    {
        $openingHours = OpeningHour::all();

        return view('openingHour.index', compact('openingHours'));
    }

    public function create(Request $request): View
    {
        return view('openingHour.create');
    }

    public function store(OpeningHourStoreRequest $request): RedirectResponse
    {
        $openingHour = OpeningHour::create($request->validated());

        $request->session()->flash('openingHour.id', $openingHour->id);

        return redirect()->route('openingHours.index');
    }

    public function show(Request $request, OpeningHour $openingHour): View
    {
        return view('openingHour.show', compact('openingHour'));
    }

    public function edit(Request $request, OpeningHour $openingHour): View
    {
        return view('openingHour.edit', compact('openingHour'));
    }

    public function update(OpeningHourUpdateRequest $request, OpeningHour $openingHour): RedirectResponse
    {
        $openingHour->update($request->validated());

        $request->session()->flash('openingHour.id', $openingHour->id);

        return redirect()->route('openingHours.index');
    }

    public function destroy(Request $request, OpeningHour $openingHour): RedirectResponse
    {
        $openingHour->delete();

        return redirect()->route('openingHours.index');
    }
}
