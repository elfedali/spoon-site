{{--
    @extends('layouts.app')

    @section('content')
        experience.create template
    @endsection
--}}
@php
    $places = \App\Models\Place::all()->pluck('title', 'id');
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-200">
            Create experience
        </h2>
    </x-slot>




    {{ html()->form('POST', route('experiences.store'))->open() }}

    @include('experience._form')
    {{ html()->submit('Create')->class('mt-4 bg-blue-500 text-white p-2 rounded-md') }}
    {{ html()->form()->close() }}

</x-app-layout>
