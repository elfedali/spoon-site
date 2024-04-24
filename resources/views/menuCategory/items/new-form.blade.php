{{ html()->form('POST', route('places.menu.items.store'))->open() }}
{{ html()->hidden('menu_category_id', $menu->id) }}

<article x-data="{ open: true }" class="border mb-4 rounded border-gray-500">

    <main x-show="open">
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3  p-4 mb-4">

            <div class="col-span-2">
                <h2 class="text-xs  text-gray-800 dark:text-gray-200 leading-tight uppercase mb-4">
                    Détails de plat
                </h2>
                <div class="mb-4">
                    <label for="name" class="block text-xs text-gray-700">Nom du plat *</label>
                    {{ html()->text('name')->class('form-control')->value(old('name')) }}
                    <div>
                        @error('name')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                    {{-- help --}}
                    <p class="text-xs text-gray-500">Le nom de plat</p>
                </div>
                <div class="mb-4">
                    <label for="description" class="block text-xs text-gray-700">Ingrédient de plat</label>
                    {{ html()->textarea('description')->class('form-control')->value(old('description')) }}
                    <div>
                        @error('description')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                    {{-- help --}}
                    <p class="text-xs text-gray-500">Les ingrédients de plat séparés par des virgules</p>
                </div>
                <div class="mb-4">
                    <label for="price" class="block text-xs text-gray-700">Prix *</label>
                    {{ html()->number('price')->class('form-control')->value(old('price')) }}
                    <div>
                        @error('price')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                    {{-- help --}}

                    <p class="text-xs text-gray-500">Le prix de plat dans la carte en MAD</p>
                </div>

            </div>
            <div class="col-span-1">
                <h2 class="text-xs text-gray-800 dark:text-gray-200 leading-tight uppercase mb-4">
                    options
                </h2>
                <div class="mb-4">
                    {{-- positions --}}
                    <label for="position" class="block text-xs text-gray-700">Position</label>
                    {{ html()->number('position')->class('form-control')->value(old('position')) }}

                    <div>
                        @error('position')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                    {{-- help --}}
                    <p class="text-xs text-gray-500">La position de l'élément de menu dans la liste</p>
                </div>
                {{-- is_available with help --}}
                <div class="mb-4">
                    <label for="is_available" class="block text-xs text-gray-700">
                        Ce plat est-il disponible ?
                    </label>
                    {{ html()->checkbox('is_available')->class('')->value(old('is_available')) }}
                    <div>
                        @error('is_available')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                {{-- is_vegetarian with help --}}
                <div class="mb-4">
                    <label for="is_vegetarian" class="block text-xs text-gray-700">
                        Ce plat est-il végétarien ?
                    </label>

                    {{ html()->checkbox('is_vegetarian')->class('')->value(old('is_vegetarian')) }}
                    @error('is_vegetarian')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror

                </div>
            </div>
        </div>
        <footer class="p-3 border-t border-gray-500">
            <div class="flex justify-end space-x-4">
                {{-- save new item --}}
                <div>
                    {{ html()->submit(__('label.save'))->class('btn') }}
                </div>

            </div>
        </footer>
    </main>
</article>

{{ html()->form()->close() }}
