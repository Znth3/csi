<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Thesis;
use App\Models\ThesisLogbook;
use App\Models\ThesisSupervisor;
use Illuminate\Http\Request;

class ThesisLogbookController extends Controller
{
    public function index($thesis_id){
        $thesisLogbooks = ThesisLogbook::thesisLogbookList($thesis_id,25);
        return view('backend.thesis-logbooks.index',compact('thesis_id','thesisLogbooks'));
    }

    public function create($thesis_id){
        $supervisors = [];
        $status = ThesisLogbook::$status;
        foreach (ThesisSupervisor::where('thesis_id', $thesis_id)->get() as $supervisor){
            $supervisors[$supervisor->id] = $supervisor->lecturer->name;
        }
        return view('backend.thesis-logbooks.create',compact('supervisors','thesis_id','status'));
    }

    public function store(Request $request, $thesis_id){
        $this->validate($request, ThesisLogbook::$validation_rules);
        $thesisLogbook = ThesisLogbook::create([
            'thesis_id' => $thesis_id,
        ]+$request->all());

        if($request->hasFile('files_progress')){
            $fileExt = $request->files_progress->extension();
            $fileName = uniqid("files_progress").".".$fileExt;
            $request->files_progress->storeAs(
                config('central.folder.thesis_logbook_file_progress'), $fileName
            );
            $thesisLogbook->files_progress = $fileName;
            $thesisLogbook->save();
        }

        return redirect()->route('admin.thesis-logbooks.index',$thesis_id);
    }

    public function destroy($thesis_id, ThesisLogbook $thesisLogbook){
        $thesisLogbook->delete();
        return redirect()->route('admin.thesis-logbooks.index',$thesis_id);
    }
}
