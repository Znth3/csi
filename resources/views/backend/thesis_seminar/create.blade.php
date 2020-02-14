@extends('backend.layouts.app')

@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => url('/home'),
        'Thesis Seminar' => url('/thesis_seminar'),
        'Add Seminar' => '#'
    ]) !!}
@endsection

@section('toolbar')
    {!! cui_toolbar_btn(url('/thesis_seminar'), 'icon-list', 'Daftar Semhas') !!}
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

            {{-- CARD HEADER --}}
            <div class="card-header">
                Pengajuan Semhas
            </div>
                
            {{-- CARD BODY --}}
            <div class="card-body"> 
                {{ Form::model($info, []) }}
                
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="student"><strong>Nama Mahasiswa</strong></label>
                    <div class="col-sm-10">
                    {{ Form::text('student_name', null, ['class' => 'form-control-plaintext', 'id' => 'student_name', 'readonly' => 'readonly']) }}
                    </div>
                </div>
                <div class="form-group row">
                    <label  class="col-sm-2 col-form-label" for="title"><strong>Judul TA</strong></label>
                    <div class="col-sm-10">
                    {{ Form::text('title', null, ['class' => 'form-control-plaintext', 'id' => 'title', 'readonly' => 'readonly']) }}
                    </div>
                </div>
                <div class="form-group row">
                        <label  class="col-sm-2 col-form-label" for="supervisor_name"><strong>Pembimbing</strong></label>
                    @foreach($sv as $s)
                        @if($loop->last && $loop->iteration == 2)
                        <div class="col-sm-2"></div>
                        @endif
                    <div class="col-sm-10">
                        {{ Form::text('lecturer_name', $s->lecturer_name, ['class' => 'form-control-plaintext', 'id' => 'lecturer_name', 'readonly' => 'readonly']) }}
                    </div>
                    @endforeach
                </div>
                {{ Form::close() }}

            {{ Form::open(['route' => 'admin.semhas.store', 'method' => 'post', 'enctype' => 'multipart/form-data']) }}
                {{ csrf_field() }}

                {{-- CARD BODY --}}
                <div>
                    @include('backend.thesis_seminar._form')
                </div>

                {{-- CARD FOOTER --}}
                <div class="card-footer">
                    <input type="submit" value="Simpan" class="btn btn-primary"/>
                </div>

            {{ Form::close() }}
            </div>
        </div>
    </div>

@endsection
