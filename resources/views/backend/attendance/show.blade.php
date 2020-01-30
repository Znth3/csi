@extends('layouts.app')

@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => url('/home'),
        'Attendance' => url('admin/attendance'),
        'Index' => '#'
    ]) !!}
@endsection


@section('toolbar')
    <strong><i class="fa fa-list"></i> List Kehadiran</strong>
    {!! cui_toolbar_btn(route('admin.attendance.create'), 'icon-plus', 'Tambah Pertemuan') !!}
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
                                <div class="col-md-6">
                                    @include('backend.attendance._detail')
                                </div>
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
                        {!! cui_toolbar_btn(route('admin.attendance.create'), 'icon-plus col col-md-1 justify-content-end', 'Tambah Pertemuan') !!}

                </div>

                <div class="card-body">
                    <div class="row justify-content-end">
                        <div class="col-md-12 justify-content-end">
                            <div class="row">
                                <div class="col-md-6">
                                    {{-- ayam --}}
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th class="text-center">Nama Mahasiswa</th>
                                            <th class="text-center">NIM</th>
                                            @foreach($kolom as $att)
                                                <th class="text-center">{{$att}}</th>
                                            @endforeach
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($ayam as $a)
                                            <tr>
                                                <td class="text-center">{{$a['name']}}</td>
                                                <td class="text-center">{{$a['nim']}}</td>
                                                @foreach ($a['desc'] as $key => $item)
                                                    @foreach ($a['desc'] as $i)
                                                        @if ($kolom[$key] == $i['date'])
                                                            <td class="text-center">{{config('central.attendance_student')[$item['status']]}}</td>
                                                        @endif
                                                    @endforeach
                                                @endforeach
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
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

@endsection
