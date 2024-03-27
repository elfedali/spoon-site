{{-- headline : h1 ,h2, h3,h4,h5,h5 --}}
@props(['tag' => 'h1'])

<{{ $tag }} class="font-bold text-2xl mb-4 {{ $attributes->get('class') }}">
    {{ $slot }}
    </{{ $tag }}>
