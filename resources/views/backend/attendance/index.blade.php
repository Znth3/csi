@extends('backend.layouts.app')

@section('breadcrumb')
    {!! cui_breadcrumb([

        'Attendance' => route('admin.attendance.index'),
        'Index' => '#'
    ]) !!}
@endsection

@section('toolbar')
{{--    {!! cui_toolbar_btn(route('admin.lecturers.create'), 'icon-plus', 'Tambah Dosen') !!}--}}


@section('content')
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">

                {{-- CARD HEADER--}}
                <div class="card-header">
                    <i class="fa fa-list"></i>
                    @if($termTitle[0]->period == 1)Ganjil @else Genap @endif
                    {{" ".$termTitle[0]->year}}
                </div>

                {{-- CARD BODY--}}
                <div class="card-body">
                    <div class="row justify-content-end">
                        <div class="col-md-6 justify-content-end mt-n2 mr-3">
                            <div class="row justify-content-end">
                                {{-- {{ $data->links() }} --}}
                                {!! Form::open(['method' => 'GET', 'url' => '/admin/attendance', 'class' => '', 'role' => 'search'])  !!}
                                <div class="form-row align-items-center">
                                    <div class="col-auto">
{{--                                        <label class="mr-sm-2 sr-only" for="inlineFormCustomSelect">Preference</label>--}}
                                        <select name="semester" class="custom-select mr-sm-3" id="inlineFormCustomSelect">
                                            @foreach($term as $sems)
                                                <option value="{{$sems->id}}">{{$sems->year}} @if($sems->period == 1)Ganjil @else Genap @endif</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-auto my-1 ">
                                        <button type="submit" class="btn btn-primary">Search</button>
                                    </div>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>

                    <table class="table table-striped mt-1">
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
                                    {!! cui_btn_view(url('admin/attendance/'.$classLecturer->id.'/show')) !!}
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
