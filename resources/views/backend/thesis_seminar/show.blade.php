@extends('backend.layouts.app')

@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => route('admin.home'),
        'Thesis Seminar' => url('/thesis_seminar'),
        'Detail' => '#'
    ]) !!}
@endsection

@section('toolbar')
    {!! cui_toolbar_btn(route('admin.semhas.edit', [$thesisseminars->id]), 'icon-pencil', 'Edit Semhas') !!}
    {!! cui_toolbar_btn_delete(route('admin.semhas.destroy', [$thesisseminars->id]), $thesisseminars->id, 'icon-trash', 'Hapus Semhas', 'Anda yakin akan membatalkan pengajuan semhas ini?') !!}
    {!! cui_toolbar_btn(url('/thesis_seminar/create'), 'icon-plus', 'Ajukan Semhas') !!}
    {!! cui_toolbar_btn(url('/thesis_seminar'), 'icon-list', 'Daftar Semhas') !!}
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                {{-- CARD HEADER--}}
                <div class="card-header">
                    Seminar Hasil
                </div>

                {{-- CARD BODY--}}
                <div class="card-body">  
                    @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                    @endif
                    {{ Form::model($thesisseminars, []) }}

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="student"><strong>Nama Mahasiswa</strong></label>
                        <div class="col-sm-10">
                        {{ Form::text('student_name', null, ['class' => 'form-control-plaintext', 'id' => 'student_name', 'readonly' => 'readonly']) }}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="semhas_at"><strong>Waktu Mengajukan</strong></label>
                        <div class="col-sm-10">
                        {{ Form::input('timestamp','registered_time', null, ['class' => 'form-control-plaintext', 'id' => 'registered_time', 'readonly' => 'readonly','disabled']) }}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="jam"><strong>Jadwal Seminar</strong></label>
                        <div class="col-sm-10">
                        {{ Form::input('timestamp','seminar_time', null, ['class' => 'form-control-plaintext', 'id' => 'seminar_time', 'readonly' => 'readonly']) }}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="reviewer_name"><strong>Penguji</strong></label>
                        @foreach($reviewer as $r)
                        @if($loop->last && $loop->iteration == 2)
                        <div class="col-sm-2"></div>
                        @endif
                        <div class="col-sm-10">
                        {{ Form::text('reviewer_name', $r->reviewer_name, ['class' => 'form-control-plaintext', 'id' => 'reviewer_name', 'readonly' => 'readonly']) }}
                        </div>
                        @endforeach
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="status"><strong>Status</strong></label>
                        <div class="col-sm-10">
                        {{ Form::text('status_semhas', null, ['class' => 'form-control-plaintext', 'id' => 'status', 'readonly' => 'readonly']) }}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="recommendation"><strong>Rekomendasi</strong></label>
                        <div class="col-sm-10">
                        {{ Form::text('recommendation', null, ['class' => 'form-control-plaintext', 'id' => 'recommendation', 'readonly' => 'readonly']) }}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="file_reports"><strong>File Laporan TA</strong></label>
                        <div class="col-sm-10">
                        {{ Form::text('file_reports', null, ['class' => 'form-control-plaintext', 'id' => 'file_reports', 'readonly' => 'readonly']) }}
                        </div>
                    </div>
                    
                    {{ Form::close() }}

                </div>

                {{-- CARD FOOTER --}}
                <div class="card-footer">

                </div>
            </div>
        </div>
    </div>
@endsection