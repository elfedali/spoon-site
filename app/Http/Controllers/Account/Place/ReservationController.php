<?php

namespace App\Http\Controllers\Account\Place;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReservationStoreRequest;
use App\Http\Requests\ReservationUpdateRequest;
use App\Models\Reservation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReservationController extends Controller
{
    public function index(Request $request): View
    {
        $reservations = Reservation::all();

        return view('reservation.index', compact('reservations'));
    }

    public function create(Request $request): View
    {
        return view('reservation.create');
    }

    public function store(ReservationStoreRequest $request): RedirectResponse
    {
        $reservation = Reservation::create($request->validated());

        $request->session()->flash('reservation.id', $reservation->id);

        return redirect()->route('reservations.index');
    }

    public function show(Request $request, Reservation $reservation): View
    {
        return view('reservation.show', compact('reservation'));
    }

    public function edit(Request $request, Reservation $reservation): View
    {
        return view('reservation.edit', compact('reservation'));
    }

    public function update(ReservationUpdateRequest $request, Reservation $reservation): RedirectResponse
    {
        $reservation->update($request->validated());

        $request->session()->flash('reservation.id', $reservation->id);

        return redirect()->route('reservations.index');
    }

    public function destroy(Request $request, Reservation $reservation): RedirectResponse
    {
        $reservation->delete();

        return redirect()->route('reservations.index');
    }
}
