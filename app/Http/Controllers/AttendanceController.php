<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Attendance;
use App\Models\ClassLecturer;

class AttendanceController extends Controller
{
    public function  create(){
        return view('backend.attendance.create');
    }

    public function store(Request $request){
        $this->validate($request, $this->validation_rules);

        $attendance = attendances::create([

        ]);
    }

    function index(Request $request){
        $semester = $request->get('semester');
        $term = DB::table('semesters')->orderBy('year', 'desc')->get();

        if(!empty($semester)){
            $semester=$semester;
        }else{
            $year = date("Y");

            $limit = DB::table('semesters')
                ->where([['semesters.year','=', $year]])
                ->orderBy('period')
                ->limit(1)
                ->get();
            foreach ($limit as $l){
                $semester = $l->id;
            }
        }
        $data = DB::table('class_lecturers')
            ->join('lecturers', 'lecturers.id', '=', 'class_lecturers.lecturer_id')
            ->join('classrooms', 'classrooms.id', '=', 'class_lecturers.classroom_id')
            ->join('courses', 'courses.id', '=', 'classrooms.course_id')
            ->join('semesters', 'classrooms.semester_id', '=', 'semesters.id')
            ->select('lecturers.name as nama','classrooms.name as name', 'class_lecturers.id', 'courses.name as namaMK','courses.code as kode', 'courses.credit as kredit')
            ->where([['semesters.id','=' ,$semester]])
            ->get();

        return view('backend/attendance/index', compact('data', 'term'));
    }

    public function show($id)
    {

        $attendance = DB::table('attendances')
            ->join('class_lecturers','class_lecturer_id','=','class_lecturers.id')
            ->join('lecturers','class_lecturers.lecturer_id','=','lecturers.id')
            ->join('classrooms','class_lecturers.classroom_id','=','classrooms.id')
            ->join('courses','classrooms.course_id','=','courses.id')
            ->where([['class_lecturers.id','=', $id]])
            ->select('attendances.*','courses.name AS crs_name','courses.code','courses.semester','lecturers.name AS lecname')
            ->get();


        $attendance_students = DB::table('attendance_students')
            ->join('attendances','attendance_id','=','attendances.id')
            ->join('course_selections','attendance_students.course_selection_id','=','course_selections.id')
            ->join('classrooms','course_selections.classroom_id','=','classrooms.id')
            ->join('class_lecturers', 'class_lecturers.classroom_id', '=', 'classrooms.id')
            ->join('courses','classrooms.course_id','=','courses.id')
            ->join('student_semesters','course_selections.student_semester_id','=','student_semesters.id')
            ->join('students','student_id','=','students.id')
            ->where([['class_lecturers.id','=',$id]])
            ->select('students.nim','students.name','attendance_students.status','attendances.date')
            ->get();

        $ikan = null;
        $ayam = [];
        $kerbau = [];
        $kolom = [];
        foreach ($attendance_students as  $a) {
            $ikan = null;
            if (!in_array($a->date,$kolom)) {
                array_push($kolom, $a->date);
            }
            if (!in_array($a->nim,$kerbau)) {
                array_push($kerbau, $a->nim);
                foreach ($attendance_students as $b) {
                    if ($a->nim == $b->nim) {
                        if ($ikan == null) {
                            $ikan['nim'] = $b->nim;
                            $ikan['name'] = $b->name;
                            $ikan['desc'] = [['date' => $b->date, 'status' => $b->status]];
                        }else {
                            array_push($ikan['desc'], ['date' => $b->date, 'status' => $b->status]);
                        }
                    }
                }
                array_push($ayam,$ikan);
            }
        }
//        dd($attendance);
        if($attendance->isEmpty()){
            session()->flash('flash_fail', 'Tidak Ada Pertemuan pada kelas ini');
            return redirect()->route('admin.attendance.index');
        }else{
            return view('backend/attendance/show', compact('attendance_students', 'attendance', 'kolom', 'ayam'));
        }

    }
}
