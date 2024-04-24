@php
    $active_classes =
        'text-blue-600  border-blue-600 dark:text-blue-500 dark:border-blue-500 hover:text-blue-600 hover:border-blue-600';

@endphp


<div
    class="text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:text-gray-400 dark:border-gray-700">
    <ul class="flex flex-wrap -mb-px">
        <li class="me-2">
            <a href="{{ route('places.edit', ['place' => $place->id]) }}"
                class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                :class="{ '{{ $active_classes }}': page === 'places-index' }">
                Général
            </a>
        </li>
        <li class="me-2">
            <a href="{{ route('places.menu.index', ['place' => $place->id]) }}"
                class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                :class="{ '{{ $active_classes }}': page === 'places-menu-index' }">
                Menu
            </a>
        </li>
        <li class="me-2">
            <a href="{{ route('places.gallery.index', ['place' => $place->id]) }}"
                class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                :class="{ '{{ $active_classes }}': page === 'places-gallery-index' }">
                Galerie
            </a>
        </li>
        <li class="me-2">
            <a href="#"
                class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">
                Horaires
            </a>
        </li>
        <li>
            <a class="inline-block p-4 text-gray-400 rounded-t-lg cursor-not-allowed dark:text-gray-500">
                Commentaires
            </a>
            <a class="inline-block p-4 text-gray-400 rounded-t-lg cursor-not-allowed dark:text-gray-500">
                Réservations
            </a>
        </li>
    </ul>
</div>
