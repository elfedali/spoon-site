{{-- todo:: verify responsive ..   --}}
{{ html()->form('PUT', route('places.menu.items.update', ['item' => $dish->id]))->open() }}
{{ html()->modelForm($dish)->open() }}
{{ html()->hidden('menu_category_id', $menu->id) }}

<article x-data="{ open: false }" class="border mb-4 rounded" id="menu-item-{{ $dish->id }}">
    <header class="col-span-full flex justify-between items-center __mb-4 p-3 __border-b cursor-pointer"
        @click="open = !open">
        <div>

            <h5 class="text-lg font-semibold text-gray-800 dark:text-gray-200 leading-tight">
                <i class="fas transition-all duration-200 fa-fw fa-chevron-right text-sm mr-2 text-gray-300 dark:text-gray-400"
                    x-bind:class="{ 'fa-chevron-right': !open, 'fa-chevron-down': open }"></i>
                {{ $dish->name }}
            </h5>
        </div>
        <div>
            <span class="text-gray-800 dark:text-gray-200 leading-tight">
                {{ $dish->price }}
                MAD
            </span>
        </div>
    </header>
    <main x-show="open">
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3  p-4 mb-4">

            <div class="col-span-2">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200 leading-tight uppercase mb-4">
                    Détails de plat
                </h2>
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Nom du plat *</label>
                    {{ html()->text('name')->class('form-control')->placeholder('Nom de l\'élément de menu') }}
                </div>
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">Ingrédient de plat</label>
                    {{ html()->textarea('description')->class('form-control')->placeholder('Description de l\'élément de menu') }}
                </div>
                <div class="mb-4">
                    <label for="price" class="block text-sm font-medium text-gray-700">Prix *</label>
                    {{ html()->number('price')->class('form-control')->placeholder('Prix de l\'élément de menu') }}
                </div>

            </div>
            <div class="col-span-1">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200 leading-tight uppercase mb-4">
                    options
                </h2>
                <div class="mb-4">
                    {{-- positions --}}
                    <label for="position" class="block text-sm font-medium text-gray-700">Position</label>
                    {{ html()->number('position')->class('form-control')->placeholder('Position de l\'élément de menu') }}
                    {{-- help --}}
                    <p class="text-xs text-gray-500">La position de l'élément de menu dans la liste</p>
                </div>
                {{-- is_available with help --}}
                <div class="mb-4">
                    <label for="is_available" class="block text-sm font-medium text-gray-700">
                        Ce plat est-il disponible ?
                    </label>
                    {{ html()->checkbox('is_available')->class('') }}
                </div>
                {{-- is_vegetarian with help --}}
                <div class="mb-4">
                    <label for="is_vegetarian" class="block text-sm font-medium text-gray-700">
                        Ce plat est-il végétarien ?
                    </label>
                    {{ html()->checkbox('is_vegetarian')->class('') }}
                </div>
            </div>
        </div>
        <footer class="p-3 border-t">
            <div class="flex justify-end space-x-4">
                {{-- update --}}
                <div>
                    {{ html()->submit('Mettre à jour')->class('btn') }}
                </div>
                {{-- delete --}}
                <div>
                    <button type="button" class="btn-red-outline"
                        x-on:click="deleteItem({{ $dish->id }})">Supprimer
                        le plat</button>
                </div>
            </div>
        </footer>
    </main>
</article>

{{ html()->form()->close() }}


{{-- form delete --}}
{{ html()->form('DELETE', route('places.menu.items.destroy', ['item' => $dish->id]))->attribute('id', 'delete-menu-item-' . $dish->id)->open() }}
{{ html()->form()->close() }}
{{-- end form delete --}}

<script>
    function deleteItem(itemId) {
        if (confirm('Voulez-vous vraiment supprimer cet élément de menu?')) {
            document.getElementById('delete-menu-item-' + itemId).submit();
        }
    }

    // Check if fragment identifier exists and scroll to the corresponding element
    document.addEventListener('DOMContentLoaded', function() {
        const urlParams = new URLSearchParams(window.location.search);
        const scrollToItemId = urlParams.get('scrollTo');
        if (scrollToItemId) {
            const target = document.getElementById('menu-item-' + scrollToItemId);
            if (target) {

                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start',



                });
            }
        }
    });
</script>
