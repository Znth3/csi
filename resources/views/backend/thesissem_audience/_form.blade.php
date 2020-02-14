<input type="hidden" name="thesis_seminar_id" value="{{ $id }}">
<div class="form-group">
    <label for="student">Nama Mahasiswa</label>
    {{ Form::select('student_id', $students, null, ['class' => 'form-control', 'name' => 'student_id', 'placeholder' => 'Mahasiswa']) }}
</div>