@extends('layouts.app')

@section('breadcrumb')
    {!! cui_breadcrumb([

        'Attendance' => route('admin.attendance.index'),
        'Index' => '#'
    ]) !!}
@endsection

@section('toolbar')
{{--    {!! cui_toolbar_btn(route('admin.lecturers.create'), 'icon-plus', 'Tambah Dosen') !!}--}}
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">

                {{-- CARD HEADER--}}
                <div class="card-header">
                    <strong><i class="fa fa-list"></i> List Kelas</strong>
                    {!! Form::open(['method' => 'GET', 'url' => '/admin/attendance', 'class' => 'navbar-form navbar-right', 'role' => 'search'])  !!}
                    <div class="form-row align-items-center">
                        <div class="col-auto">
                            <label class="mr-sm-2 sr-only" for="inlineFormCustomSelect">Preference</label>
                            <select name="semester" class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                                @foreach($term as $sems)
                                    <option value="{{$sems->id}}">{{$sems->year}} @if($sems->period == 1)Ganjil @else Genap @endif</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-auto my-1">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>

                {{-- CARD BODY--}}
                <div class="card-body">

                    <div class="row justify-content-end">
                        <div class="col-md-6 text-right">
                            <form method="post" action="{{ route('admin.searchAttendance.show') }}" class="form-inline">
                                {{ csrf_field() }}
                                <input type="text" name="keyword" class="form-control" value="@if(isset($keyword)) {{ $keyword }} @endif" placeholder="Masukkan Keyword" />
                                <input type="submit" name="submit" class="btn btn-primary" value="Cari" />
                            </form>
                        </div>
                        <div class="col-md-6 justify-content-end">
                            <div class="row justify-content-end">
                                {{-- {{ $data->links() }} --}}
                            </div>
                        </div>
                    </div>

                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th class="text-center">Kelas</th>
                            <th class="text-center">Mata Kuliah</th>
                            <th class="text-center">Dosen Pengampu</th>
                            {{-- <th class="text-center">Jumlah Pertemuan</th> --}}
                            <th class="text-center">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $classLecturer)
                            <tr>
                                <td class="text-center">{{ $classLecturer->name }}</td>
                                <td class="text-center">{{ $classLecturer->namaMK." (".$classLecturer->kode."/".$classLecturer->kredit.")"}}</td>
                                <td class="text-center">{{ $classLecturer->nama }}</td>

                                <td class="text-center">
                                    {!! cui_btn_view(route('admin.attendance.show', [$classLecturer->id])) !!}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <div class="row justify-content-end">
                        <div class="col-md-6 text-right">

                        </div>
                        <div class="col-md-6 justify-content-end">
                            <div class="row justify-content-end">
                                {{-- {{ $data->links() }} --}}
                            </div>
                        </div>
                    </div>

                </div><!--card-body-->


            </div><!--card-->
        </div><!--col-->
    </div><!--row-->

@endsection
