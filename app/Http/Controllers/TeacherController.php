<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\TeacherDepartment;
use App\Models\TeacherDesignation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class TeacherController extends Controller
{
    /**
     * Display a listing of the teachers.
     */
    public function index()
    {
        $teachers = Teacher::latest()->paginate(10);
        return view('backEnd.admin.teacher.index', compact('teachers'));
    }

    /**
     * Show the form for creating a new teacher.
     */
    public function create()
    {
        $departments = TeacherDepartment::where('status', 1)->get();
        $designations = TeacherDesignation::where('status', 1)->get();

        return view('backEnd.admin.teacher.add-teacher', compact('departments', 'designations'));
    }

    /**
     * Store a newly created teacher in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'teacher_id' => 'required|unique:teachers,teacher_id',
            'first_name' => 'required|string|max:100',
            'last_name' => 'nullable|string|max:100',
            'email' => 'required|email|unique:teachers,email',
            'phone' => 'required|string|max:20',
            'gender' => 'required|in:Male,Female,Other',
            'date_of_birth' => 'required|date_format:Y-m-d',
            'joining_date' => 'nullable|date_format:Y-m-d',
            'designation_id' => 'required',
            'department_id' => 'required',
            'basic_salary' => 'required|numeric',
            'address' => 'required',
            'status' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);


        $data = $request->all();

        // Handle Image Upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads/teachers'), $filename);
            $data['image'] = 'uploads/teachers/'.$filename;
        }

        $isCreate = Teacher::create($data);

        if ($isCreate) {
            Session::flash('message', 'Teacher created successfully');
            Session::flash('status', 'success');
            return redirect()->route('admin.teacher.index');
        } else {
            Session::flash('message', 'Teacher not created');
            Session::flash('status', 'error');
            return redirect()->back();
        }
    }


    /**
     * Show the form for editing the specified teacher.
     */
    public function edit(string $id)
    {
        $teacher = Teacher::findOrFail($id);
        $departments = TeacherDepartment::where('status', 1)->get();
        $designations = TeacherDesignation::where('status', 1)->get();
        return view('backEnd.admin.teacher.edit-teacher', compact('teacher','departments','designations'));
    }

    /**
     * Update the specified teacher in storage.
     */
    public function update(Request $request, string $id)
    {
        $teacher = Teacher::findOrFail($id);

        $request->validate([
            'teacher_id' => [
                'required',
                Rule::unique('teachers')->ignore($teacher->id),
            ],
            'email' => [
                'required',
                'email',
                Rule::unique('teachers')->ignore($teacher->id),
            ],
            'first_name' => 'required|string|max:100',
            'last_name' => 'nullable|string|max:100',
            'phone' => 'required|string|max:20',
            'gender' => 'required|in:Male,Female,Other',
            'date_of_birth' => 'required|date_format:Y-m-d',
            'joining_date' => 'nullable|date_format:Y-m-d',
            'designation_id' => 'required',
            'department_id' => 'required',
            'basic_salary' => 'required|numeric',
            'address' => 'required',
            'status' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        // Handle Image Update
        if ($request->hasFile('image')) {
            if ($teacher->image && File::exists(public_path($teacher->image))) {
                File::delete(public_path($teacher->image));
            }

            $file = $request->file('image');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads/teachers'), $filename);
            $data['image'] = 'uploads/teachers/'.$filename;
        }

        $isUpdate = $teacher->update($data);

        if ($isUpdate) {
            Session::flash('message', 'Teacher update successfully');
            Session::flash('status', 'success');
            return redirect()->route('admin.teacher.index');
        } else {
            Session::flash('message', 'Teacher not update');
            Session::flash('status', 'error');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified teacher from storage.
     */
    public function destroy(string $id)
    {
        $teacher = Teacher::findOrFail($id);

        if ($teacher->image && File::exists(public_path($teacher->image))) {
            File::delete(public_path($teacher->image));
        }

        $teacher->delete();

        return redirect()->back()->with('success', 'Teacher deleted successfully.');
    }
}
