@extends('backend.layouts.app')

@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => url('home'),
        'Attendance' => url('admin/attendance'),
        'Index' => '#'
    ]) !!}
@endsection


@section('toolbar')
{{--     {!! cui_toolbar_btn('','fa fa-edit', 'Edit Pertemuan') !!}--}}
    <a href="" class="btn" data-toggle="modal" data-target="#exampleModalCenter">
        <i class="icon-plus"></i> &nbsp;Tambah Pertemuan
    </a>

    <a href="" class="btn" data-toggle="modal" data-target="#exampleModal">
        <i class="fa fa-edit"></i> &nbsp;Edit Pertemuan
    </a>
@endsection


@section('content')
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">

                 {{ html()->modelForm($attendance) }}

                {{-- CARD HEADER--}}
                <div class="card-header">
                    <i class="fa fa-edit"></i> <strong>Detail Kelas</strong>
                </div>

                {{-- CARD BODY--}}
                <div class="card-body">
                    <div class="row justify-content-end">
                        <div class="col-md-12 justify-content-end">
                            <div class="row">
                                @include('backend.attendance._detail')
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{ html()->closeModelForm() }}
            <div class="card">
                {{-- CARD HEADER--}}
                <div class="card-header">
                    <i class="fa fa-edit"></i> <strong>Daftar Mahasiswa</strong>
{{--                        {!! cui_toolbar_btn(route('admin.attendance.create'), 'icon-plus col col-md-1 justify-content-end', 'Tambah Pertemuan') !!}--}}

                </div>

                <div class="card-body">
                    <div class="row justify-content-end">
                        <div class="col-md-12 justify-content-end">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <a class="buttonancak btn-primary" href="{{ route('kehadiran', ['id' => Request::segment(3), 'jenis' => 'print']) }}"><i class="fa fa-print"></i></a>
                                        @include('backend.attendance.tabel')
                                    </div>
                                    {{-- ayam --}}

                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                        </div>
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

    <div class="col-md-6">
        <div class="form-group">
        <!-- Modal Edit-->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Daftar Pertemuan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Edit</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php $a = 1; @endphp
                                @foreach($attendance as $att)
                                    <tr>
                                        <th scope="row">{{$a}}</th>
                                        <td>{{$att->date}}</td>
                                        <td>{!! cui_btn_edit(url('admin/attendance/edit/'. $att->id."/detail")) !!}</td>
                                    </tr>
                                    @php $a++; @endphp
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <!-- Button trigger modal -->

            <!-- Modal -->
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Tambah Pertemuan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            {!! Form::open(['method' => 'PATCH','url' => 'admin/attendance/student',
                                            'class' => 'form-horizontal', 'files' => true]) !!}
                            {{ Form::hidden('class_lecturer_id', $attendance[0]->id) }}
                            @include ('backend.attendance.create')

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
