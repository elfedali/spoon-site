<section>

    <p class="text-lg font-semibold dark:text-gray-200">
        Nouveau terme
    </p>

    {{ html()->form('POST', route('terms.store'))->open() }}
    <div class="mt-4">

        <x-input-label for="name" :value="__('label.name') . '*'" />
        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" required />
        <x-input-error :messages="$errors->get('name')" class="mt-2" />

    </div>
    {{-- select  terms : kitchen, service --}}
    <div class="mt-4">
        <x-input-label for="taxonomy" :value="__('label.taxonomy') . '*'" />
        <x-select-input id="taxonomy" name="taxonomy" class="mt-1 block w-full" required>
            <option value="" selected disabled>{{ __('label.select') }}</option>
            <option value="kitchen">{{ __('label.kitchen') }}</option>
            <option value="service">{{ __('label.service') }}</option>
            <option value="amenity">{{ __('label.amenity') }}</option>
        </x-select-input>
        <x-input-error :messages="$errors->get('taxonomy')" class="mt-2" />
    </div>
    {{-- button --}}
    <div class="flex items-center gap-4 mt-4">
        <x-primary-button>{{ __('label.button.save') }}</x-primary-button>
        {{-- todo:: session status model saved  --}}
    </div>
    {{ html()->form()->close() }}
</section>
