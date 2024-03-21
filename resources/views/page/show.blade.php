{{--
    @extends('layouts.app')

    @section('content')
        page.show template
    @endsection
--}}
<x-app-layout>
    <a href="{{ route('pages.index') }}"
        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">
        &larr;
        Retour</a>
    <h1 class="text-2xl font-semibold text-gray-900 mb-4">
        {{ $page->title }}
    </h1>

    <div class="mb-4">
        <p class="text-gray-700 text-sm font-bold mb-2 underline">Contenu</p>
        <p>{{ $page->content }}</p>
    </div>

    <div class="mb-4">
        <p class="text-gray-700 text-sm font-bold mb-2 underline">Statut</p>
        <p>{{ $page->status }}</p>
    </div>

</x-app-layout>
