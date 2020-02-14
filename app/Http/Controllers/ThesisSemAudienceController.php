<?php

namespace App\Http\Controllers;
use App\ThesisSemAudience;
use App\Models\Student;
use DB;
use Illuminate\Http\Request;

class ThesisSemAudienceController extends Controller
{
    public function index($id)
    {
        $students = Student::all()->pluck('name','id');
        $statuss = DB::table('thesis_seminars') 
                ->select('thesis_seminars.status')
                ->where('thesis_seminars.id','=', $id)
                ->get();
        $thesisseminars = DB::table('thesis_seminars')
                    ->join('theses', 'thesis_seminars.thesis_id', '=', 'theses.thesis_id')
                    ->join('thesis_proposals', 'theses.thesis_id', '=', 'thesis_proposals.thesis_id')
                    ->join('students', 'theses.student_id', '=', 'students.id')
                    ->select('thesis_seminars.id','students.name AS student_name','thesis_seminars.seminar_at AS seminar_time') 
                    ->where('thesis_seminars.id','=',$id)
                    ->get();

        $reviewer = DB::table('thesis_seminars')
                    ->join('thesis_sem_reviewers', 'thesis_seminars.id', '=', 'thesis_sem_reviewers.thesis_seminar_id')
                    ->join('lecturers', 'thesis_sem_reviewers.reviewer_id', '=', 'lecturers.id')
                    ->select('lecturers.name AS reviewer_name')
                    ->where('thesis_seminars.id','=',$id)
                    ->get();
      
        $thesisseminars = $thesisseminars[0];

        foreach($statuss as $status)
        {
            foreach($status as $st)
            {
                if($st != 10)
                {
                    $semhass=DB::table('thesis_seminars')
                            ->join('thesis_sem_audiences','thesis_seminars.id','=','thesis_sem_audiences.thesis_seminar_id')
                            ->join('students','thesis_sem_audiences.student_id','=','students.id')
                            ->select('thesis_sem_audiences.id','students.nim','students.name','thesis_sem_audiences.student_id')
                            ->where('thesis_seminars.id','=', $id)
                            ->paginate(10);
                    return view('backend.thesissem_audience.index', compact('students', 'thesisseminars', 'reviewer', 'semhass', 'id'));
                }
                elseif($st == 10)
                {
                    return redirect()->route('admin.semhas.index')->with('message', 'Anda belum melaksanakan seminar hasil');
                }
            }
        }
    }
   
    public function store(Request $request)
    {
    	$request->validate([
            'thesis_seminar_id'=>'required',
            'student_id' => 'required' 
        ]);
        
    	$pesertas = new ThesisSemAudience();
        $pesertas->thesis_seminar_id = $request->input('thesis_seminar_id');
        $pesertas->student_id = $request->input('student_id');
        $pesertas->save();

        return redirect()->route('admin.pesertasemhas.index',[$pesertas->thesis_seminar_id])->with('message', 'Berhasil menambahkan peserta seminar');
    }
    
    public function destroy($id)
    {
        $semhass = ThesisSemAudience::find($id);
        $semhass->delete();
        return redirect()->route('admin.pesertasemhas.index',[$semhass->thesis_seminar_id])->with('message', 'Berhasil menghapus data peserta seminar');
    }
}
