{{--
    @extends('layouts.app')

    @section('content')
        page.create template
    @endsection
--}}
@php

    $status_array = [
        'published' => 'Publiée',
        'draft' => 'Brouillon',
    ];

@endphp

<x-app-layout>
    <h1 class="text-2xl font-semibold text-gray-900 mb-4">
        Créer une page
    </h1>
    {{ html()->form('POST', route('pages.store'))->open() }}
    @include('page._form')


    <div class="mb-4">
        {{ html()->submit('Créer')->class('bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded') }}
    </div>
    {{ html()->form()->close() }}
</x-app-layout>
