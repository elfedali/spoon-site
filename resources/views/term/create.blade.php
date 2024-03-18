{{--
    @extends('layouts.app')

    @section('content')
        term.create template
    @endsection
--}}


<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('label.menu.terms') }}
        </h2>
    </x-slot>


    <div>
        <a href="{{ route('terms.index') }}" class="text-indigo-600 dark:text-indigo-400 hover:underline">
            {{ __('label.all') }}
        </a>
    </div>


    @include('term.partials.term-form')


</x-app-layout>
