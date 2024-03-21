<div class="mb-4">
    {{ html()->label('Titre', 'title')->class('block text-gray-700 text-sm font-bold mb-2') }}
    {{ html()->text('title')->class('form-input w-full') }}
</div>
<div class="mb-4">
    {{ html()->label('Contenu', 'content')->class('block text-gray-700 text-sm font-bold mb-2') }}
    {{ html()->textarea('content')->class('form-input w-full') }}
</div>
{{-- status --}}
<div class="mb-4">
    {{ html()->label('Statut', 'status')->class('block text-gray-700 text-sm font-bold mb-2') }}
    {{ html()->select('status', $status_array)->class('form-select w-full') }}
</div>
