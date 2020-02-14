@extends('backend.layouts.app')

@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => route('admin.home'),
        'Thesis Seminar' => url('/thesis_seminar'),
        'Index' => '#'
    ]) !!}
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">

            {{ Form::open(['route' => 'admin.pesertasemhas.store', 'method' => 'post']) }}
                {{ csrf_field() }}
                {{-- CARD HEADER--}}
                <div class="card-header">
                    Informasi Semhas
                </div>

                {{-- CARD BODY--}}
                <div class="card-body">
                    
                    {{ Form::model($thesisseminars, []) }}

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="student"><strong>Nama Mahasiswa</strong></label>
                        <div class="col-sm-10">
                        {{ Form::text('student_name', null, ['class' => 'form-control-plaintext', 'id' => 'student_name', 'readonly' => 'readonly']) }}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="jam"><strong>Jadwal Seminar</strong></label>
                        <div class="col-sm-10">
                        {{ Form::input('timestamp','seminar_time', null, ['class' => 'form-control-plaintext', 'id' => 'seminar_time', 'readonly' => 'readonly']) }}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="reviewer_name"><strong>Penguji</strong></label>
                    @foreach($reviewer as $r)
                        @if($loop->last && $loop->iteration == 2)
                        <div class="col-sm-2"></div>
                        @endif
                        <div class="col-sm-10">
                        {{ Form::text('reviewer_name', $r->reviewer_name, ['class' => 'form-control-plaintext', 'id' => 'reviewer_name', 'readonly' => 'readonly']) }}
                        </div>
                    @endforeach    
                    </div>
            </div>

            <div class="card">    
                
                {{-- CARD HEADER--}}
                <div class="card-header">
                   Daftar Peserta Semhas
                </div>

                {{-- CARD BODY--}}
                    
                    <div class="card-body">
                    @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
                        @include('backend.thesissem_audience._form')
                        <input type="submit" value="Simpan" class="btn btn-primary"/>
                    </div>
                    {{ Form::close() }}
                    <div class="row justify-content-end">
                        <div class="col-md-6 text-right">
                            
                        </div>
                        <div class="col-md-6 justify-content-end">
                            <div class="row justify-content-end">
                                {{ $semhass->links() }}
                            
                            </div>
                        </div>
                    </div>
                    
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th class="text-center">Nama</th>
                            <th class="text-center">NIM</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($semhass as $peserta)
                            <tr>
                                <td class="text-center">{{ $peserta->name }}</td>
                                <td class="text-center">{{ $peserta->nim }}</td>
                                <td class="text-center">
                                {!! cui_btn_delete(route('admin.pesertasemhas.destroy', [$peserta->id]), "Anda yakin akan menghapus data peserta semhas ini?") !!}
          
                                </td>
                            </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center">
                                Peserta semhas belum ada
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
                                {{ $semhass->links() }}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
