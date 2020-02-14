@if(Request::segment(4)=='print')
    <header>
        <h2 class="text-center"><strong>Daftar Hadir Kuliah</strong></h2>
    </header>

    <div>
        <table >
            <tr>
                <td>Kode/Mata Kuliah</td>
                <td>:</td>
                <td>{{ $attendance[0]->code."/".$attendance[0]->crs_name }}</td>
            </tr>
            <tr>
                <td>Semester</td>
                <td>:</td>
                <td>{{ $attendance[0]->semester }}</td>
            </tr>
            <tr>
                <td>Dosen</td>
                <td>:</td>
                <td>{{ $attendance[0]->lecname }}</td>
            </tr>
        </table>
    </div>
@endif
<div class="table-responsive">
    <table class="table table-striped table-with-outline">
        <thead>
        <tr class="table-with-outline">
            <th class="table-with-outline text-center">Nama Mahasiswa</th>
            <th class="table-with-outline text-center">NIM</th>
            @foreach($kolom as $att)
                <?php
                $tgl = explode("-", $att['tgl']);
                // dd($tgl);
                $tgl = $tgl[2]."/".$tgl[1];
                ?>
                <th class="text-center table-with-outline">{{$tgl}}</th>
            @endforeach
        </tr>
        </thead>
        <tbody>
        @foreach ($ayam as $a)
            <tr>
                <td class="table-with-outline tt">{{$a['name']}}</td>
                <td class="table-with-outline text-center">{{$a['nim']}}</td>

                @foreach ($a['desc'] as $key => $item)

                    @foreach ($a['desc'] as $i)
                        <?php
//                                                                                     dd($kolom[$key]['tgl']);

                        ?>

                    @if ($kolom[$key]['tgl'] == $i['date'])
                            @if(Request::segment(4) == 'print')
                                <td class="table-with-outline text-center">{{config('central.attendance_student')[$item['status']]}}</td>
                            @else
                                <td class="text-center">
{{--                                                                        {{ $item['status'] == 1 ? 1 : <i class='fa fa-check'></i>  }}--}}
                                    @if($item['status'] == 1)
                                        <i class='fa fa-check'></i>
                                    @elseif($item['status'] == 2)
                                        <i class='fa fa-times'></i>
                                    @elseif($item['status'] == 4)
                                        <i class='fa fa-ambulance'></i>
                                    @elseif($item['status'] == 3)
                                        <i class='fa fa-info'></i>
                                    @elseif($item['status'] == 0)
                                        <i class='fa fa-times'></i>
                                    @endif
                                </td>
                            @endif
                        @endif
                    @endforeach
                @endforeach
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

@if(Request::segment(4) == 'print')
    <style>
        table, tr, td, th{
            border: 0px solid;
            border-collapse:collapse;
            padding: 5px;
            margin-top: 10px;
        }
        .text-center{
            text-align: center;
        }
        .tt{
            font-size: 12px;
        }
        .table-with-outline{
            border: 1px solid;
        }
    </style>
    <script>
        // window.print();
    </script>
@endif
