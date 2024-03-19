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
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Ajoute un lieu
        </h2>
    </x-slot>
    <div>
        <a href="{{ route('places.index') }}" class="text-indigo-600 dark:text-indigo-400 hover:underline">
            {{ __('label.places') }}
        </a>
    </div>
    {{ html()->form('POST', route('places.store'))->open() }}
    <div class="mt-4">
        @include ('place._place-form')
    </div>
    {{ html()->form()->close() }}

</x-app-layout>
