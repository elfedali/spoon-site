@php
    // $cities = ['Casablanca', 'Mohammedia', 'Rabat', 'Fès', 'Tanger', 'Marrakech', 'Sale'];
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
    $place__terms_service = [];
    $place__terms_kitchen = [];

    if (isset($place)) {
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
    }

    // cities
    $cities = \App\Models\City::select('id', 'name')->get()->toArray();
    $options_city = []; //['name'],
    foreach ($cities as $key => $city) {
        $options_city[$city['id']] = $city['name'];
    }

    // dump($place);
    /**
     * @var \App\Models\City
     *
     */
    $selected_city = null;
    $neighborhoods = null;
    if (isset($place)):
        $selected_city = \App\Models\City::where('id', $place->city ?? old('city'))->first();

        $neighborhoods = $selected_city->streets->select('id', 'name')->toArray();
        // dump($neighborhoods);
    else:
        $selected_city = \App\Models\City::where('id', old('city') ?? 1)->first();
        $neighborhoods = $selected_city->streets->select('id', 'name')->toArray();
    endif;

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
        @php
            $kitchen_has_errors = $errors->has('place_kitchen') ? true : false;
            $service_has_errors = $errors->has('place_service') ? true : false;
        @endphp
        <div class="mb-5">
            {{ html()->label(__('label.place_kitchen') . '<span class="text-red-500">*</span>', 'place_kitchen')->class('form-label') }}
            <x-input-multiselect :tags="$terms_kitchens" inputName="place_kitchen" :selectedTags="$place__terms_kitchen"
                :has_errors="$kitchen_has_errors"></x-input-multiselect>
            {{-- error --}}
            @if ($errors->has('place_kitchen'))
                <div class="text-red-500 text-xs mt-1">
                    {{ $errors->first('place_kitchen') }}
                </div>
            @endif
        </div>
        <div class="mb-5">
            {{ html()->label(__('label.place_service') . '<span class="text-red-500">*</span>', 'place_service')->class('form-label') }}
            <x-input-multiselect :tags="$terms_services" inputName="place_service" :selectedTags="$place__terms_service"
                :has_errors="$service_has_errors"></x-input-multiselect>
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


        {{ html()->label(__('label.phone'), 'phone')->class('form-label') }}
        <section class="grid grid-cols-1 xl:grid-cols-3 xl:gap-3 mb-4">
            <div class="form-group">
                <x-input-floating-outlined name="phone" label="{{ __('label.phone_1') }}" :value="$place->phone ?? ''"
                    :has_errors="$errors->has('phone') ? true : false" :required="true"></x-input-floating-outlined>

            </div>
            {{-- phone_secondary --}}
            <div class="form-group">

                <x-input-floating-outlined name="phone_secondary" label="{{ __('label.phone_secondary') }}"
                    :value="$place->phone_secondary ?? ''" :has_errors="$errors->has('phone_secondary') ? true : false"></x-input-floating-outlined>
            </div>
            {{-- phone_tertiary --}}
            <div class="form-group">

                <x-input-floating-outlined name="phone_tertiary" label="{{ __('label.phone_tertiary') }}"
                    :value="$place->phone_tertiary ?? ''" :has_errors="$errors->has('phone_tertiary') ? true : false"></x-input-floating-outlined>
            </div>
        </section>

        <div class="mb-5">
            {{ html()->label(__('label.address_restaurant') . ' <span class="text-red-500">*</span>', 'address')->class('form-label') }}
            {{ html()->text('address')->class('form-control ' . ($errors->has('address') ? 'border border-red-500' : ''))->placeholder(__('label.address_restaurant_placeholder')) }}
            {{-- error --}}
            @if ($errors->has('address'))
                <div class="text-red-500 text-xs mt-1">
                    {{ $errors->first('address') }}
                </div>
            @endif
        </div>
        <section class="grid grid-cols-1 xl:grid-cols-3 xl:gap-3 my-4" x-data="app()">
            {{-- city --}}

            <div class="mb-5">
                {{ html()->label(__('label.city') . '  <span class="text-red-500">*</span>', 'city')->class('form-label') }}
                {{ html()->select('city', $options_city)->class('form-control' . ($errors->has('city') ? 'border border-red-500' : ''))->attributes(['x-on:change' => 'updateNeighborhoods($event.target.value)']) }}
                {{-- error --}}
                @if ($errors->has('city'))
                    <div class="text-red-500 text-xs mt-1">
                        {{ $errors->first('city') }}
                    </div>
                @endif
            </div>
            <div class="mb-5">
                {{ html()->label(__('label.neighborhood') . ' <span class="text-red-500">*</span>', 'neighborhood')->class('form-label') }}
                {{-- {{ html()->select('neighborhood', [])->class('form-control')->attributes(['x-model' => 'selectedNeighborhood']) }} --}}
                <select name="neighborhood" id="" class="form-control" x-model="selectedNeighborhood">
                    <template x-for="neighborhood in neighborhoods" :key="neighborhood.id">
                        <option :value="neighborhood.id" x-text="neighborhood.name"
                            :selected="neighborhood.id == selectedNeighborhood"></option>

                    </template>
                </select>
                {{-- error --}}
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

        <div class="mb-5">
            @php
                $reservationRequired = isset($place) ? $place->reservation_required : null;
            @endphp

            <section
                class="bg-gray-50 p-3 rounded-lg border border-gray-100 {{ $errors->has('reservation_required') ? 'border-red-500' : '' }}">
                {{ html()->label(__('label.reservation_table') . '<span class="text-red-500"> *</span>', 'reservation_required')->class('form-label mb-1') }}

                <p class="mb-4">
                    {{ __('label.reservation_required') }}
                </p>

                <div class="flex items-center mb-3">
                    <input {{ $reservationRequired === false ? 'checked' : '' }} id="reservation_required-1"
                        type="radio" value="false" name="reservation_required"
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="reservation_required-1"
                        class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                        Non, réservation non nécessaire
                    </label>
                </div>
                <div class="flex items-center">
                    <input {{ $reservationRequired === true ? 'checked' : '' }} id="reservation_required-2"
                        type="radio" value="true" name="reservation_required"
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="reservation_required-2"
                        class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                        Oui, réservation nécessaire
                    </label>
                </div>
                @if ($errors->has('reservation_required'))
                    <div class="text-red-500 text-xs mt-4">
                        {{ $errors->first('reservation_required') }}
                    </div>
                @endif
            </section>
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
<script>
    function app() {
        return {
            neighborhoods: @json($neighborhoods), // Set initial value from $neighborhoods
            selectedNeighborhood: @json($place->neighborhood ?? null), // Set initial value from $place->neighborhood_id if available
            updateNeighborhoods(cityId) {
                fetch('/api/streets/' + cityId)
                    .then(response => response.json())
                    .then(data => {
                        this.neighborhoods = data;
                        // Check if the selectedNeighborhood is still available in the fetched data
                        if (!this.neighborhoods.some(neighborhood => neighborhood.id === this
                                .selectedNeighborhood)) {
                            this.selectedNeighborhood = null; // Reset selected neighborhood if it's not available
                        }
                    });
            }
        }
    }
</script>


@push('scripts')
    <script>
        window.addEventListener('load', () => {
            Alpine.bind('body');
        });
    </script>
@endpush
