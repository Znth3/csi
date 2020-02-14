<?php

namespace App\Http\Controllers;
use App\ThesisSeminar;
use Auth;
use DB;
use Illuminate\Http\Request;

class ThesisSeminarController extends Controller
{
    public function index()
    {
        $nim = Auth::user()->username;
        $thesisseminars = DB::table('thesis_seminars')
                        ->join('theses', 'thesis_seminars.thesis_id', '=', 'theses.thesis_id')
                        ->join('thesis_proposals', 'theses.thesis_id', '=', 'thesis_proposals.thesis_id')
                        ->join('students', 'theses.student_id', '=', 'students.id')
                        ->select('thesis_seminars.id', 'thesis_seminars.registered_at', 'thesis_seminars.seminar_at', 'thesis_seminars.status', DB::raw('(CASE WHEN thesis_seminars.status = 10 THEN '. "'Submitted'".' 
                        WHEN thesis_seminars.status = 20 THEN '."'Scheduled'".' WHEN thesis_seminars.status = 30 THEN '."'Finished'".' WHEN thesis_seminars.status = 40 THEN '."'Failed'".' END) AS status_semhas'))
                        ->where('students.nim', '=', $nim)
                        ->paginate(3);

        return view('backend.thesis_seminar.index', compact('thesisseminars'));
    }
    
    public function create()
    {
        $nim = Auth::user()->username;
        $statuss = DB::table('thesis_proposals') 
                ->join('theses', 'thesis_proposals.thesis_id', '=', 'theses.id')
                ->join('students', 'theses.student_id', '=', 'students.id')
                ->select('thesis_proposals.status')->where('students.nim', '=', $nim)
                ->get();

        $count = DB::table('thesis_sem_audiences')
                ->join('students','thesis_sem_audiences.student_id','=','students.id')
                ->select('student_id')->where('students.nim', '=', $nim)
                ->count();
        
        $student = DB::table('theses')
                ->join('students', 'theses.student_id', '=', 'students.id')
                ->select('theses.id')->where('students.nim', '=', $nim)
                ->get();
      
        $info = DB::table('theses')
                ->join('students', 'theses.student_id', '=', 'students.id')
                ->select('students.name AS student_name', 'theses.title')
                ->where('students.nim', '=', $nim)
                ->get();
        
        $sv = DB::table('theses')
            ->join('students', 'theses.student_id', '=', 'students.id')    
            ->join('thesis_supervisors', 'theses.id', '=', 'thesis_supervisors.thesis_id')
            ->join('lecturers', 'thesis_supervisors.lecturer_id', '=', 'lecturers.id')
            ->select('lecturers.name AS lecturer_name')
            ->where('students.nim', '=', $nim)
            ->get();

        if(empty($student[0]->id))
        {
            return redirect()->route('admin.semhas.index')->with('message', 'Gagal membuat pengajuan. Anda belum mendaftar tugas akhir.');           
        }
        elseif(empty($statuss[0]->status))
        {
            return redirect()->route('admin.semhas.index')->with('message', 'Gagal membuat pengajuan. Anda belum mendaftar seminar proposal.');           
        }
        
        foreach($statuss as $status)
        {
            foreach($status as $st)
            {
                if($st == 30 && $count >= 7)
                {
                    $info = $info[0];
                    return view('backend.thesis_seminar.create', compact('student', 'info', 'sv'));
                }
                elseif($st != 30 && $count < 7)
                {
                    return redirect()->route('admin.semhas.index')->with('message', 'Gagal membuat pengajuan. Anda belum menghadiri seminar hasil minimal 7 kali dan belum melaksanakan seminar proposal.');
                }
                elseif($st != 30)
                {
                    return redirect()->route('admin.semhas.index')->with('message', 'Gagal membuat pengajuan. Anda belum melaksanakan seminar proposal.');
                }
                elseif($count < 7)
                {
                    return redirect()->route('admin.semhas.index')->with('message', 'Gagal membuat pengajuan. Anda belum menghadiri seminar hasil minimal 7 kali.');
                }
            }
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'thesis_id'=>'required',
            'status' => 'required',
            'file_report' =>'file|mimes:pdf, required'
        ]);
    	    $semhas = new ThesisSeminar;
            $semhas->thesis_id = $request->thesis_id;
            $semhas->status = $request->status;
      
            if($request->hasFile('file_report') && $request->file('file_report')->isValid())
            {
                $filename = uniqid('laporan-');
                $fileext = $request->file('file_report')->extension();
                $filenameext = $filename.'.'.$fileext;
                $filepath = $request->file_report->storeAs('public/laporan_ta',$filenameext);
                $semhas->file_report = $filepath;
            }
            $semhas->save();
            return redirect()->route('admin.semhas.show', [$semhas->id])->with('message', 'Berhasil menambahkan pengajuan semhas baru');
    }

    public function show($id)
    {
        $thesisseminars = DB::table('thesis_seminars')
                ->join('theses', 'thesis_seminars.thesis_id', '=', 'theses.thesis_id')
                ->join('thesis_proposals', 'theses.thesis_id', '=', 'thesis_proposals.thesis_id')
                ->join('students', 'theses.student_id', '=', 'students.id')
                ->select('thesis_seminars.id','students.name AS student_name','thesis_seminars.registered_at AS registered_time','thesis_seminars.seminar_at AS seminar_time','thesis_seminars.status','thesis_seminars.recommendation','thesis_seminars.file_report AS file_reports', 
                  DB::raw('(CASE WHEN thesis_seminars.status = 10 THEN '. "'Submitted'".' 
                  WHEN thesis_seminars.status = 20 THEN '."'Scheduled'".' WHEN thesis_seminars.status = 30 THEN '."'Finished'".' WHEN thesis_seminars.status = 40 THEN '."'Failed'".' END) AS status_semhas'))
                ->where('thesis_seminars.id','=',$id)
                ->get();

        $reviewer = DB::table('thesis_seminars')
                    ->join('thesis_sem_reviewers', 'thesis_seminars.id', '=', 'thesis_sem_reviewers.thesis_seminar_id')
                    ->join('lecturers', 'thesis_sem_reviewers.reviewer_id', '=', 'lecturers.id')
                    ->select('lecturers.name AS reviewer_name')
                    ->where('thesis_seminars.id','=',$id)
                    ->get();
      
        $thesisseminars = $thesisseminars[0];
        
        return view('backend.thesis_seminar.show', compact('thesisseminars', 'reviewer'));
    }

    public function destroy($id)
    {
        //Cek status persetujuan admin
        $statuss = DB::table('thesis_seminars') 
                  ->select('thesis_seminars.status')
                  ->where('thesis_seminars.id','=', $id)
                  ->get();
        
        foreach($statuss as $status)
        {
            foreach($status as $st)
            {
                if($st == 10)
                {
                    $semhas = ThesisSeminar::findOrFail($id);
                    $a = DB::table('thesis_sem_audiences')->where('thesis_seminar_id','=',$id);
                    $a->delete();
                    $b = DB::table('thesis_sem_reviewers')->where('thesis_seminar_id','=',$id);
                    $b->delete();
                    $thesisseminars = DB::table('thesis_seminars')->where('thesis_seminars.id','=',$id);
                    $thesisseminars->delete();
                    if (\Storage::exists($semhas->file_report)) 
                    {
                        \Storage::delete($semhas->file_report);
                    }
        
                    return redirect()->route('admin.semhas.index')->with('message', 'Berhasil membatalkan pengajuan semhas');
            }
                elseif($st != 10)
                {
                    return redirect()->route('admin.semhas.index')->with('message', 'Gagal membatalkan pengajuan. Pengajuan telah disetujui.');
                }
            }
        }
    }

    public function edit($id)
    {
        //Cek status persetujuan admin 
        $statuss = DB::table('thesis_seminars') 
                  ->select('thesis_seminars.status')
                  ->where('thesis_seminars.id','=', $id)
                  ->get();
        
        $nim = Auth::user()->username;
        $info = DB::table('theses')
                ->join('students', 'theses.student_id', '=', 'students.id')
                ->select('students.name AS student_name', 'theses.title')
                ->where('students.nim', '=', $nim)
                ->get();
        $info = $info[0];
          
        $sv = DB::table('theses')
              ->join('students', 'theses.student_id', '=', 'students.id')    
              ->join('thesis_supervisors', 'theses.id', '=', 'thesis_supervisors.thesis_id')
              ->join('lecturers', 'thesis_supervisors.lecturer_id', '=', 'lecturers.id')
              ->select('lecturers.name AS lecturer_name')
              ->where('students.nim', '=', $nim)
              ->get();

        foreach($statuss as $status)
        {
            foreach($status as $st)
            {
                if($st == 10)
                {
                    $semhas = ThesisSeminar::findOrFail($id);
                    $nim = Auth::user()->username;
                    $student = DB::table('theses')
                            ->join('thesis_seminars', 'thesis_seminars.thesis_id', '=', 'theses.id')
                            ->select('theses.id')->where('thesis_seminars.id', '=', $id)
                            ->get();
                
                    return view ('backend.thesis_seminar.edit', compact('semhas', 'student', 'id', 'info', 'sv'));
                }
                elseif($st != 10)
                {
                    return redirect()->route('admin.semhas.index')->with('message', 'Gagal mengubah data pengajuan. Pengajuan telah disetujui.');
                }
            }
        }
    }

    public function update (Request $request, $id) {
        $semhas = ThesisSeminar::findOrFail($id);
            
        $request->validate([
            'thesis_id'=>'required',
            'file_report' =>'file|mimes:pdf, required'
        ]);

        $semhas->thesis_id = $request->thesis_id;
      
        if($request->hasFile('file_report') && $request->file('file_report')->isValid())
        {
            if (\Storage::exists($semhas->file_report)) 
            {
                \Storage::delete($semhas->file_report);
            }
            $filename = uniqid('laporan-');
            $fileext = $request->file('file_report')->extension();
            $filenameext = $filename.'.'.$fileext;
            $filepath = $request->file_report->storeAs('public/laporan_ta',$filenameext);
            $semhas->file_report = $filepath;
        }
    
        if($semhas->save()) {
            return redirect()->route('admin.semhas.show', [$semhas->id])->with('message', 'Berhasil memperbaharui data semhas');
        }
    }
}
