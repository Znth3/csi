{!! html()->hidden('thesis_id')->value($thesis_id) !!}
<div class="form-group">
    <label class="form-label" for="nama/nim">Nama Mahasiswa/Nim:</label>
    {{ html()->span($thesis->student->name.' - '.$thesis->student->nim)->class(["form-control", "is-invalid" => $errors->has('nama/nim')])->id('nama/nim') }}
    @error('nama/nim')
    <div class="invalid-feedback">{{ $errors->first('nama/nim') }}</div>
    @enderror
</div>
<div class="form-group">
    <label class="form-label" for="judul_ta">Judul TA:</label>
    {{ html()->span($thesis->title)->class(["form-control", "is-invalid" => $errors->has('judul_ta')])->id('judul_ta') }}
    @error('judul_ta')
    <div class="invalid-feedback">{{ $errors->first('judul_ta') }}</div>
    @enderror
</div>
<!-- thesis Topic select Field Input -->
<div class="form-group">
    <label class="form-label" for="lecturer_id">Nama Pembimbing:</label>
    {{ html()->select('lecturer_id',$lecturers)->class(["form-control", "is-invalid" => $errors->has('lecturer_id')])->id('lecturer_id') }}
    @error('lecturer_id')
    <div class="invalid-feedback">{{ $errors->first('lecturer_id') }}</div>
    @enderror
</div>

<div class="form-group">
    <label class="form-label" for="position">Posisi:</label>
    {{ html()->select('position',config('central.thesis_supervisor_position'))->class(["form-control", "is-invalid" => $errors->has('position')])->id('position') }}
    @error('position')
    <div class="invalid-feedback">{{ $errors->first('position') }}</div>
    @enderror
</div>

<div class="form-group">
    <label class="form-label" for="status">Status:</label>
    {{ html()->select('status',config('central.thesis_supervisor_status'))->class(["form-control", "is-invalid" => $errors->has('status')])->id('status') }}
    @error('status')
    <div class="invalid-feedback">{{ $errors->first('status') }}</div>
    @enderror
</div


