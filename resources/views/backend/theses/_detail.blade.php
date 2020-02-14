<!-- Student's name Text Field Input -->
<div class="form-group">
    <label class="form-label" for="student_id">Nama Mahasiswa/Nim:</label>
    {{ html()->text('student_id', $thesis->student->name.' - '.$thesis->student->nim )->class('form-control-plaintext') }}
</div>

<!-- Topik Text Field Input -->
<div class="form-group">
    <label class="form-label" for="thesis_id">Topik</label>
    {{ html()->text('thesis_id', $thesis->thesisTopic->name)->class('form-control-plaintext') }}
</div>

<!-- title Text Field Input -->
<div class="form-group">
    <label class="form-label" for="title">Judul:</label>
    {{ html()->textarea('title', $thesis->title)->class('form-control-plaintext') }}
</div>

<!-- Abstract Text Field Input -->
<div class="form-group">
    <label class="form-label" for="abstract">Abstrak:</label>
    {{ html()->textarea('abstract', $thesis->abstract)->class('form-control-plaintext') }}
</div>

<!-- Start_at Text Field Input -->
<div class="form-group">
    <label class="form-label" for="start_at">Mulai Tugas Akhir Pada:</label>
    {{ html()->text('start_at',$thesis->start_at->format('d M Y') )->class('form-control-plaintext') }}
</div>

<!-- Status Text Field Input -->
<div class="form-group">
    <label class="form-label" for="npwp">Status:</label>
    {{ html()->text('status', $thesis->status)->class('form-control-plaintext') }}
</div>
