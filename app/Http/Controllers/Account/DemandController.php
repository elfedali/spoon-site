<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\Account\DemandStoreRequest;
use App\Http\Requests\Account\DemandUpdateRequest;
use App\Models\Demand;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DemandController extends Controller
{
    public function index(Request $request): View
    {
        $demands = Demand::all();

        return view('demand.index', compact('demands'));
    }

    public function create(Request $request): View
    {
        return view('demand.create');
    }

    public function store(DemandStoreRequest $request): RedirectResponse
    {
        $demand = Demand::create($request->validated());

        $request->session()->flash('demand.id', $demand->id);

        return redirect()->route('demands.index');
    }

    public function show(Request $request, Demand $demand): View
    {
        return view('demand.show', compact('demand'));
    }

    public function edit(Request $request, Demand $demand): View
    {
        return view('demand.edit', compact('demand'));
    }

    public function update(DemandUpdateRequest $request, Demand $demand): RedirectResponse
    {
        $demand->update($request->validated());

        $request->session()->flash('demand.id', $demand->id);

        return redirect()->route('demands.index');
    }

    public function destroy(Request $request, Demand $demand): RedirectResponse
    {
        $demand->delete();

        return redirect()->route('demands.index');
    }
}
