{{--
    @extends('layouts.app')

    @section('content')
        place.edit template
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
            {{ __('label.places') }}
        </h2>
    </x-slot>
    <div>
        <a href="{{ route('places.index') }}" class="text-indigo-600 dark:text-indigo-400 hover:underline">
            {{ __('label.all') }}
        </a>
    </div>
    <h1 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 leading-tight">
        {{ $place->title }}
    </h1>

    {{ html()->form('PUT', route('places.update', $place->id))->open() }}
    {{ html()->modelForm($place)->open() }}
    {{ html()->hidden('id', $place->id) }}
    @include ('place._place-form')
    {{ html()->form()->close() }}

</x-app-layout>
