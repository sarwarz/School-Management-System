<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TeacherDesignation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TeacherDesignationController extends Controller
{
       /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teacherDesignation = TeacherDesignation::all();
        return view('backEnd.admin.teacher.designation',['teacherDesignation'=>$teacherDesignation]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backEnd.admin.teacher.add-designation');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'   => 'required|unique:teacher_designations,name',
            'status' => 'required',
        ], [
            'name.required' => 'Designation name is required.',
            'name.unique'   => 'This designation name already exists.',
            'status.required' => 'Status is required.',
        ]);


        $data = [
            'name'   => $request->name,
            'status' => $request->status
        ];

        $isCreate = TeacherDesignation::create($data);

        if ($isCreate) {
            Session::flash('message', 'Designation created successfully');
            Session::flash('status', 'success');
            return redirect()->route('admin.teacher.designation.index');
        } else {
            Session::flash('message', 'Designation not created');
            Session::flash('status', 'error');
            return redirect()->back();
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $teacherDesignation = TeacherDesignation::find($id);
        return view('backEnd.admin.teacher.edit-designation',['teacherDesignation'=>$teacherDesignation]);
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

        $teacherDesignation         = TeacherDesignation::find($id);
        $teacherDesignation->name   = $request->name;
        $teacherDesignation->status = $request->status;

        
        $isUpdate = $teacherDesignation->update();
        
        if ($isUpdate) {
            Session::flash('message', 'Designation update successfully');
            Session::flash('status', 'success');
            return redirect()->route('admin.teacher.designation.index');
        } else {
            Session::flash('message', 'Designation not update');
            Session::flash('status', 'error');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $class = TeacherDesignation::findOrFail($id);
        $class->delete();

        return redirect()->back()->with('success', 'Designation deleted successfully.');
    }
}
