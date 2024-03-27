<!-- resources/views/components/button.blade.php -->

@props(['url'])

<a href="{{ $url }}"
    class="bg-indigo-600 rounded-md px-4 py-3 text-white font-medium text-center hover:bg-opacity-90 {{ $attributes->get('class') }}">

    {{ $slot }}

</a>
