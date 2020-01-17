@extends('backend.layouts.app')

@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => route('admin.home'),
        'Dosen' => route('admin.lecturers.index'),
        'Index' => '#'
    ]) !!}
@endsection

@section('toolbar')
    {!! cui_toolbar_btn(route('admin.lecturers.create'), 'icon-plus', 'Tambah Dosen') !!}
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">

                {{-- CARD HEADER--}}
                <div class="card-header">
                    <strong><i class="fa fa-list"></i> List Kelas</strong>
                </div>

                {{-- CARD BODY--}}
                <div class="card-body">

                    <div class="row justify-content-end">
                        <div class="col-md-6 justify-content-end">
                            <div class="row justify-content-end">
                                {{-- {{ $data->links() }} --}}
                            </div>
                        </div>
                    </div>

                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th class="text-center">Nama Matkul</th>
                            <th class="text-center">Nama Kelas</th>
                            <th class="text-center">Dosen Pengampu</th>
                            {{-- <th class="text-center">Jumlah Pertemuan</th> --}}
                            <th class="text-center">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $classLecturer)
                            <tr>
                                <td class="text-center">{{ $classLecturer->namaMK."/".$classLecturer->kredit }}</td>
                                <td class="text-center">{{ $classLecturer->name }}</td>
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
