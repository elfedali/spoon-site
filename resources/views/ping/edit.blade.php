{{--
    @extends('layouts.app')

    @section('content')
        ping.edit template
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
            {{ html()->form('PUT', route('pings.update', $ping->id))->open() }}
            {{ html()->modelForm($ping)->open() }}

            @include('ping._form')
            {{ html()->submit('Modifier')->class('btn btn-primary') }}
            {{ html()->form()->close() }}

            {{-- delete  --}}
            {{ html()->form('DELETE', route('pings.destroy', $ping->id))->open() }}
            {{ html()->submit('Supprimer')->class('btn btn-danger')->attributes(['onclick' => 'return confirm("Etes-vous sûr de vouloir supprimer ce ping ?")']) }}
            {{ html()->form()->close() }}
        </div>
    </div>
</x-app-layout>
