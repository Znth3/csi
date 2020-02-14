@extends('backend.layouts.app')

@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => url('/'),
        'Attendance' => url('admin/attendance'),
        'Index' => '#'
    ]) !!}
@endsection


@section('toolbar')
    <strong></strong>
    {{-- {!! cui_toolbar_btn(route('students.create'), 'icon-plus', 'Tambah Mahasiswa') !!} --}}
@endsection


@section('content')
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">

                {{-- CARD HEADER--}}
                <div class="card-header">
                    <i class="fa fa-list"></i> List Absensi tanggal {{$attendance_students[0]->date}}
                </div>

                {{-- CARD BODY--}}
                <div class="card-body">

                    <div class="row justify-content-end">
                        <div class="col-md-12 justify-content-end">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="birthplace">Mata Kuliah:</label>
                                        {{ html()->text('mataKuliah', $attendance_students[0]->crs_name)->class('form-control-plaintext') }}
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="birthday">Kode MatKul:</label>
                                        {{ html()->text('kodeMatKul', $attendance_students[0]->code)->class('form-control-plaintext') }}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="birthday">Jumlah Sks:</label>
                                        {{ html()->text('kodeMatKul', $attendance_students[0]->credit)->class('form-control-plaintext') }}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="birthday">Jam:</label>
                                        {{ html()->text('kodeMatKul', $attendance_students[0]->start_at)->class('form-control-plaintext') }}s/d
                                        {{ html()->text('kodeMatKul', $attendance_students[0]->end_at)->class('form-control-plaintext') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th class="">Nama</th>
                            <th class="">Nim</th>
                            <th class="">{{$attendance_students[0]->date}}</th>
                            <th class="">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        {{-- @foreach($students as $student) --}}
                        @foreach($attendance_students as $att_student)
                            <tr>
                                <td class="">
                                    {{ $att_student->name}}
                                </td>
                                <td class="">
                                    {{ $att_student->nim}}
                                </td>
                                {{-- <td>{{ $student->name }}</td>
                                <td class="">{{ $student->nim }}</td> --}}
                                {{-- {!! Form::open(['url' => '/attendance/edit/'. $attendance_students[0]->att_id,'method' => 'PATCH', --}}
                                {!! Form::open(['url' => route('editabsen', ['id' => $attendance_students[0]->att_id]),'method' => 'PATCH',
                                'class' => 'form-horizontal', 'files' => true]) !!}
                                <td class="">
                                    <input type="hidden" name="id" value="{{$att_student->id}}">
                                    {{-- <select name="status" class="custom-select">
                                    <option value="{{$att_student->status}}">{{config('central.attendance_student') [$att_student->status]}}</option>
                                    <option value="1">V</option>
                                    <option value="2">X</option>
                                    <option value="3">I</option>
                                    <option value="4">S</option>
                                    </select> --}}
                                    {!! Form::select('status', array(1 => 'Hadir', 2=> 'Absen', 3 => 'Izin', 4 => 'Sakit'), $att_student->status, ['class' => 'form-control'] ) !!}
                                </td>
                                <td><button class="btn btn-primary" type="submit">Edit</button></td>
                                {!! Form::close() !!}
                            </tr>
                        @endforeach
                        <td></td>
                        <td></td>
                        </tbody>
                    </table>

                    <div class="row justify-content-end">
                        <div class="col-md-6 text-right">

                        </div>
                        <div class="col-md-6 justify-content-end">
                            <div class="row justify-content-end">
                                {{-- {{ $students->links() }} --}}
                            </div>
                        </div>
                    </div>

                </div><!--card-body-->


            </div><!--card-->
        </div><!--col-->
    </div><!--row-->

@endsection
