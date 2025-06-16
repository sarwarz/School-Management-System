<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AcademicClass;
use App\Models\TeacherDepartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TeacherDepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teacherDepartment = TeacherDepartment::all();
        return view('backEnd.admin.teacher.department',['teacherDepartment'=>$teacherDepartment]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backEnd.admin.teacher.add-department');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'   => 'required|unique:teacher_departments,name',
            'status' => 'required',
        ], [
            'name.required' => 'Department name is required.',
            'name.unique'   => 'This department name already exists.',
            'status.required' => 'Status is required.',
        ]);


        $data = [
            'name'   => $request->name,
            'status' => $request->status
        ];

        $isCreate = TeacherDepartment::create($data);

        if ($isCreate) {
            Session::flash('message', 'Department created successfully');
            Session::flash('status', 'success');
            return redirect()->route('admin.teacher.department.index');
        } else {
            Session::flash('message', 'Department not created');
            Session::flash('status', 'error');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $teacherDepartment = TeacherDepartment::find($id);
        return view('backEnd.admin.teacher.edit-department',['teacherDepartment'=>$teacherDepartment]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'   => 'required',
            'status' => 'required'
        ]);

        $teacherDepartment         = TeacherDepartment::find($id);
        $teacherDepartment->name   = $request->name;
        $teacherDepartment->status = $request->status;

        
        $isUpdate = $teacherDepartment->update();
        
        if ($isUpdate) {
            Session::flash('message', 'Department update successfully');
            Session::flash('status', 'success');
            return redirect()->route('admin.teacher.department.index');
        } else {
            Session::flash('message', 'Department not update');
            Session::flash('status', 'error');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $class = TeacherDepartment::findOrFail($id);
        $class->delete();

        return redirect()->back()->with('success', 'Department deleted successfully.');
    }
}
