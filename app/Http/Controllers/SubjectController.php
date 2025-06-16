<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subject = Subject::all();
        return view('backEnd.admin.academic.subject',['subject'=>$subject]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backEnd.admin.academic.add-subject');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'   => 'required|unique:subjects,name',
            'code'   => 'required',
            'type'   => 'required',
            'status' => 'required',
        ], [
            'name.required' => 'Subject name is required.',
            'name.unique'   => 'This subject name already exists.',
            'code.required' => 'Subject code is required.',
            'type.required' => 'Subject type is required.',
            'status.required' => 'Status is required.',
        ]);


        $data = [
            'name'   => $request->name,
            'code'   => $request->code,
            'type'   => $request->type,
            'status' => $request->status
        ];

        $isCreate = Subject::create($data);

        if ($isCreate) {
            Session::flash('message', 'Subject created successfully');
            Session::flash('status', 'success');
            return redirect()->route('admin.subject.index');
        } else {
            Session::flash('message', 'Subject not created');
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
        $subject = subject::find($id);
        return view('backEnd.admin.academic.edit-subject',['subject'=>$subject]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'   => 'required|unique:subjects,name',
            'code'   => 'required',
            'type'   => 'required',
            'status' => 'required',
        ], [
            'name.required' => 'Subject name is required.',
            'name.unique'   => 'This subject name already exists.',
            'code.required' => 'Subject code is required.',
            'type.required' => 'Subject type is required.',
            'status.required' => 'Status is required.',
        ]);

        $subject         = Subject::find($id);
        $subject->name   = $request->name;
        $subject->code   = $request->code;
        $subject->type   = $request->type;
        $subject->status = $request->status;

        
        $isUpdate = $subject->update();
        
        if ($isUpdate) {
            Session::flash('message', 'Subject update successfully');
            Session::flash('status', 'success');
            return redirect()->route('admin.subject.index');
        } else {
            Session::flash('message', 'Subject not update');
            Session::flash('status', 'error');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $class = Subject::findOrFail($id);
        $class->delete();

        return redirect()->back()->with('success', 'Subject deleted successfully.');
    }
}
