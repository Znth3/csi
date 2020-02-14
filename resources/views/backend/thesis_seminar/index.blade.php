@extends('backend.layouts.app')

@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => url('/home'),
        'Thesis Seminar' => url('/thesis_seminar'),
        'Index' => '#'
    ]) !!}
@endsection

@section('toolbar')
    {!! cui_toolbar_btn(url('/thesis_seminar/create'), 'icon-plus', 'Ajukan Semhas') !!}
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">

                {{-- CARD HEADER--}}
                <div class="card-header">
                    Daftar Seminar Hasil
                </div>

                {{-- CARD BODY--}}
                <div class="card-body">

                    <div class="row justify-content-end">
                        <div class="col-md-6 text-right">
                            
                        </div>
                        <div class="col-md-6 justify-content-end">
                            <div class="row justify-content-end">
                                {{ $thesisseminars->links() }}
                            </div>
                        </div>
                    </div>
                    @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                    @endif
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th class="text-center">Waktu Mengajukan</th>
                            <th class="text-center">Jadwal Seminar</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($thesisseminars as $semhas)
                            <tr>
                                <td class="text-center">{{ $semhas->registered_at }}</td>
                                <td class="text-center">{{ $semhas->seminar_at }}</td>
                                <td class="text-center">{{ $semhas->status_semhas }}</td>
                                <td class="text-center">
                                    {!! cui_btn_view(route('admin.semhas.show', [$semhas->id])) !!}
                                    {!! cui_btn_edit(route('admin.semhas.edit', [$semhas->id])) !!}
                                    {!! cui_btn_delete(route('admin.semhas.destroy', [$semhas->id]), "Anda yakin akan membatalkan pengajuan semhas ini?") !!}
                                    {!! cui_btn(route('admin.pesertasemhas.index', [$semhas->id]), 'icon-people','Peserta') !!}
                                
                                </td>
                            </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center">
                                Data semhas belum ada
                            </td>
                        </tr>

                        @endforelse
                        </tbody>
                    </table>

                    <div class="row justify-content-end">
                        <div class="col-md-6 text-right">

                        </div>
                        <div class="col-md-6 justify-content-end">
                            <div class="row justify-content-end">
                                {{ $thesisseminars->links() }}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>
@endsection