<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlaceStoreRequest;
use App\Http\Requests\PlaceUpdateRequest;
use App\Models\Place;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PlaceController extends Controller
{

    public const LISTING_VIEW = 'table'; # table or card

    public function index(Request $request): View
    {
        // authorize

        $this->authorize('create', Place::class);

        $listingView = $request->get('view', self::LISTING_VIEW);

        /**
         * @var \App\Models\User 
         */
        $user = auth()->user();

        if ($user->hasRole('SuperAdmin')) {
            $places = Place::all()->sortByDesc('id');
        } else {
            $places = $user->places()->get()->sortByDesc('id');
        }

        return view('place.index', compact('places', 'listingView'));
    }

    public function create(Request $request): View
    {
        // authorize
        $this->authorize('create', Place::class);

        return view('place.create');
    }

    public function store(PlaceStoreRequest $request): RedirectResponse
    {
        //authorize
        $this->authorize('create', Place::class);

        $place = new Place();
        $validatedData = $request->validated();

        // Convert 'reservation_required' to a boolean
        $reservationRequired = filter_var($request->input('reservation_required'), FILTER_VALIDATE_BOOLEAN);

        //  dd($reservationRequired);

        // Add 'reservation_required' field to the validated data
        $validatedData['reservation_required'] = $reservationRequired;

        // Update the place with the combined data
        $place->title = $validatedData['title'];
        $place->description = $validatedData['description'];
        $place->phone = $validatedData['phone'];
        $place->phone_secondary = $validatedData['phone_secondary'];
        $place->phone_tertiary = $validatedData['phone_tertiary'];
        $place->address = $validatedData['address'];
        $place->city = $validatedData['city'];
        $place->neighborhood = $validatedData['neighborhood'];
        $place->reservation_required = $validatedData['reservation_required'];
        $place->website = $validatedData['website'];
        $place->owner_id = $validatedData['owner_id'];
        $place->status = $validatedData['status'];


        $place->save();



        $pk = json_decode($request->place_kitchen, true);
        $ps = json_decode($request->place_service, true);
        // Extract the term IDs from the decoded arrays
        $pkTermIds = array_column($pk, 'id');
        $psTermIds = array_column($ps, 'id');

        // Merge the term IDs from both arrays
        $mergedTermIds = array_merge($pkTermIds, $psTermIds);

        // Sync the merged term IDs with the place
        $place->terms()->sync($mergedTermIds);

        return redirect()->route('places.edit', $place->id)->with('success', __('label.model_created'));
    }

    public function show(Request $request, Place $place): View
    {
        $this->authorize('view', $place);
        return view('place.show', compact('place'));
    }

    public function edit(Request $request, Place $place): View
    {
        // authorize
        $this->authorize('view', $place);
        // -- Add edit_place_general as global variable or constant
        $current_page = $request->get('current_page', 'place_edit_general');

        return view('place.edit', compact('place', 'current_page'));;
    }

    public function update(PlaceUpdateRequest $request, Place $place): RedirectResponse
    {
        //authorize
        $this->authorize('update', $place);
        /*
       "title" => "HAVANA STREET FOOD"
        "place_kitchen" => "[{"id":4,"name":"Méditerranéenne"},{"id":5,"name":"Marocaine"},{"id":6,"name":"Asiatique"},{"id":8,"name":"Française"}]"
        "place_service" => "[{"id":1,"name":"Surplace"},{"id":2,"name":"Livraison"},{"id":3,"name":"Emporter"}]"
        "description" => "Sint officiis offici"
        "phone" => "+1 (188) 528-6587"
        "phone_secondary" => "+1 (813) 806-2883"
        "phone_tertiary" => "+1 (673) 813-3689"
        "address" => "Incidunt animi at"
        "city" => "1"
        "neighborhood" => "de"
        "reservation_required" => "false"
        "owner_id" => "1"
        "website" => "https://www.pobori.tv"
        "status" => "draft"
        */

        $validatedData = $request->validated();

        // Convert 'reservation_required' to a boolean
        $reservationRequired = filter_var($request->input('reservation_required'), FILTER_VALIDATE_BOOLEAN);

        //  dd($reservationRequired);

        // Add 'reservation_required' field to the validated data
        $validatedData['reservation_required'] = $reservationRequired;

        // Update the place with the combined data
        $place->title = $validatedData['title'];
        $place->description = $validatedData['description'];
        $place->phone = $validatedData['phone'];
        $place->phone_secondary = $validatedData['phone_secondary'];
        $place->phone_tertiary = $validatedData['phone_tertiary'];
        $place->address = $validatedData['address'];
        $place->city = $validatedData['city'];
        $place->neighborhood = $validatedData['neighborhood'];
        $place->reservation_required = $validatedData['reservation_required'];
        $place->website = $validatedData['website'];
        $place->status = $validatedData['status'];


        $place->save();



        // Sync the terms with the place

        $pk = json_decode($request->place_kitchen, true);
        $ps = json_decode($request->place_service, true);
        // Extract the term IDs from the decoded arrays
        $pkTermIds = array_column($pk, 'id');
        $psTermIds = array_column($ps, 'id');

        // Merge the term IDs from both arrays
        $mergedTermIds = array_merge($pkTermIds, $psTermIds);

        // Sync the merged term IDs with the place
        $place->terms()->sync($mergedTermIds);

        return redirect()->route('places.edit', $place->id)->with('success', __('label.model_updated'));
    }

    public function destroy(Request $request, Place $place): RedirectResponse
    {
        // authorize
        $this->authorize('delete', $place);
        $place->delete();

        return redirect()->route('places.index');
    }
}
