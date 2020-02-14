<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Thesis;
use App\Models\ThesisLogbook;
use App\ThesisTopic;
use Illuminate\Http\Request;

class ThesisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $theses = Thesis::thesisList(25);
        return view('backend.theses.index',compact('theses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $thesesTopic = ThesisTopic::pluck('name','id');
        $students = Student::pluck('name','id');
        return view('backend.theses.create',compact('thesesTopic','students'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, Thesis::$validation_rules);
        $thesis = Thesis::create($request->all());

        session()->flash('flash_success', 'Berhasil menambahkan data tugas akhir atas nama '. $thesis->student->name);
        return redirect()->route('admin.theses.show', [$thesis->id]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Thesis  $thesis
     * @return \Illuminate\Http\Response
     */
    public function show(Thesis $thesis)
    {
        $thesis->status = Thesis::$status[$thesis->status];
        $logbooks = ThesisLogbook::where('thesis_id',$thesis->id)->get();
        return view('backend.theses.show',compact('thesis','logbooks'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Thesis  $thesis
     * @return \Illuminate\Http\Response
     */
    public function edit(Thesis $thesis)
    {
        $thesesTopic = ThesisTopic::pluck('name','id');
        $students = Student::pluck('name','id');
        return view('backend.theses.edit',compact('thesis','thesesTopic','students'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Thesis  $thesis
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Thesis $thesis)
    {
        $this->validate($request, Thesis::$validation_rules);
        $thesis->update($request->all());

        session()->flash('flash_success', 'Berhasil mengupdate data Tugas akhir atas nama '.$thesis->student->name);
        return redirect()->route('admin.theses.show', [$thesis->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Thesis  $thesis
     * @return \Illuminate\Http\Response
     */
    public function destroy(Thesis $thesis)
    {
        $thesis->delete();
        session()->flash('flash_success', "Berhasil menghapus Tugas Akhir ".$thesis->title);
        return redirect()->route('admin.theses.index');
    }
}
