@extends('backend.layouts.app')

@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => route('admin.home'),
        'Tugas Akhir' => route('admin.theses.index'),
        'Detail' => '#'
    ]) !!}
@endsection

@section('toolbar')
    {!! cui_toolbar_btn_delete(route('admin.theses.destroy', [$thesis->id]), $thesis->id, 'icon-trash', 'Hapus Tugas Akhir', 'Anda yakin akan menghapus tugas akhir ini?') !!}
    {!! cui_toolbar_btn(route('admin.theses.edit', $thesis->id), 'icon-pencil', 'Edit Tugas Akhir') !!}
    {!! cui_toolbar_btn(route('admin.theses.index'), 'icon-list', 'List Tugas Akhir') !!}
    {!! cui_toolbar_btn(route('admin.theses.create'), 'icon-plus', 'Tambah Tugas Akhir') !!}
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">

                        {{ html()->modelForm($thesis) }}

                        {{-- CARD HEADER--}}
                        <div class="card-header">
                            <i class="fa fa-edit"></i> <strong>Detail Dosen</strong>
                        </div>

                        {{-- CARD BODY--}}
                        <div class="card-body">
                            @include('backend.theses._detail')
                        </div>

                        {{--CARD FOOTER--}}
                        <div class="card-footer">
                        </div>
                        {{ html()->closeModelForm() }}
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="col-md-12">
                        @include('backend.thesis-supervisors._detail')
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            {{-- CARD HEADER--}}
                            <div class="card-header">
                                <i class="fa fa-edit"></i> <strong>Logbook</strong>
                            </div>

                            {{-- CARD BODY--}}
                            <div class="card-body">
                                <div class="text-left">
                                    @foreach($logbooks as $logbook)
                                        {!! html()->span($logbook->date->format("d M Y"))->class("font-italic") !!}<br>
                                        {!! html()->element('p')->text($logbook->progress) !!}
                                    @endforeach
                                    <a href="{!! route('admin.thesis-logbooks.index',[$thesis->id]) !!}" class="col-12 btn btn-outline-primary">Logbook</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
