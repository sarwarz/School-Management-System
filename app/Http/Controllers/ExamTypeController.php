<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ExamType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ExamTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $exam_type = ExamType::all();
        return view('backEnd.admin.examination.exam-type',['exam_type'=>$exam_type]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backEnd.admin.examination.add-exam-type');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'   => 'required|unique:exam_types,name',
            'status' => 'required',
        ], [
            'name.required' => 'Exam type name is required.',
            'name.unique'   => 'This exam type name already exists.',
            'status.required' => 'Status is required.',
        ]);


        $data = [
            'name'   => $request->name,
            'status' => $request->status
        ];

        $isCreate = ExamType::create($data);

        if ($isCreate) {
            Session::flash('message', 'Exam Type created successfully');
            Session::flash('status', 'success');
            return redirect()->route('admin.exam.type.index');
        } else {
            Session::flash('message', 'Exam Type not created');
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
        $exam_type = ExamType::find($id);
        return view('backEnd.admin.examination.edit-exam-type',['exam_type'=>$exam_type]);
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

        $exam_type         = ExamType::find($id);
        $exam_type->name   = $request->name;
        $exam_type->status = $request->status;

        
        $isUpdate = $exam_type->update();
        
        if ($isUpdate) {
            Session::flash('message', 'Exam type update successfully');
            Session::flash('status', 'success');
            return redirect()->route('admin.exam.type.index');
        } else {
            Session::flash('message', 'Exam type not update');
            Session::flash('status', 'error');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $class = ExamType::findOrFail($id);
        $class->delete();

        return redirect()->back()->with('success', 'Exam Type deleted successfully.');
    }
}
