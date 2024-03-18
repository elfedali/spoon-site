{{--
    @extends('layouts.app')

    @section('content')
        term.index template
    @endsection
--}}

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Tous les termes
        </h2>
    </x-slot>

    <div>
        <a href="{{ route('terms.create') }}" class="text-indigo-600 dark:text-indigo-400 hover:underline">
            Creer un nouveau terme
        </a>
    </div>

    @if ($terms->isEmpty())
        <div class="mt-4 text-gray-800 dark:text-gray-200">
            Aucun terme n'a été trouvé.
        </div>
    @else
        <table class="min-w-full text-left text-sm font-light text-surface dark:text-gray-400">
            <thead class="border-b border-neutral-200 font-medium dark:border-gray-700">
                <tr>
                    <th scope="col" class="px-6 py-4">#</th>
                    <th scope="col" class="px-6 py-4">
                        {{ __('label.name') }}
                    </th>
                    <th scope="col" class="px-6 py-4">
                        {{ __('label.slug') }}
                    </th>
                    <th scope="col" class="px-6 py-4">
                        {{ __('label.taxonomy') }}
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($terms as $term)
                    <tr class="border-b border-neutral-200 dark:border-gray-700">
                        <td class="whitespace-nowrap px-6 py-4 font-medium">
                            {{ $term->id }}
                        </td>
                        <td class="whitespace-nowrap px-6 py-4">
                            <a href="{{ route('terms.edit', $term->id) }}"
                                class="text-indigo-600 dark:text-indigo-400 hover:underline font-medium">
                                {{ $term->name }}
                            </a>
                        </td>
                        <td class="whitespace-nowrap px-6 py-4">
                            {{ $term->slug }}
                        </td>
                        <td class="whitespace-nowrap px-6 py-4">
                            {{ $term->taxonomy }}
                        </td>
                    </tr>
                @endforeach


            </tbody>
        </table>

        {{-- <div class="mt-4">
            {{ $terms->links() }}
        </div> --}}
    @endif
</x-app-layout>
