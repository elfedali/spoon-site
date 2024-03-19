<section>



    {{ html()->form('PUT', route('terms.update', $term->id))->open() }}
    <div class="mt-4">

        <x-input-label for="name" :value="__('label.name') . '*'" />
        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" required
            value="{{ old('name', $term->name) }}" />
        <x-input-error :messages="$errors->get('name')" class="mt-2" />

    </div>
    {{-- select  terms : kitchen, service --}}
    <div class="mt-4">
        <x-input-label for="taxonomy" :value="__('label.taxonomy') . '*'" />
        <x-select-input id="taxonomy" name="taxonomy" class="mt-1 block w-full" required>
            <option value="" disabled>{{ __('label.select') }}</option>
            <option value="kitchen" {{ old('taxonomy', $term->taxonomy) === 'kitchen' ? 'selected' : '' }}>
                {{ __('label.kitchen') }}
            </option>

            <option value="service" {{ old('taxonomy', $term->taxonomy) === 'service' ? 'selected' : '' }}>
                {{ __('label.service') }}
            </option>
            <option value="amenity" {{ old('taxonomy', $term->taxonomy) === 'amenity' ? 'selected' : '' }}>
                {{ __('label.amenity') }}
            </option>

        </x-select-input>
        <x-input-error :messages="$errors->get('taxonomy')" class="mt-2" />
    </div>
    {{-- button --}}
    <div class="flex items-center gap-4 mt-4">
        <x-primary-button>{{ __('label.edit') }}</x-primary-button>
        {{-- todo:: session status model saved  --}}
    </div>
    {{ html()->form()->close() }}
</section>

{{-- delete for --}}
<section class="mt-4">
    {{ html()->form('DELETE', route('terms.destroy', $term->id))->open() }}
    <x-danger-button onclick="return confirm('Are you sure?')">
        {{ __('label.delete') }}
    </x-danger-button>
    {{ html()->form()->close() }}
</section>
