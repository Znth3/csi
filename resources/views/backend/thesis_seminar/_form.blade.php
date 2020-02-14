<div class="form-group">
    {{ Form::hidden('thesis_id', $student[0]->id, null, ['class' => 'form-control', 'id' => 'nim']) }}
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label" for="file_report"><strong>File Laporan (PDF)</strong></label>
    <div class="col-sm-10">
    {{ Form::file('file_report', null, ['class' => 'form-control-file', 'id' => 'file_report']) }}
</div>

<div class="form-group">
    {{ Form::hidden('status', 10, ['class' => 'form-control', 'id' => 'status']) }}
</div>

