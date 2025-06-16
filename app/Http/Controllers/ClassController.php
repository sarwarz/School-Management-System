<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AcademicClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $academic_class = AcademicClass::all();
        return view('backEnd.admin.academic.class',['academic_class'=>$academic_class]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backEnd.admin.academic.add-class');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'   => 'required|unique:academic_classes,name',
            'status' => 'required',
        ], [
            'name.required' => 'Class name is required.',
            'name.unique'   => 'This class name already exists.',
            'status.required' => 'Status is required.',
        ]);


        $data = [
            'name'   => $request->name,
            'status' => $request->status
        ];

        $isCreate = AcademicClass::create($data);

        if ($isCreate) {
            Session::flash('message', 'Class created successfully');
            Session::flash('status', 'success');
            return redirect()->route('admin.class.index');
        } else {
            Session::flash('message', 'Class not created');
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
        $academic_class = AcademicClass::find($id);
        return view('backEnd.admin.academic.edit-class',['academic_class'=>$academic_class]);
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

        $academic_class         = AcademicClass::find($id);
        $academic_class->name   = $request->name;
        $academic_class->status = $request->status;

        
        $isUpdate = $academic_class->update();
        
        if ($isUpdate) {
            Session::flash('message', 'Class update successfully');
            Session::flash('status', 'success');
            return redirect()->route('admin.class.index');
        } else {
            Session::flash('message', 'Class not update');
            Session::flash('status', 'error');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $class = AcademicClass::findOrFail($id);
        $class->delete();

        return redirect()->back()->with('success', 'Class deleted successfully.');
    }
}
