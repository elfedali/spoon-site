{{--
    @extends('layouts.app')

    @section('content')
        menuCategory.index template
    @endsection
--}}
<x-app-layout>
    <div>
        <a href="{{ route('places.index') }}" class="text-indigo-600 dark:text-indigo-400 hover:underline">
            {{ __('label.all') }}
        </a>
    </div>
    <h1 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 leading-tight">
        {{ $place->title }}
    </h1>
    @include('place._tab')


    <section class="mt-4 bg-white dark:bg-gray-800 p-4">
        <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200 leading-tight mb-4">
            Ajouter un catégorie de menu
        </h2>
        {{ html()->form('POST', route('places.menu.store', ['place' => $place->id]))->open() }}
        {{ html()->hidden('place_id', $place->id) }}
        {{ html()->hidden('position', 0) }}
        <div class="mb-4">
            {{ html()->text('name')->class('form-control')->placeholder('Nom de la catégorie de menu') }}
        </div>
        <div>
            {{ html()->submit('Ajouter une catégorie de menu')->class('btn') }}
        </div>
        {{ html()->form()->close() }}
    </section>

    @if ($place->menuCategories->count() > 0)
        <section class="mt-4 bg-white dark:bg-gray-800 p-4">
            @foreach ($place->menuCategories as $menu)
                <article>
                    <header class="flex justify-between items-center mb-4 bg-gray-50 dark:bg-gray-800 p-4">
                        <h2 class="text-lg font-medium text-gray-800 dark:text-gray-200 leading-tight">
                            {{ ucfirst($menu->name) }}
                        </h2>
                        <div>
                            {{ html()->form('DELETE', route('places.menu.destroy', ['place' => $place->id, 'menu' => $menu->id]))->open() }}
                            {{ html()->submit('Supprimer')->class('btn-red-outline')->attribute('onclick', 'return confirm("Voulez-vous vraiment supprimer cette catégorie de menu?")') }}
                            {{ html()->form()->close() }}

                        </div>
                    </header>
                </article>
            @endforeach
        </section>
    @else
        <section class="mt-4 bg-white p-4">
            <p class="text-sm italic text-gray-800 dark:text-gray-200 leading-tight">
                Aucune catégorie de menu n'est disponible pour le moment.
            </p>
        </section>


    @endif


</x-app-layout>
