<!-- resources/views/components/badge.blade.php -->

@props(['status'])

@php
    $classes = [
        'published' =>
            'bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300',
        'draft' =>
            'bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300',
    ];

    $class = $classes[$status] ?? 'bg-gray-500 text-white';
    $translatedStatus = __('label.' . $status);
@endphp

<span class="inline-block px-2 py-1 rounded {{ $class }}">
    {{ $translatedStatus }}
</span>
