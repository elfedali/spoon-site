{{--
    @extends('layouts.app')

    @section('content')
        place.index template
    @endsection
--}}

<x-app-layout>
    <h1>

        <a href="{{ route('places.create') }}" class="text-indigo-600 dark:text-indigo-400 hover:underline">
            Creer une nouvelle place
        </a>
    </h1>


    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
        <thead>
            <tr>
                <th scope="col" class="px-6 py-4 dark:text-gray-400">
                    #
                </th>
                <th scope="col" class="px-6 py-4 dark:text-gray-400">
                    {{ __('label.title') }}
                </th>
                <th scope="col" class="px-6 py-4 dark:text-gray-400">
                    {{ __('label.owner') }}
                </th>
                <th scope="col" class="px-6 py-4 dark:text-gray-400">
                    {{ __('label.created_at') }}
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($places as $place)
                <tr>
                    <td class="whitespace-nowrap px-6 py-4 font-medium dark:text-gray-400">
                        {{ $place->id }}
                    </td>
                    <td>
                        <a href="{{ route('places.edit', ['place' => $place->id]) }}"
                            class="text-indigo-600 dark:text-indigo-400 hover:underline font-medium">
                            {{ $place->title }}
                        </a>
                    </td>
                    <td class="whitespace nowrap px-6 py-4 font-medium dark:text-gray-400">

                        {{ $place->owner->id }} |
                        {{ $place->owner->name }}
                    </td>
                    <td class="whitespace nowrap px-6 py-4 font-medium dark:text-gray-400">
                        {{ $place->created_at->diffForHumans() }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</x-app-layout>
