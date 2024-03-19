{{--
    @extends('layouts.app')

    @section('content')
        ping.create template
    @endsection
--}}

@php
    $places = \App\Models\Place::all()->pluck('title', 'id');
@endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Ping
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{ html()->form('POST', route('pings.store'))->open() }}

            @include('ping._form')

            {{ html()->submit('Ajouter')->class('btn btn-primary') }}
            {{ html()->form()->close() }}
        </div>
    </div>
</x-app-layout>
