@extends('backend.layouts.app')

@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => route('admin.home'),
        'Tugas Akhir' => route('admin.theses.index'),
        'Index' => '#'
    ]) !!}
@endsection

@section('toolbar')
    {!! cui_toolbar_btn(route('admin.theses.create'), 'icon-plus', 'Tambah Tugas Akhir') !!}
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">

                {{-- CARD HEADER--}}
                <div class="card-header">
                    <strong><i class="fa fa-list"></i> List Tugas Akhir</strong>
                </div>

                {{-- CARD BODY--}}
                <div class="card-body">

                    <div class="row justify-content-end">
                        <div class="col-md-6 justify-content-end">
                            <div class="row justify-content-end">
                                {{ $theses->links() }}
                            </div>
                        </div>
                    </div>

                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th class="text-center">Nama<br>nim</th>
                            <th class="text-center">Judul<br>topik</th>
                            <th class="text-center">Pembimbing</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($theses as $thesis)
                            <tr>
                                <td class="text-center">{{ $thesis->student->name }}<br>{!! $thesis->student->nim !!}</td>
                                <td class="text-center">{{ $thesis->title }}<br><span class="font-italic">({!! $thesis->thesisTopic->name !!})</span></td>
                                <td class="text-center">
                                    @foreach($thesis->supervisor as $supervisor)
                                        {!! $supervisor->name !!}<br>
                                    @endforeach
                                </td>
                                <td class="text-center">{{ $thesis->status }}</td>
                                <td class="text-center">
                                    {!! cui_btn_view(route('admin.theses.show', [$thesis->id])) !!}
                                    {!! cui_btn_edit(route('admin.theses.edit', [$thesis->id])) !!}
                                    {!! cui_btn_delete(route('admin.theses.destroy', [$thesis->id]), "Anda yakin akan menghapus data tugas akhir ini?") !!}
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
                                {{ $theses->links() }}
                            </div>
                        </div>
                    </div>

                </div><!--card-body-->


            </div><!--card-->
        </div><!--col-->
    </div><!--row-->

@endsection
