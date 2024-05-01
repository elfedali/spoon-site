@php
    $cities = ['Casablanca', 'Mohammedia', 'Rabat', 'Fès', 'Tanger', 'Marrakech', 'Sale'];
    $terms_services = \App\Models\Term::where('taxonomy', \App\Models\Term::TYPE_SERVICE)
        #->orderBy('name')
        ->select('id', 'name')
        ->get()
        ->toArray();
    $terms_kitchens = \App\Models\Term::where('taxonomy', \App\Models\Term::TYPE_KITCHEN)
        #->orderBy('name')
        ->select('id', 'name')
        ->get()
        ->toArray();

    $place__terms_service = $place->terms
        ->where('taxonomy', \App\Models\Term::TYPE_SERVICE)
        ->map(function ($term) {
            return [
                'id' => $term->id,
                'name' => $term->name,
            ];
        })
        ->values()
        ->toArray();

    $place__terms_kitchen = $place->terms
        ->where('taxonomy', \App\Models\Term::TYPE_KITCHEN)
        ->map(function ($term) {
            return [
                'id' => $term->id,
                'name' => $term->name,
            ];
        })
        ->values()
        ->toArray();

    //dd($place__terms_kitchen, $place__terms_service);

@endphp
{{-- title --}}

<section class="grid grid-cols-1 xl:gap-4 mt-4 xl:grid-cols-3 bg-white p-6 rounded">
    <div class="col-span-2">
        <div class="mb-5">
            {{ html()->label(__('label.title_restaurant') . '<span class="text-red-500">*</span>', 'title')->class('form-label ') }}
            {{ html()->text('title')->class('form-control ' . ($errors->has('title') ? 'border border-red-500' : '')) }}

            {{-- error --}}
            @if ($errors->has('title'))
                <div class="text-red-500 text-xs mt-2">
                    {{ $errors->first('title') }}
                </div>
            @endif

        </div>

        <div class="mb-5">
            {{ html()->label(__('label.place_kitchen') . '<span class="text-red-500">*</span>', 'place_kitchen')->class('form-label') }}
            <x-input-multiselect :tags="$terms_kitchens" inputName="place_kitchen" :selectedTags="$place__terms_kitchen"></x-input-multiselect>
            {{-- error --}}
            @if ($errors->has('place_kitchen'))
                <div class="text-red-500 text-xs mt-1">
                    {{ $errors->first('place_kitchen') }}
                </div>
            @endif
        </div>
        <div class="mb-5">
            {{ html()->label(__('label.place_service') . '<span class="text-red-500">*</span>', 'place_service')->class('form-label') }}
            <x-input-multiselect :tags="$terms_services" inputName="place_service" :selectedTags="$place__terms_service"></x-input-multiselect>
            {{-- error --}}
            @if ($errors->has('place_service'))
                <div class="text-red-500 text-xs mt-1">
                    {{ $errors->first('place_service') }}
                </div>
            @endif
        </div>

        <div class="mb-5 hidden">
            {{ html()->label(__('label.description'), 'description')->class('form-label') }}
            {{ html()->textarea('description')->class('form-control ' . ($errors->has('description') ? 'border border-red-500' : ''))->rows(5) }}
            {{-- help --}}
            <div class="text-gray-500 text-xs mt-1">
                {{ __('label.description_help') }}
            </div>
            {{-- error --}}
            @if ($errors->has('description'))
                <div class="text-red-500 text-xs mt-1">
                    {{ $errors->first('description') }}
                </div>
            @endif
        </div>

        <div class="relative">
            <input type="text" id="floating_outlined"
                class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder=" " />
            <label for="floating_outlined"
                class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Floating
                outlined</label>
        </div>
        {{ html()->label(__('label.phone'), 'phone')->class('form-label') }}
        <section class="grid grid-cols-1 xl:grid-cols-3 xl:gap-3 mb-4">
            <div class="form-group">
                {{ html()->text('phone')->placeholder(__('label.phone'))->class('form-control ' . ($errors->has('phone') ? 'border border-red-500' : ''))->type('tel') }}
                {{-- error --}}
                @if ($errors->has('phone'))
                    <div class="text-red-500 text-xs mt-1">
                        {{ $errors->first('phone') }}
                    </div>
                @endif
            </div>
            {{-- phone_secondary --}}
            <div class="form-group">

                {{ html()->text('phone_secondary')->placeholder(__('label.phone_secondary'))->class('form-control ' . ($errors->has('phone_secondary') ? 'border border-red-500' : ''))->type('tel') }}
                {{-- error --}}
                @if ($errors->has('phone_secondary'))
                    <div class="text-red-500 text-xs mt-1">
                        {{ $errors->first('phone_secondary') }}
                    </div>
                @endif
            </div>
            {{-- phone_tertiary --}}
            <div class="form-group">

                {{ html()->text('phone_tertiary')->placeholder(__('label.phone_tertiary'))->class('form-control ' . ($errors->has('phone_tertiary') ? 'border border-red-500' : ''))->type('tel') }}
                {{-- error --}}
                @if ($errors->has('phone_tertiary'))
                    <div class="text-red-500 text-xs mt-1">
                        {{ $errors->first('phone_tertiary') }}
                    </div>
                @endif
            </div>
        </section>

        <div class="mb-5">
            {{ html()->label(__('label.address'), 'address')->class('form-label') }}
            {{ html()->text('address')->class('form-control ' . ($errors->has('address') ? 'border border-red-500' : '')) }}
            {{-- error --}}
            @if ($errors->has('address'))
                <div class="text-red-500 text-xs mt-1">
                    {{ $errors->first('address') }}
                </div>
            @endif
        </div>
        <section class="grid grid-cols-1 xl:grid-cols-3 xl:gap-3 my-4">
            {{-- city --}}
            <div class="mb-5">
                {{ html()->label(__('label.city') . ' *', 'city')->class('form-label') }}
                {{ html()->select('city', $cities)->class('form-control ' . ($errors->has('city') ? 'border border-red-500' : '')) }}
                {{-- error --}}
                @if ($errors->has('city'))
                    <div class="text-red-500 text-xs mt-1">
                        {{ $errors->first('city') }}
                    </div>
                @endif
            </div>
            <div class="mb-5">
                {{ html()->label(__('label.neighborhood'), 'neighborhood')->class('form-label') }}
                {{ html()->text('neighborhood')->class('form-control ' . ($errors->has('neighborhood') ? 'border border-red-500' : '')) }}
                {{-- error   --}}
                @if ($errors->has('neighborhood'))
                    <div class="text-red-500 text-xs mt-1">
                        {{ $errors->first('neighborhood') }}
                    </div>
                @endif
            </div>
            {{-- country --}}
            <div class="mb-5">
                {{ html()->label(__('label.country'), 'country')->class('form-label') }}
                {{ html()->text('country')->class('form-control bg-gray-100  cursor-not-allowed ' . ($errors->has('country') ? 'border border-red-500' : ''))->value('Maroc')->disabled() }}
                {{-- error   --}}
                @if ($errors->has('country'))
                    <div class="text-red-500 text-xs mt-1">
                        {{ $errors->first('country') }}
                    </div>
                @endif
            </div>
        </section>
        {{-- Todo: check this is the right in store, edit & update --}}
        <div class="mb-5">
            <div class="bg-gray-50 p-3 rounded">
                {{ html()->label(__('label.reservation_required'), 'reservation_required')->class('form-label') }}
                <div class="flex items-center gap-4 ">
                    @foreach ($reservation_required as $key => $value)
                        <label class="inline-flex items-center">
                            {{ html()->radio('reservation_required', $key)->value($key)->class('form-radio rounded-md shadow-sm') }}
                            <span class="ml-2 text-gray-700 dark:text-gray-200">{{ $value }}</span>
                        </label>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
    <!-- /.col-span-2 -->
    <div class="col-span-1">
        {{-- <div class="mb-5">
            {{ html()->label(__('label.owner'), 'owner_id')->class('form-label') }}
            {{ html()->select('owner_id', $owners)->class('form-control') }}
        </div> --}}
        {{-- hidden --}}
        {{ html()->hidden('owner_id', auth()->user()->id) }}
        <div class="mb-5">
            {{ html()->label(__('label.website'), 'website')->class('form-label') }}
            {{ html()->text('website')->class('form-control ' . ($errors->has('website') ? 'border border-red-500' : '')) }}
            {{-- error --}}
            @if ($errors->has('website'))
                <div class="text-red-500 text-xs mt-1">
                    {{ $errors->first('website') }}
                </div>
            @endif
        </div>

        <div class="mb-5">
            {{ html()->label(__('label.status'), 'status')->class('form-label') }}
            {{ html()->select('status', $places_statuses)->class('form-control ' . ($errors->has('status') ? 'border border-red-500' : '')) }}
            {{-- error --}}
            @if ($errors->has('status'))
                <div class="text-red-500 text-xs mt-1">
                    {{ $errors->first('status') }}
                </div>
            @endif
        </div>

        <div class="mb-5">
            @if (!isset($place))
                {{ html()->submit(__('label.create'))->class('bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-md') }}
            @else
                {{ html()->submit(__('label.edit'))->class('bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-md') }}
            @endif
        </div>
    </div>
    <!-- /.col-span-1 -->

</section>
