{{-- errors --}}
@php
    $status = ['published' => 'Publié', 'draft' => 'Brouillon'];
@endphp
<div>
    {{ html()->label('Titre', 'title')->class('block text-sm font-medium text-gray-700 dark:text-gray-200') }}
    {{ html()->text('title')->class('mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300') }}
</div>

{{-- content textarea --}}
<div>
    {{ html()->label('Contenu', 'content')->class('block text-sm font-medium text-gray-700 dark:text-gray-200') }}
    {{ html()->textarea('content')->class('mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300') }}
</div>

{{-- status --}}
<div>
    {{ html()->label('Status', 'status')->class('block text-sm font-medium text-gray-700 dark:text-gray-200') }}
    {{ html()->select('status', $status)->class('mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300') }}
</div>
