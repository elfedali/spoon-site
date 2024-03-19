<div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
    {{-- select place_id --}}
    <div>
        {{ html()->label('Place', 'place_id')->class('block text-sm font-medium text-gray-700 dark:text-gray-200') }}
        {{ html()->select('place_id', $places)->class('mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300') }}
    </div>
    <div>
        {{ html()->label('Title', 'title')->class('block text-sm font-medium text-gray-700 dark:text-gray-200') }}
        {{ html()->text('title')->class('mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300') }}
    </div>
    <div>
        {{ html()->label('Description', 'description')->class('block text-sm font-medium text-gray-700 dark:text-gray-200') }}
        {{ html()->text('description')->class('mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300') }}
    </div>
    <div>
        {{ html()->label('Start Date', 'date_start')->class('block text-sm font-medium text-gray-700 dark:text-gray-200') }}
        {{ html()->date('date_start')->class('mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300') }}
    </div>
    <div>
        {{ html()->label('End Date', 'date_end')->class('block text-sm font-medium text-gray-700 dark:text-gray-200') }}
        {{ html()->date('date_end')->class('mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300') }}
    </div>
</div>
