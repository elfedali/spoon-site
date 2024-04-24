<x-app-layout>

    <div>
        <a href="{{ route('places.index') }}" class="text-indigo-600 dark:text-indigo-400 hover:underline">
            {{ __('label.all') }}
        </a>
    </div>
    <h1 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 leading-tight">
        {{ $place->title }}
    </h1>
    @include('place._tab')



    <div class="bg-white p-5 rounded ">
        <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200 leading-tight mb-4">
            Ajouter une image
        </h2>
        {{ html()->form('POST', route('places.gallery.store', ['place' => $place->id]))->attribute('enctype', 'multipart/form-data')->open() }}
        {{ html()->hidden('place_id', $place->id) }}
        <div class="mb-4">
            {{ html()->file('image')->class('form-control') }}
        </div>
        <div>
            {{ html()->submit('Ajouter une image')->class('btn') }}
        </div>
        {{ html()->form()->close() }}
    </div>

    <section class="">
        @foreach ($gallery as $media)
            <article class="border bg-gray-500 p-5 mb-4 rounded " <figure>
                <div>
                    <img src="{{ $media->getUrl() }}" class="rounded" />
                </div>
                <div class="mt-4">
                    {{ html()->form(
                            'DELETE',
                            route('places.gallery.destroy', [
                                'mediaId' => $media->id,
                                'place' => $place,
                            ]),
                        )->open() }}
                    <x-danger-button type="submit"
                        onclick="retrun confirm('Etes-vous sûr de vouloir supprimer cette image ?')">{{ __('label.delete') }}</x-danger-button>
                    {{ html()->form()->close() }}
                </div>

                </figure>
            </article>
        @endforeach
    </section>

</x-app-layout>
