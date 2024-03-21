{{--
    @extends('layouts.app')

    @section('content')
        pages.index template
    @endsection
--}}
<x-app-layout>
    <h1 class="text-2xl font-semibold text-gray-900 mb-4">
        List des pages
    </h1>
    <a href="{{ route('pages.create') }}">Créer une page</a>
    @if ($pages->isEmpty())
        <p>Il n'y a pas de page</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>id</th>
                    <th>Titre</th>
                    <th>Statut</th>
                    <th>Actions</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($pages as $page)
                    <tr>
                        <td>
                            {{ $page->id }}
                        </td>
                        <td>
                            {{ $page->title }}
                        </td>
                        <td>
                            {{ $page->status }}
                        </td>


                        <td>
                            <a href="{{ route('pages.show', ['page' => $page->id]) }}">Voir</a>
                            <a href="{{ route('pages.edit', ['page' => $page->id]) }}">Editer</a>
                            <form action="{{ route('pages.destroy', ['page' => $page->id]) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</x-app-layout>
