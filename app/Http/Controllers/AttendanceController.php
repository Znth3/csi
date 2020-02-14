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

    public function edit($id){
        $attendance_students = DB::table('attendance_students')
            ->join('attendances','attendance_id','=','attendances.id')
            ->join('course_selections','attendance_students.course_selection_id','=','course_selections.id')
            ->join('classrooms','course_selections.classroom_id','=','classrooms.id')
            ->join('courses','classrooms.course_id','=','courses.id')
            ->join('student_semesters','course_selections.student_semester_id','=','student_semesters.id')
            ->join('students','student_id','=','students.id')
            ->select('attendances.id AS att_id','attendance_students.id','students.nim','students.name','attendance_students.status','attendances.date','courses.code',
                'courses.name AS crs_name','courses.credit','attendances.start_at','attendances.end_at','courses.id AS crs_id')
            ->where([
                ['attendances.id','=', $id]
            ])
            ->get();

        return view('backend.attendance.edit', compact('attendance_students'));
    }


    public function update(Request $request, $id){
        DB::table('attendance_students')
            ->where('id', '=', $request->id)
            ->update(['status' => $request->status]);

        return redirect(route('detailabsen', ['id' => $id]))->with('flash_message', 'Data updated!')    ;
        // return redirect('/attendance/edit/'.$id)->with('flash_message', 'Data updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function showStudent($id){
        // dd('aa');
        $attendance_students = DB::table('attendance_students')
            ->join('attendances','attendance_id','=','attendances.id')
            ->join('course_selections','attendance_students.course_selection_id','=','course_selections.id')
            ->join('classrooms','course_selections.classroom_id','=','classrooms.id')
            ->join('courses','classrooms.course_id','=','courses.id')
            ->join('student_semesters','course_selections.student_semester_id','=','student_semesters.id')
            ->join('students','student_id','=','students.id')
            ->select('students.nim','students.name','attendance_students.status','attendances.date','courses.code',
                'courses.name AS crs_name','courses.credit','attendances.start_at','attendances.end_at')
            ->where([
                ['attendances.id','=', $id]
            ])
            ->get();
        // dd($attendance_students);

        return view('backend.attendance.student', compact('attendance_students'));
    }

    public function store(Request $request){
        $date = $request->date;
        $newdate = date("Y-m-d", strtotime($date));

        $students = DB::table('classrooms')
            ->join('course_selections','course_selections.classroom_id','=','classrooms.id')
            ->join('student_semesters','course_selections.student_semester_id','=','student_semesters.id')
            ->join('students','student_id','=','students.id')
            ->select('students.name AS std_name','students.nim','course_selections.id AS crs_id')
            ->get();

        DB::table('attendances')->insertGetId(
            array('class_lecturer_id' => $request->class_lecturer_id,
                'meeting_no'=> $request->meeting_no,
                'date' => $newdate,
                'start_at'=> $request->start_at,
                'end_at'=> $request->end_at,
                'room_id'=> $request->room_id,
                'photo'=> $request->photo,
                'status'=> 1
            )
        );
        $attendance = DB::table('attendances')
            ->orderby('id','desc')
            ->limit(1)
            ->get();

        foreach ($students as $student) {
            DB::table('attendance_students')->insertGetId(
                array('attendance_id' => $attendance[0]->id,
                    'course_selection_id'=> $student->crs_id,
                    'check_in_time'=> $request->start_at,
                    'check_out_time'=> $request->end_at,
                    'status'=> 1,
                )
            );
        }

        $attendance_students = DB::table('attendance_students')
            ->join('attendances','attendance_id','=','attendances.id')
            ->join('course_selections','attendance_students.course_selection_id','=','course_selections.id')
            ->join('classrooms','course_selections.classroom_id','=','classrooms.id')
            ->join('courses','classrooms.course_id','=','courses.id')
            ->join('student_semesters','course_selections.student_semester_id','=','student_semesters.id')
            ->join('students','student_id','=','students.id')
            ->select('students.nim','students.name','attendance_students.status','attendances.date','attendances.id')
            ->where([
                ['attendances.id','=', $attendance[0]->id]
            ])
            ->get();
        // dd($attendance_students[0]);

        // return redirect(route('presensi', ['id' => $id]));
        return redirect('admin/attendance/student/'.$attendance_students[0]->id."/detail");
    }


    function index(Request $request){
        $semester = $request->get('semester');
        $term = DB::table('semesters')->orderBy('year', 'desc')->orderBy('period', 'desc')->get();

        if(!empty($semester)){
            $semester=$semester;
        }else{
            $year = date("Y");
            $month = date("m");

            if($month > 7){
                $month = 1;
            }else{
                $month = 2;
            }

            $limit = DB::table('semesters')
                ->where([['semesters.year','=', $year],
                    ['semesters.period', '=', $month]])
                ->orderBy('period')
                ->limit(1)
                ->get();
            foreach ($limit as $l){
                $semester = $l->id;
            }
        }
        $termTitle = DB::table('semesters')
            ->where([['id', '=', $semester]])
            ->get();

        $data = DB::table('class_lecturers')
            ->join('lecturers', 'lecturers.id', '=', 'class_lecturers.lecturer_id')
            ->join('classrooms', 'classrooms.id', '=', 'class_lecturers.classroom_id')
            ->join('courses', 'courses.id', '=', 'classrooms.course_id')
            ->join('semesters', 'classrooms.semester_id', '=', 'semesters.id')
            ->select('lecturers.name as nama','classrooms.name as name', 'class_lecturers.id', 'courses.name as namaMK', 'semesters.year','courses.code as kode', 'courses.credit as kredit', 'semesters.period')
            ->where([['semesters.id','=' ,$semester]])
            ->get();

        if($data == null){
            return 0;
        }else{
            return view('backend/attendance/index', compact('data', 'term', 'termTitle'));

        }
    }

    public function show($id, $jenis=null)
    {

        $attendance = DB::table('attendances')
            ->join('class_lecturers','class_lecturer_id','=','class_lecturers.id')
            ->join('lecturers','class_lecturers.lecturer_id','=','lecturers.id')
            ->join('classrooms','class_lecturers.classroom_id','=','classrooms.id')
            ->join('courses','classrooms.course_id','=','courses.id')
            ->where([['class_lecturers.id','=', $id]])
            ->select('attendances.*','courses.name AS crs_name','courses.code','courses.semester','lecturers.name AS lecname', 'classrooms.name as className')
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
            ->select('students.nim','students.name','attendance_students.status','attendances.date', 'attendance_students.id')
            ->get();

        $ikan = null;
        $ayam = [];
        $kerbau = [];
        $kolom = [];
        $bebek = [];
        // dd($attendance_students);
        foreach($attendance as $a){
            $kolom[] = ['id' => $a->id, 'tgl' => $a->date];
        }
        foreach ($attendance_students as  $a) {
            // dd($a);
            $ikan = null;
            // if (in_array($a->id,$bebek)) {
            //     array_push($kolom, $a->date);
            // }
            // if (!in_array($a->date,$kolom)) {
            //     array_push($kolom, $a->date);
            // }
            if (!in_array($a->nim,$kerbau)) {
                array_push($kerbau, $a->nim);
                // dd($attendance_students);
                foreach ($attendance_students as $b) {
                    if ($a->nim == $b->nim) {
                        if ($ikan == null) {
                            $ikan['nim'] = $b->nim;
                            $ikan['name'] = $b->name;
                            $ikan['desc'] = [['date' => $b->date, 'status' => $b->status, 'id' => $b->id]];
                        }else {
                            array_push($ikan['desc'], ['date' => $b->date, 'status' => $b->status, 'id' => $b->id]);
                        }
                    }
                }
                array_push($ayam, $ikan);

            }
        }
//        dd($kolom);
        if($jenis == 'print'){
            return view('backend.attendance.tabel', compact('ayam', 'kolom', 'attendance', 'attendance_students'));
        } else{
            // dd($ayam);
            return view('backend.attendance.show', compact('attendance','attendance_students', 'ayam','kolom'));
        }

    }
}
