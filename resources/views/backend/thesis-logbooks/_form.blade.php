<!-- thesis Topic select Field Input -->
<div class="form-group">
    <label class="form-label" for="supervisor_id">Supervisor:</label>
    {{ html()->select('supervisor_id',$supervisors)->class(["form-control", "is-invalid" => $errors->has('supervisor_id')])->id('supervisor_id') }}
    @error('supervisor_id')
    <div class="invalid-feedback">{{ $errors->first('supervisor_id') }}</div>
    @enderror
</div>

<div class="form-group">
    <label class="form-label" for="date">Tanggal:</label>
    {{ html()->date('date')->class(["form-control", "is-invalid" => $errors->has('date')])->id('date') }}
    @error('date')
    <div class="invalid-feedback">{{ $errors->first('date') }}</div>
    @enderror
</div>

<div class="form-group">
    <label class="form-label" for="progress">Progress TA:</label>
    {{ html()->textarea('progress')->class(["form-control", "is-invalid" => $errors->has('progress')])->id('progress')->placeholder('Tuliskan Progress Tugas Akhir') }}
    @error('progress')
    <div class="invalid-feedback">{{ $errors->first('progress') }}</div>
    @enderror
</div>

<div class="form-group">
    <label class="form-label" for="files_progress">File Progress:</label>
    {{ html()->file('files_progress')->class(["form-control-file", "is-invalid" => $errors->has('files_progress')])->id('files_progress') }}
    @error('files_progress')
    <div class="invalid-feedback">{{ $errors->first('files_progress') }}</div>
    @enderror
</div>

<div class="form-group">
    <label class="form-label" for="status">Status:</label>
    {{ html()->select('status',$status)->class(["form-control", "is-invalid" => $errors->has('status')])->id('status') }}
    @error('status')
    <div class="invalid-feedback">{{ $errors->first('status') }}</div>
    @enderror
</div>

