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
                <article x-data="{ showNewForm: false }" class="mb-4 border rounded ">
                    <header class="flex justify-between items-center mb-4 p-4 border-b">
                        <h2 class="text-lg  font-medium text-gray-800 dark:text-gray-200 leading-tight"
                            @click="open = !open">

                            {{ ucfirst($menu->name) }} - {{ $menu->menuItems->count() }} plats
                        </h2>


                        <div class="flex items-center space-x-4">
                            <div>
                                <button @click="showNewForm = !showNewForm" class="btn">
                                    <i class="fas fa-plus mr-2"></i>
                                    Ajouter un plat
                                </button>

                            </div>
                            <div>
                                {{ html()->form('DELETE', route('places.menu.destroy', ['place' => $place->id, 'menu' => $menu->id]))->open() }}
                                {{ html()->submit('Supprimer')->class('btn-red-outline')->attribute('onclick', 'return confirm("Voulez-vous vraiment supprimer cette catégorie de menu?")') }}
                                {{ html()->form()->close() }}

                            </div>
                        </div>
                    </header>
                    <main>


                        <section :class="{ 'hidden': !showNewForm }" class="ml-8 mr-8 mb-4">
                            @include('menuCategory.items.new-form')
                        </section>
                        @foreach ($menu->menuItems as $dish)
                            <div class="ml-8 mr-8">
                                @include('menuCategory.items.item')
                            </div>
                        @endforeach

                    </main>
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
