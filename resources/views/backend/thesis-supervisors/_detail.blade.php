<div class="card">
    {{-- CARD HEADER--}}
    <div class="card-header">
        <i class="fa fa-edit"></i> <strong>Dosen Pembimbing</strong>
    </div>

    {{-- CARD BODY--}}
    <div class="card-body">
        <div class="text-left">
            <table width="100%">
                <thead>
                <tr>
                    <th>Pembimbing TA</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody style="overflow: auto; white-space: nowrap">
                @foreach($thesis->supervisor as $supervisor)
                    <tr>
                        <td>
                            {{ html()->span()->text($supervisor->name) }} {{html()->span()->text(config("central.thesis_supervisor_status")[$supervisor->pivot->status])->class('badge')->class($supervisor->pivot->status == 0? "badge-primary":($supervisor->pivot->status == 1?"badge-success":"badge-danger"))}}
                        </td>
                        <td>
                            {!! cui_btn_delete(route('admin.thesis-supervisors.destroy', [$thesis->id,$supervisor->pivot->lecturer_id]), "Anda yakin akan menghapus data pembimbing TA ini?") !!}
                        </td>
                    </tr>

                @endforeach
                <tr>
                    <td></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{--CARD FOOTER--}}
    <div class="card-footer">
        @if(!isset($thesis->supervisor[0]) || $thesis->supervisor[0]->pivot->position != 1)
        <a href="{!! route('admin.thesis-supervisors.create',[$thesis->id]) !!}" class="col-12 btn btn-outline-primary">Tambah Pembimbing</a>
        @endif
    </div>
</div>
