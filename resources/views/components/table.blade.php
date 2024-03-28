@props(['class' => ''])

<table
    {{ $attributes->merge(['class' => 'min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-600 border ']) }}>
    {{ $slot }}
</table>
