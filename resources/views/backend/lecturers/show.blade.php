@extends('backend.layouts.app')

@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => route('admin.home'),
        'Dosen' => route('admin.lecturers.index'),
        'Detail' => '#'
    ]) !!}
@endsection

@section('toolbar')
    {!! cui_toolbar_btn_delete(route('admin.lecturers.destroy', [$lecturer->id]), $lecturer->id, 'icon-trash', 'Hapus Dosen', 'Anda yakin akan menghapus dosen ini?') !!}
    {!! cui_toolbar_btn(route('admin.lecturers.edit', $lecturer->id), 'icon-pencil', 'Edit Dosen') !!}
    {!! cui_toolbar_btn(route('admin.lecturers.index'), 'icon-list', 'List Dosen') !!}
    {!! cui_toolbar_btn(route('admin.lecturers.create'), 'icon-plus', 'Tambah Dosen') !!}
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">

                {{ html()->modelForm($lecturer) }}

                {{-- CARD HEADER--}}
                <div class="card-header">
                    <i class="fa fa-edit"></i> <strong>Detail Dosen</strong>
                </div>

                {{-- CARD BODY--}}
                <div class="card-body">
                    @include('backend.lecturers._detail')
                </div>

                {{--CARD FOOTER--}}
                <div class="card-footer">
                </div>

                {{ html()->closeModelForm() }}

                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        {{-- CARD HEADER--}}
                        <div class="card-header">
                            <i class="fa fa-edit"></i> <strong>Foto Dosen</strong>
                        </div>

                        {{-- CARD BODY--}}
                        <div class="card-body">
                            <div class="text-center">
                                <img src="{{ asset($lecturer->getPhotoPath()) }}" class="img-fluid rounded" alt="...">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
