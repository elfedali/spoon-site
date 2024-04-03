<div class="p-4 bg-gray-200 dark:bg-gray-900">
    {{ html()->form('POST', route('places.menu.items.store'))->open() }}
    {{ html()->hidden('menu_category_id', $menu->id) }}
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
    <div class="mb-4">
        <label for="position" class="block text-sm font-medium text-gray-700">Position</label>
        {{ html()->number('position')->class('form-control')->placeholder('Position de l\'élément de menu') }}
        {{-- help --}}
        <p class="text-xs text-gray-500">La position de l'élément de menu dans la liste</p>
    </div>

    <div>
        {{ html()->submit('Ajouter un élément de menu')->class('btn') }}
    </div>
    {{ html()->form()->close() }}
</div>
