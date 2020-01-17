<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Attendance;
use App\Models\ClassLecturer;

class AttendanceController extends Controller
{
    function index(){
        $data = DB::table('class_lecturers')
            ->join('lecturers', 'lecturers.id', '=', 'class_lecturers.lecturer_id')
            ->join('classrooms', 'classrooms.id', '=', 'class_lecturers.classroom_id')
            ->join('courses', 'courses.id', '=', 'classrooms.course_id')
            ->select('lecturers.name as nama','classrooms.name as name', 'class_lecturers.id', 'courses.code as namaMK', 'courses.credit as kredit')
            ->get();
        return view('/attendance/index', compact('data'));
    }

    public function show()
    {
        // return view('/attendance/')
    }
}
