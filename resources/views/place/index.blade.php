{{--
    @extends('layouts.app')

    @section('content')
        place.index template
    @endsection
--}}

<x-app-layout>
    <x-headline>
        Liste des lieux
    </x-headline>

    <div class="mb-4 flex justify-between items-center">
        <div>
            <x-text-input placeholder="Rechercher un lieu" />
        </div>
        <div>
            <x-btn-link :url="route('places.create')">
                Créer un lieu
            </x-btn-link>
        </div>
    </div>


    <x-table>
        <x-thead>
            <tr>
                <x-th>
                    {{ __('label.title') }}
                </x-th>
                <x-th>
                    {{ __('label.owner') }}
                </x-th>
                <x-th>
                    #id
                </x-th>
                <x-th>
                    Statut
                </x-th>
                <x-th>
                    {{ __('label.created_at') }}
                </x-th>
            </tr>
        </x-thead>
        <x-tbody>
            @foreach ($places as $place)
                <x-tr>

                    <x-td>
                        <div class="text-gray-900 font-medium dark:text-gray-200">
                            {{ $place->title }}
                        </div>
                        <a href="{{ route('places.edit', ['place' => $place->id]) }}"
                            class="text-xs font-medium text-indigo-600 :hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-600">
                            Modifier
                        </a>
                    </x-td>
                    <x-td>


                        <div id="owner-{{ $place->id }}" class="text-gray-900 font-medium dark:text-gray-200">
                            {{ $place->owner->name }}
                        </div>
                        <div class="text-gray-500 text-xs dark:text-gray-400">
                            #{{ $place->owner->id }} - {{ $place->owner->email }}
                        </div>
                    </x-td>
                    <x-td class="text-gray-900 font-medium dark:text-gray-200">
                        #{{ $place->id }}
                    </x-td>
                    <x-td>
                        <x-badge :status="$place->status" />
                    </x-td>
                    <x-td>
                        <div class="text-gray-900 font-medium dark:text-gray-200">
                            {{ $place->created_at->format('d/m/Y') }}
                        </div>
                        <div class="text-gray-500 text-xs dark:text-gray-400">
                            {{ $place->created_at->diffForHumans() }}
                        </div>
                    </x-td>
                </x-tr>
            @endforeach
        </x-tbody>
    </x-table>

</x-app-layout>
