{{--
    @extends('layouts.app')

    @section('content')
        place.create template
    @endsection
--}}
@php
    $owners = \App\Models\User::all()->pluck('name', 'id');

    $places_types = \App\Models\Place::TYPES;
    $places_statuses = \App\Models\Place::STATUSES;
    $reservation_required = \App\Models\Place::RESERVATION_REQUIRED;

@endphp
<x-app-layout>

    <div>
        <a href="{{ route('places.index') }}"
            class="font-medium text-gray-500 hover:text-gray-700 dark:text-gray-300 dark:hover:text-gray-100">
            Liste des lieux
        </a>
        <i class="fas fa-chevron-right fa-xs mx-2 text-gray-400"></i>
        <span class="text-gray-600 dark:text-gray-300">Créer un lieu</span>
    </div>
    {{ html()->form('POST', route('places.store'))->open() }}
    <div class="mt-4">
        @include ('place._form')
    </div>
    {{ html()->form()->close() }}

</x-app-layout>
