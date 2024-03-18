{{--
    @extends('layouts.app')

    @section('content')
        term.edit template
    @endsection
--}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Edit term
        </h2>
    </x-slot>


    <div>
        <a href="{{ route('terms.index') }}" class="text-indigo-600 dark:text-indigo-400 hover:underline">
            la liste des termes
        </a>
    </div>


    @include('term.partials.edit-term-form', ['term' => $term])


</x-app-layout>
