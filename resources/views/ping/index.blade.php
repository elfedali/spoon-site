{{--
    @extends('layouts.app')

    @section('content')
        ping.index template
    @endsection
--}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Ping
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('pings.create') }}"
                class="text-blue-500 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-600
            
            ">Ajouter
                un ping</a>
            <table class="table">
                <tr>
                    <th>Id</th>
                    <th>Lieux </th>
                    <th>date debut</th>
                    <th>date fin</th>
                    <th>Actions</th>
                </tr>
                @foreach ($pings as $ping)
                    <tr>
                        <td>{{ $ping->id }}</td>
                        <td>
                            {{ $ping->place->id }}
                            |
                            {{ $ping->place->title }}

                        </td>
                        <td>{{ $ping->date_start->format('d/m/Y') }}</td>
                        <td>{{ $ping->date_end->format('d/m/Y') }}</td>
                        <td>
                            <a href="{{ route('pings.edit', $ping) }}"
                                class="text-blue-500 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-600">Editer</a>
                            <form action="{{ route('pings.destroy', $ping) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Etes-vous sûr de vouloir supprimer ce ping ?')"
                                    type="submit"
                                    class="text-red-500 hover:text-red-700 dark:text-red-400 dark:hover:text-red-600">Supprimer</button>
                            </form>
                        </td>
                @endforeach

        </div>
    </div>
</x-app-layout>
