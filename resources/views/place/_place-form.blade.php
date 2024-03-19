@php
    $input_classes = 'border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500
dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full';
@endphp
{{-- title --}}

<div class="form-group">
    {{ html()->label(__('label.title'), 'title')->class('block font-medium text-sm text-gray-700 dark:text-gray-200') }}
    {{ html()->text('title')->class($input_classes) }}
</div>

{{-- places_type --}}
<div class="form-group">
    {{ html()->label(__('label.type'), 'type')->class('block font-medium text-sm text-gray-700 dark:text-gray-200') }}
    {{ html()->select('place_type', $places_types)->class('form-select rounded-md shadow-sm') }}
</div>
<div class="form-group">
    {{ html()->label(__('label.description'), 'description')->class('block font-medium text-sm text-gray-700 dark:text-gray-200') }}
    {{ html()->textarea('description')->class($input_classes) }}
</div>
<div class="form-group">
    {{ html()->label(__('label.owner'), 'owner_id')->class('block font-medium text-sm text-gray-700 dark:text-gray-200') }}
    {{ html()->select('owner_id', $owners)->class('form-select rounded-md shadow-sm') }}
</div>
{{-- phone --}}
<div class="form-group">
    {{ html()->label(__('label.phone'), 'phone')->class('block font-medium text-sm text-gray-700 dark:text-gray-200') }}
    {{ html()->text('phone')->class($input_classes) }}
</div>
{{-- phone_secondary --}}
<div class="form-group">
    {{ html()->label(__('label.phone_secondary'), 'phone_secondary')->class('block font-medium text-sm text-gray-700 dark:text-gray-200') }}
    {{ html()->text('phone_secondary')->class($input_classes) }}
</div>
{{-- phone_tertiary --}}
<div class="form-group">
    {{ html()->label(__('label.phone_tertiary'), 'phone_tertiary')->class('block font-medium text-sm text-gray-700 dark:text-gray-200') }}
    {{ html()->text('phone_tertiary')->class($input_classes) }}
</div>

<div class="form-group">
    {{ html()->label(__('label.address'), 'address')->class('block font-medium text-sm text-gray-700 dark:text-gray-200') }}
    {{ html()->text('address')->class($input_classes) }}
</div>
<div class="form-group">
    {{ html()->label(__('label.city'), 'city')->class('block font-medium text-sm text-gray-700 dark:text-gray-200') }}
    {{ html()->text('city')->class($input_classes) }}
</div>
<div class="form-group">
    {{ html()->label(__('label.state'), 'state')->class('block font-medium text-sm text-gray-700 dark:text-gray-200') }}
    {{ html()->text('state')->class($input_classes) }}
</div>
<div class="form-group">
    {{ html()->label(__('label.zip'), 'zip')->class('block font-medium text-sm text-gray-700 dark:text-gray-200') }}
    {{ html()->text('zip')->class($input_classes) }}
</div>
<div class="form-group">
    {{ html()->label(__('label.country'), 'country')->class('block font-medium text-sm text-gray-700 dark:text-gray-200') }}
    {{ html()->text('country')->class($input_classes) }}
</div>
<div class="form-group">
    {{ html()->label(__('label.latitude'), 'latitude')->class('block font-medium text-sm text-gray-700 dark:text-gray-200') }}
    {{ html()->text('latitude')->class($input_classes) }}
</div>
<div class="form-group">
    {{ html()->label(__('label.longitude'), 'longitude')->class('block font-medium text-sm text-gray-700 dark:text-gray-200') }}
    {{ html()->text('longitude')->class($input_classes) }}
</div>
<div class="form-group">
    {{ html()->label(__('label.published'), 'published')->class('block font-medium text-sm text-gray-700 dark:text-gray-200') }}
    {{ html()->checkbox('published')->class('form-checkbox rounded-md shadow-sm') }}
</div>
<div class="form-group">
    {{ html()->label(__('label.featured'), 'featured')->class('block font-medium text-sm text-gray-700 dark:text-gray-200') }}
    {{ html()->checkbox('featured')->class('form-checkbox rounded-md shadow-sm') }}
</div>
<div class="form-group">
    {{ html()->label(__('label.image'), 'image')->class('block font-medium text-sm text-gray-700 dark:text-gray-200') }}
    {{ html()->file('image')->class($input_classes) }}
</div>
<div class="form-group">
    {{ html()->label(__('label.gallery'), 'gallery')->class('block font-medium text-sm text-gray-700 dark:text-gray-200') }}
    {{ html()->file('gallery[]')->class($input_classes)->multiple() }}
</div>
{{-- website --}}
<div class="form-group">
    {{ html()->label(__('label.website'), 'website')->class('block font-medium text-sm text-gray-700 dark:text-gray-200') }}
    {{ html()->text('website')->class($input_classes) }}
</div>
{{-- status --}}
<div class="form-group">
    {{ html()->label(__('label.status'), 'status')->class('block font-medium text-sm text-gray-700 dark:text-gray-200') }}
    {{ html()->select('status', $places_statuses)->class('form-select rounded-md shadow-sm') }}
</div>
{{-- reservation_required  radio --}}
{{-- Todo: check this is the right in store, edit & update --}}
<div class="form-group">
    {{ html()->label(__('label.reservation_required'), 'reservation_required')->class('block font-medium text-sm text-gray-700 dark:text-gray-200') }}
    <div class="flex items-center gap-4">
        @foreach ($reservation_required as $key => $value)
            <label class="inline-flex items-center">
                {{ html()->radio('reservation_required', $key)->class('form-radio rounded-md shadow-sm') }}
                <span class="ml-2 text-gray-700 dark:text-gray-200">{{ $value }}</span>
            </label>
        @endforeach
    </div>
</div>

<div class="form-group">
    @if (!isset($place))
        {{ html()->submit(__('label.create'))->class('bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-md') }}
    @else
        {{ html()->submit(__('label.edit'))->class('bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-md') }}
    @endif
</div>
