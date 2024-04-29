@php
    // Define the active class based on the current page
    $active_class = 'hover:text-primary hover:border-primary';

    // Check the current page and update the active class accordingly
    switch ($current_page) {
        case 'place_edit_general':
            $active_class = 'text-primary border-primary';
            break;
        case 'place_edit_menu':
            $active_class = 'text-primary border-primary';
            break;
        case 'place_edit_gallery':
            $active_class = 'text-primary border-primary';
            break;
        case 'place_edit_opening_hours':
            $active_class = 'text-primary border-primary';
            break;
        default:
            $active_class = 'hover:text-primary hover:border-primary';
            break;
    }
@endphp

<section class="text-md font-medium text-gray-500">
    <ul class="flex flex-wrap -mb-px">
        <li class="me-2">
            <a href="{{ route('places.edit', ['place' => $place->id]) }}"
                class="inline-block p-3.5 border-b-2 border-transparent rounded-t-lg {{ $current_page == 'place_edit_general' ? $active_class : '' }}">
                Général
            </a>
        </li>
        <li class="me-2">
            <a href="{{ route('places.menu.index', ['place' => $place->id]) }}"
                class="inline-block p-3.5 border-b-2 border-transparent rounded-t-lg {{ $current_page == 'place_edit_menu' ? $active_class : '' }}">
                Menu
            </a>
        </li>
        <li class="me-2">
            <a href="{{ route('places.gallery.index', ['place' => $place->id]) }}"
                class="inline-block p-3.5 border-b-2 border-transparent rounded-t-lg {{ $current_page == 'place_edit_gallery' ? $active_class : '' }}">
                Galerie
            </a>
        </li>
        <li class="me-2">
            <a href="{{ route('places.opening-hours.index', ['place' => $place->id]) }}"
                class="inline-block p-3.5 border-b-2 border-transparent rounded-t-lg {{ $current_page == 'place_edit_opening_hours' ? $active_class : '' }}">
                Horaires
            </a>
        </li>
        <li>
            <a class="inline-block p-3.5 text-gray-400 rounded-t-lg cursor-not-allowed dark:text-gray-500">
                Commentaires
            </a>
            <a class="inline-block p-3.5 text-gray-400 rounded-t-lg cursor-not-allowed dark:text-gray-500">
                Réservations
            </a>
        </li>
    </ul>
</section>
