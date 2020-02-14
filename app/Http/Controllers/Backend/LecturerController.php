<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Lecturer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LecturerController extends Controller
{
    public function __construct()
    {
//        $this->middleware(['permission:manage_lecturers']);
    }

    public function index()
    {
        $lecturers = Lecturer::paginate(25);
        return view('backend.lecturers.index', compact('lecturers'));
    }

    public function create()
    {
        $departments = Department::all();
        $genders = config('central.gender');
        $marital_statuses = config('central.marital_status');
        $religions = config('central.religion');
        $association_types = config('central.lecturer_association');
        return view('backend.lecturers.create', compact(
            'departments',
            'genders',
            'marital_statuses',
            'religions',
            'association_types'
        ));
    }


    public function store(Request $request)
    {
        $this->validate($request, Lecturer::$validation_rules);

        $user = User::create([
            'username' => request('nip'),
            'email' => request('email'),
            'password' => bcrypt('nip'),
            'status' => 1,
            'type' => User::LECTURER
        ]);

        $user->lecturer()->create($request->only(
            'nip',
            'nidn',
            'nik',
            'name',
            'birthday',
            'birthplace',
            'phone',
            'gender',
            'karpeg',
            'npwp',
            'department_id',
            'address',
            'marital_status',
            'religion',
            'association_type'));

        if($request->hasFile('photo')){
            $fileExt = $request->photo->extension();
            $fileName = uniqid("photo").".".$fileExt;
            $request->photo->storeAs(
                config('central.folder.lecturer_photo'), $fileName
            );
            $lecturer = $user->lecturer;
            $lecturer->photo = $fileName;
            $lecturer->save();
        }

        session()->flash('flash_success', 'Berhasil menambahkan data dosen atas nama '. $request->input('name'));
        return redirect()->route('admin.lecturers.show', [$user->id]);
    }


    public function show(Lecturer $lecturer)
    {
        $departments = Department::all();
        $genders = config('central.gender');
        $marital_statuses = config('central.marital_status');
        $religions = config('central.religion');
        $association_types = config('central.lecturer_association');
        return view('backend.lecturers.show', compact(
            'lecturer',
            'departments',
            'genders',
            'marital_statuses',
            'religions',
            'association_types'
        ));
    }

    public function edit(Lecturer $lecturer)
    {
        $departments = Department::all();
        $genders = config('central.gender');
        $marital_statuses = config('central.marital_status');
        $religions = config('central.religion');
        $association_types = config('central.lecturer_association');
        return view('backend.lecturers.edit', compact(
            'lecturer',
            'departments',
            'genders',
            'marital_statuses',
            'religions',
            'association_types'
        ));
    }

    public function update(Request $request, Lecturer $lecturer)
    {
        $this->validate($request, Lecturer::$validation_rules);

        $lecturer->update($request->only(
            'nip',
            'nidn',
            'nik',
            'name',
            'birthday',
            'birthplace',
            'phone',
            'gender',
            'karpeg',
            'npwp',
            'department_id',
            'address',
            'marital_status',
            'religion',
            'association_type'));

        $lecturer->user->update([
            'password' => bcrypt('secret'),
            'email' => request('email'),
            'status' => 1,
        ]);

        if($request->hasFile('photo')){
            $oldFile = $lecturer->photo;
            $fileExt = $request->photo->extension();
            $fileName = uniqid("photo").".".$fileExt;
            $request->photo->storeAs(
                config('central.folder.lecturer_photo'), $fileName
            );
            $lecturer->photo = $fileName;
            $lecturer->save();
            Storage::delete(config('central.folder.lecturer_photo').'/'.$oldFile);
        }

        session()->flash('flash_success', 'Berhasil mengupdate data dosen '.$lecturer->name);
        return redirect()->route('admin.lecturers.show', [$lecturer->id]);
    }

    public function destroy(Lecturer $lecturer)
    {
        $user = User::find($lecturer->id);
        $lecturer->delete();
        optional($user)->delete();

        session()->flash('flash_success', "Berhasil menghapus dosen ".$lecturer->name);
        return redirect()->route('admin.lecturers.index');
    }
}
