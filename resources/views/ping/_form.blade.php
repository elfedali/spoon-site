<div class="form-group mb-3">
    <label for="place_id">Lieu</label>
    {{ html()->select('place_id', $places)->class(['form-control', 'is-invalid' => $errors->has('place_id')])->required() }}
    @error('place_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
{{-- description --}}
<div class="form-group mb-3">
    <label for="description">Description</label>
    {{ html()->textarea('description')->class(['form-control', 'is-invalid' => $errors->has('description')])->required() }}
    @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<div class="form-group mb-3">
    <label for="date_start">Date de début</label>
    {{ html()->date('date_start')->class(['form-control', 'is-invalid' => $errors->has('date_start')])->required() }}
    @error('date_start')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<div class="form-group mb-3">
    <label for="date_end">Date de fin</label>
    {{ html()->date('date_end')->class(['form-control', 'is-invalid' => $errors->has('date_end')])->required() }}
    @error('date_end')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
