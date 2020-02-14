<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Lecturer;
use App\Models\Thesis;
use Illuminate\Http\Request;

class ThesisSupervisorController extends Controller
{
    public function destroy($thesis_id, $lecturer_id)
    {
        $thesis = Thesis::find($thesis_id);
        $thesis->supervisor()->detach($lecturer_id);
        session()->flash('flash_success', "Berhasil menghapus Tugas Akhir ".$thesis->title);
        return redirect()->back();
    }

    public function store(Request $request)
    {
        $thesis = Thesis::find($request->get('thesis_id'));
        $thesis->supervisor()->attach($request->get('lecturer_id'),
            ['position' => $request->get('position'),'status' => $request->get('status')]);
        session()->flash('flash_success', "Berhasil menambahkan pembimbing Tugas Akhir ".$thesis->title);
        return redirect()->route('admin.theses.show',[$thesis->id]);
    }

    public function create($thesis_id){
        $thesis = Thesis::findOrFail($thesis_id);
        $lecturers = Lecturer::pluck('name','id');
        return view('backend.thesis-supervisors.create',compact('thesis_id','lecturers','thesis'));
    }
}
