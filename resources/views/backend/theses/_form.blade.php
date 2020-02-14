<!-- thesis Topic select Field Input -->
<div class="form-group">
    <label class="form-label" for="thesis_id">Topik:</label>
    {{ html()->select('thesis_id',$thesesTopic)->class(["form-control", "is-invalid" => $errors->has('thesis_id')])->id('thesis_id') }}
    @error('thesis_id')
    <div class="invalid-feedback">{{ $errors->first('thesis_id') }}</div>
    @enderror
</div>

<!-- thesis Topic Select Field Input -->
<div class="form-group">
    <label class="form-label" for="student_id">Nama Mahasiswa:</label>
    {{ html()->select('student_id',$students)->class(["form-control", "is-invalid" => $errors->has('student_id')])->id('student_id') }}
    @error('student_id')
    <div class="invalid-feedback">{{ $errors->first('student_id') }}</div>
    @enderror
</div>

<div class="form-group">
    <label class="form-label" for="title">Judul:</label>
    {{ html()->textarea('title')->class(["form-control", "is-invalid" => $errors->has('title')])->id('title')->placeholder('Tuliskan Judul Tugas Akhir') }}
    @error('title')
    <div class="invalid-feedback">{{ $errors->first('title') }}</div>
    @enderror
</div>

<div class="form-group">
    <label class="form-label" for="abstract">Abstrak:</label>
    {{ html()->textarea('abstract')->class(["form-control", "is-invalid" => $errors->has('abstract')])->id('abstract')->placeholder('Tuliskan Abstrak Tugas Akhir') }}
    @error('abstract')
    <div class="invalid-feedback">{{ $errors->first('abstract') }}</div>
    @enderror
</div>

<div class="form-group">
    <label class="form-label" for="start_at">Mulai Tugas Akhir Pada:</label>
    {{ html()->date('start_at')->class(["form-control", "is-invalid" => $errors->has('start_at')])->id('start_at') }}
    @error('start_at')
    <div class="invalid-feedback">{{ $errors->first('start_at') }}</div>
    @enderror
</div>

<div class="form-group">
    <label class="form-label" for="status">Status:</label>
    {{ html()->select('status',\App\Models\Thesis::$status)->class(["form-control", "is-invalid" => $errors->has('status')])->id('status') }}
    @error('status')
    <div class="invalid-feedback">{{ $errors->first('status') }}</div>
    @enderror
</div>

