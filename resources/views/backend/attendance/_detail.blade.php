<div class="col-md-6">
    <div class="form-group">
        <label class="form-label" for="crs_name">Mata Kuliah:</label>
        {{ html()->text('mataKuliah', $attendance[0]->crs_name)->class('form-control-plaintext') }}
    </div>
</div>

<div class="col-md-6">
    <div class="form-group">
        <label class="form-label" for="code">Kode MatKul:</label>
        {{ html()->text('kodeMatKul', $attendance[0]->code)->class('form-control-plaintext') }}
    </div>
</div>


<div class="col-md-6">
    <div class="form-group">
        <label class="form-label" for="code">Nama Kelas:</label>
        {{ html()->text('kodeMatKul', $attendance[0]->className)->class('form-control-plaintext') }}
    </div>
</div>

<div class="col-md-6">
    <div class="form-group">
        <label class="form-label" for="birthday">Dosen Pengampu:</label>
        {{ html()->text('dosenPengampu', $attendance[0]->lecname)->class('form-control-plaintext') }}
    </div>
<div class="col-md-6">

{{--<div class="col-md-6">--}}
{{--    <div class="form-group">--}}
{{--            <label class="form-label" for="semester">Semester:</label>--}}
{{--            {{ html()->text('semester', $attendance[0]->semester)->class('form-control-plaintext') }}--}}
{{--    </div>--}}
{{--</div>--}}
