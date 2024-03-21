<?php

namespace App\Http\Controllers\Account\Place;

use App\Http\Controllers\Controller;
use App\Http\Place\PingStoreRequest;
use App\Http\Place\PingUpdateRequest;
use App\Models\Ping;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PingController extends Controller
{
    public function index(Request $request): View
    {
        $pings = Ping::all();

        return view('ping.index', compact('pings'));
    }

    public function create(Request $request): View
    {
        return view('ping.create');
    }

    public function store(PingStoreRequest $request): RedirectResponse
    {
        $ping = Ping::create($request->validated());

        $request->session()->flash('ping.id', $ping->id);

        return redirect()->route('pings.index');
    }

    public function show(Request $request, Ping $ping): View
    {
        return view('ping.show', compact('ping'));
    }

    public function edit(Request $request, Ping $ping): View
    {
        return view('ping.edit', compact('ping'));
    }

    public function update(PingUpdateRequest $request, Ping $ping): RedirectResponse
    {
        $ping->update($request->validated());

        $request->session()->flash('ping.id', $ping->id);

        return redirect()->route('pings.index');
    }

    public function destroy(Request $request, Ping $ping): RedirectResponse
    {
        $ping->delete();

        return redirect()->route('pings.index');
    }
}
