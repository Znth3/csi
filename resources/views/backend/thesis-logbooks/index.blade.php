@extends('backend.layouts.app')

@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => route('admin.home'),
        'Detail TA' => route('admin.theses.show',[$thesis_id]),
        'Logbook TA' => route('admin.thesis-logbooks.index',[$thesis_id]),
        'Index' => '#'
    ]) !!}
@endsection

@section('toolbar')
    {!! cui_toolbar_btn(route('admin.thesis-logbooks.create',[$thesis_id]), 'icon-plus', 'Tambah Logbook TA') !!}
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">

                {{-- CARD HEADER--}}
                <div class="card-header">
                    <strong><i class="fa fa-list"></i> List Logbook TA</strong>
                </div>

                {{-- CARD BODY--}}
                <div class="card-body">

                    <div class="row justify-content-end">
                        <div class="col-md-6 justify-content-end">
                            <div class="row justify-content-end">
                                {{ $thesisLogbooks->links() }}
                            </div>
                        </div>
                    </div>

                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th class="text-center">Pembimbing</th>
                            <th class="text-center">Tanggal</th>
                            <th class="text-center">Progress</th>
                            <th class="text-center">Progress File</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($thesisLogbooks as $thesisLogbook)
                            <tr>
                                <td class="text-center">{{ $thesisLogbook->supervisor->lecturer->name }}</td>
                                <td class="text-center">{{ $thesisLogbook->date->format('d M Y') }}</td>
                                <td class="text-center">{{ $thesisLogbook->progress }}</td>
                                <td class="text-center">{{ $thesisLogbook->files_progress }}</td>
                                <td class="text-center">{{ $thesisLogbook->status }}</td>
                                <td class="text-center">
                                    {!! cui_btn_delete(route('admin.thesis-logbooks.destroy', [$thesis_id,$thesisLogbook->id]), "Anda yakin akan menghapus data logbook TA ini?") !!}
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
                                {{ $thesisLogbooks->links() }}
                            </div>
                        </div>
                    </div>

                </div><!--card-body-->


            </div><!--card-->
        </div><!--col-->
    </div><!--row-->

@endsection
