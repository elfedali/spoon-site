{{--
    @extends('layouts.app')

    @section('content')
        ping.show template
    @endsection
--}}


<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Ping
        </h2>
    </x-slot>

    Id : {{ $ping->id }}
    <br>
    Lieu : {{ $ping->place->title }}
    <br>
    Date de début : {{ $ping->date_start->format('d/m/Y') }}
    <br>
    Date de fin : {{ $ping->date_end->format('d/m/Y') }}
    <br>
    <a href="{{ route('pings.edit', $ping) }}"
        class="text-blue-500 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-600">Editer</a>
    <form action="{{ route('pings.destroy', $ping) }}" method="POST">
        @csrf
        @method('DELETE')
        <button onclick="return confirm('Etes-vous sûr de vouloir supprimer ce ping ?')" type="submit"
            class="text-red-500 hover:text-red-700 dark:text-red-400 dark:hover:text-red-600">Supprimer</button>
    </form>
</x-app-layout>
