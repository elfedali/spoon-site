{{-- add menu item --}}
<x-modal name="add-menu-item" :show="false">
    {{-- event detail menu_id --}}

    <input type="text" name="menu_id" x-model="menuId">
    {{-- <form method="post" action="{{ route('places.menu.store', 1) }}" class="p-6">
        @csrf
        <input type="hidden" name="menu_id" x-model="menuId">
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Add Menu Item') }}
        </h2>
        <!-- Add your form fields for adding a menu item here -->

        <div class="mt-6 flex justify-end">
            <x-secondary-button x-on:click="$dispatch('close')">
                {{ __('Cancel') }}
            </x-secondary-button>
            <x-danger-button class="ms-3" x-on:click="$dispatch('close')">
                {{ __('Add Menu Item') }}
            </x-danger-button>
        </div>
    </form> --}}
</x-modal>
