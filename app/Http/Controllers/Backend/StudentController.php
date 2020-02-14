<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:manage_students']);
    }

    public function index()
    {
        $students = Student::paginate(25);
        return view('backend.students.index', compact('students'));
    }

    public function create()
    {
        $departments = Department::pluck('name','id');
        $genders = config('central.gender');
        $marital_statuses = config('central.marital_status');
        return view('backend.students.create', compact(
            'departments',
            'genders',
            'marital_statuses'
        ));
    }

    public function store(Request $request)
    {
        $this->validate($request, Student::$validation_rules);

        $user = User::create([
            'username' => request('nim'),
            'email' => request('email'),
            'password' => bcrypt('nim'),
            'status' => 1,
            'type' => User::STUDENT
        ]);

        $user->student()->create($request->only(
            'nim',
            'name',
            'year',
            'birthdate',
            'birthplace',
            'phone',
            'gender',
            'department_id',
            'address',
            'marital_status'));

        if($request->hasFile('photo')){
            $fileExt = $request->photo->extension();
            $fileName = uniqid("photo").".".$fileExt;
            $request->photo->storeAs(
                config('central.folder.student_photo'), $fileName
            );
            $student = $user->student;
            $student->photo = $fileName;
            $student->save();
        }

        session()->flash('flash_success', 'Berhasil menambah data mahasiswa atas nama '. $request->input('name'));
        return redirect()->route('admin.students.show', [$user->id]);
    }

    public function show(Student $student)
    {
        $departments = Department::all();
        $genders = config('central.gender');
        $marital_statuses = config('central.marital_status');
        return view('backend.students.show', compact(
            'student',
            'departments',
            'genders',
            'marital_statuses'
        ));
    }

    public function edit(Student $student)
    {
        $departments = Department::all();
        $genders = config('central.gender');
        $marital_statuses = config('central.marital_status');
        return view('backend.students.edit', compact(
            'student',
            'departments',
            'genders',
            'marital_statuses'
        ));
    }

    public function update(Request $request, Student $student)
    {
        $request->validate(Student::$validation_rules);

        $student->update($request->only(
            'nim',
            'name',
            'year',
            'birthdate',
            'birthplace',
            'phone',
            'gender',
            'department_id',
            'address',
            'marital_status'));

        $student->user->update([
            'password' => bcrypt('secret'),
            'email' => request('email'),
            'status' => 1,
        ]);

        if($request->hasFile('photo')){
            $oldFile = $student->photo;
            $fileExt = $request->photo->extension();
            $fileName = uniqid("photo").".".$fileExt;
            $request->photo->storeAs(
                config('central.folder.student_photo'), $fileName
            );
            $student->photo = $fileName;
            $student->save();
            Storage::delete(config('central.folder.student_photo').'/'.$oldFile);
        }

        session()->flash('flash_success', 'Berhasil mengupdate data mahasiswa '.$student->name);
        return redirect()->route('admin.students.show', [$student->id]);
    }

    public function destroy(Student $student)
    {
        $user = User::find($student->id);
        $student->delete();
        optional($user)->delete();

        session()->flash('flash_success', 'Berhasil menghapus data mahasiswa '.$student->name);
        return redirect()->route('admin.students.index');
    }
}
