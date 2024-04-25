@php
    $input_classes = '  border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500
dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full';

    $grand_villes_maroc = [
        'Casablanca',
        'Rabat',
        'Fès',
        'Tanger',
        'Marrakech',
        'Agadir',
        'Meknès',
        'Oujda',
        'Kenitra',
        'Tétouan',
        'Safi',
        'Mohammedia',
        'Khouribga',
        'El Jadida',
        'Béni Mellal',
        'Nador',
        'Tanger',
    ];

@endphp
{{-- title --}}

<section class="grid grid-cols-1 xl:gap-4 mt-4 xl:grid-cols-3 bg-white p-4 rounded">
    <div class="col-span-2">
        <div class="mb-3">
            {{ html()->label(__('label.title_restaurant') . '*', 'title')->class('form-label') }}
            {{ html()->text('title')->class('form-control') }}

            {{-- error --}}
            @if ($errors->has('title'))
                <div class="text-red-500 text-xs mt-1">
                    {{ $errors->first('title') }}
                </div>
            @endif


        </div>
        {{-- <div class="mb-3">
            {{ html()->label(__('label.type'), 'type')->class('form-label') }}
            {{ html()->select('place_type', $places_types)->class('form-control') }}
        </div> --}}
        <div class="mb-3">
            {{ html()->label(__('label.place_service'), 'place_service')->class('form-label') }}
            {{ html()->text('place_service')->class('form-control') }}
        </div>

        <div class="mb-3">
            {{ html()->label(__('label.place_kitchen'), 'place_kitchen')->class('form-label') }}
            {{ html()->text('place_kitchen')->class('form-control') }}
        </div>

        <div class="mb-3">
            {{ html()->label(__('label.description'), 'description')->class('form-label') }}
            {{ html()->textarea('description')->class('form-control')->rows(5) }}
            {{-- help --}}
            <div class="text-gray-500 text-xs mt-1">
                {{ __('label.description_help') }}
            </div>
        </div>


        {{ html()->label(__('label.phone'), 'phone')->class('form-label') }}
        <section class="grid grid-cols-1 xl:grid-cols-3 xl:gap-3 my-4">
            <div class="form-group">
                {{ html()->text('phone')->placeholder(__('label.phone'))->class('form-control')->type('tel') }}
                {{-- help --}}
                <div class="text-gray-500 text-xs mt-1">
                    {{ __('label.phone_help') }}
                </div>
            </div>
            {{-- phone_secondary --}}
            <div class="form-group">

                {{ html()->text('phone_secondary')->placeholder(__('label.phone_secondary'))->class('form-control')->type('tel') }}
            </div>
            {{-- phone_tertiary --}}
            <div class="form-group">

                {{ html()->text('phone_tertiary')->placeholder(__('label.phone_tertiary'))->class('form-control')->type('tel') }}
            </div>
        </section>

        <div class="mb-3">
            {{ html()->label(__('label.address'), 'address')->class('form-label') }}
            {{ html()->text('address')->class('form-control') }}
        </div>
        <section class="grid grid-cols-1 xl:grid-cols-3 xl:gap-3 my-4">
            {{-- city --}}
            <div class="mb-3">
                {{ html()->label(__('label.city'), 'city')->class('form-label') }}
                {{ html()->text('city')->class('form-control') }}
            </div>
            <div class="mb-3">
                {{ html()->label(__('label.neighborhood'), 'neighborhood')->class('form-label') }}
                {{ html()->text('neighborhood')->class('form-control') }}
            </div>
            {{-- country --}}
            <div class="mb-3">
                {{ html()->label(__('label.country'), 'country')->class('form-label') }}
                {{ html()->text('country')->class('form-control')->value('Maroc') }}
            </div>
        </section>
        {{-- Todo: check this is the right in store, edit & update --}}
        <div class="mb-3">
            {{ html()->label(__('label.reservation_required'), 'reservation_required')->class('form-label') }}
            <div class="flex items-center gap-4">
                @foreach ($reservation_required as $key => $value)
                    <label class="inline-flex items-center">
                        {{ html()->radio('reservation_required', $key)->class('form-radio rounded-md shadow-sm') }}
                        <span class="ml-2 text-gray-700 dark:text-gray-200">{{ $value }}</span>
                    </label>
                @endforeach
            </div>
        </div>

    </div>
    <!-- /.col-span-2 -->
    <div class="col-span-1">
        {{-- <div class="mb-3">
            {{ html()->label(__('label.owner'), 'owner_id')->class('form-label') }}
            {{ html()->select('owner_id', $owners)->class('form-control') }}
        </div> --}}
        {{-- hidden --}}
        {{ html()->hidden('owner_id', auth()->user()->id) }}
        <div class="mb-3">
            {{ html()->label(__('label.website'), 'website')->class('form-label') }}
            {{ html()->text('website')->class('form-control') }}
        </div>

        <div class="mb-3">
            {{ html()->label(__('label.status'), 'status')->class('form-label') }}
            {{ html()->select('status', $places_statuses)->class('form-control') }}
        </div>

        <div class="mb-3">
            @if (!isset($place))
                {{ html()->submit(__('label.create'))->class('bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-md') }}
            @else
                {{ html()->submit(__('label.edit'))->class('bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-md') }}
            @endif
        </div>
    </div>
    <!-- /.col-span-1 -->

</section>
