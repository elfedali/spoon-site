{{--
    @extends('layouts.app')

    @section('content')
        experience.index template
    @endsection
--}}

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Experiencias
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg"> --}}
            <div class="flex justify-end mb-2">
                <a href="{{ route('experiences.create') }}" class="bg-blue-500 text-white p-2 rounded-md">Crear
                    Experiencia</a>
            </div>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Title
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Description
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Start Date
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">

                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                End Date
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($experiences as $experience)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $experience->title }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $experience->description }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $experience->date_start }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $experience->date_end }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="{{ route('experiences.edit', $experience->id) }}"
                                        class="bg-blue-500 text-white p-2 rounded-md">
                                        Modifier
                                    </a>
                                    <form action="{{ route('experiences.destroy', $experience->id) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 text-white p-2 rounded-md">
                                            Supprimer
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{-- </div> --}}
        </div>
    </div>
</x-app-layout>
