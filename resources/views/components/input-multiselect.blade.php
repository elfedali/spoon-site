@props(['tags', 'selectedTags', 'inputName', 'has_errors' => false])
@php
    $tagsNotUsed = $tags;

    // Remove selected tags from $tagsNotUsed
    foreach ($selectedTags as $selectedTag) {
        $tagsNotUsed = array_filter($tagsNotUsed, function ($tag) use ($selectedTag) {
            return $tag['id'] !== $selectedTag['id'];
        });
    }

    // If you want to reindex the array after removing elements
    $tagsNotUsed = array_values($tagsNotUsed);

@endphp


<section x-data="{
    selected: {{ json_encode($selectedTags) }},
    availableTags: {{ json_encode($tagsNotUsed) }},
    open: false,
    searchQuery: '',

    removeFromSelected(index) {
        const removedTag = this.selected.splice(index, 1)[0];
        this.availableTags.push(removedTag);
        this.availableTags.sort((a, b) => a.name.localeCompare(b.name)); // Sort alphabetically
    },
    addToSelected(tag) {
        this.selected.push(tag);
        this.availableTags = this.availableTags.filter(t => t !== tag);
    }


}" x-init="console.log(availableTags)"
    class="relative border {{ $has_errors ? 'border-red-500 ' : 'border-gray-300 ' }}rounded-md dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300  focus:border-primary w-full p-1 text-sm"
    @click.away="open = false" x-on:click="open = true; $refs.searchQuery.focus()">

    <template x-for="(selectedTag, index) in selected" :key="index">
        <article class="px-2 py-1 bg-indigo-50 inline-block rounded-lg mb-1 mr-2">
            <div class="flex justify-between ">
                <div class="pr-2 text-primary">
                    <span x-text="selectedTag.name"></span>
                </div>
                <div class="text-primary hover:text-red-500 cursor-pointer transition duration-150 ease-in-out"
                    x-on:click.prevent="removeFromSelected(index)">
                    <i class="fa fa-close"></i>
                </div>
            </div>
        </article>
    </template>


    <input type="text" x-model="searchQuery"
        class="inline-block bg-slate-0 p-1 rounded-lg border-transparent focus:ring-0 focus:ring-white focus:border-none border-0"
        x-on:click="open=true" x-on:keydown.esc.prevent="open = false" x-ref="searchQuery" x-on:keydown.enter.prevent>


    <div x-show="open" class="w-full overflow-y-scroll bg-white max-h-32">
        <template
            x-for="(tag, index) in availableTags.filter(t => !selected.includes(t.name) && t.name.toLowerCase().includes(searchQuery.toLowerCase()))"
            :key="index">
            <div class="cursor-pointer hover:bg-gray-100 px-2 py-1"
                x-on:click="addToSelected(tag); open = false; searchQuery = ''">
                <span x-text="tag.name"></span>
            </div>

        </template>
    </div>

    <input type="hidden" name="{{ $inputName }}" :value="JSON.stringify(selected)">
</section>
