<?php

namespace App\Http\Controllers\Account\Place;

use App\Http\Controllers\Controller;
use App\Http\Requests\OpeningHourStoreRequest;
use App\Http\Requests\OpeningHourUpdateRequest;
use App\Models\OpeningHour;
use App\Models\Place;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\OpeningHours\OpeningHours;

class OpeningHourController extends Controller
{
    public function index(Request $request, Place $place): View
    {
        // $openingHours = OpeningHour::all();
        $openingHours =
            OpeningHours::create([
                'monday'     => ['09:00-12:00', '13:00-18:00'],
                'tuesday'    => ['09:00-12:00', '13:00-18:00'],
                'wednesday'  => ['09:00-12:00'],
                'thursday'   => ['09:00-12:00', '13:00-18:00'],
                'friday'     => ['09:00-12:00', '13:00-20:00'],
                'saturday'   => ['09:00-12:00', '13:00-16:00'],
                'sunday'     => [],
                'exceptions' => [
                    '2016-11-11' => ['09:00-12:00'],
                    '2016-12-25' => [],
                    '01-01'      => [],                // Recurring on each 1st of January
                    '12-25'      => ['09:00-12:00'],   // Recurring on each 25th of December
                ],
            ]);
        dump($openingHours);
        // save it to opening_hours filed as serialised array
        $current_page = $request->get('current_page', 'place_edit_opening_hours');
        return view('place.openingHour.index', compact('place', 'current_page', 'openingHours'));
    }


    public function update(OpeningHourUpdateRequest $request, Place $place): RedirectResponse
    {



        return redirect()->route('place.openingHours.index');
    }
}
