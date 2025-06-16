<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ExamType;
use App\Models\MarkGrade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MarkGradeController extends Controller
{
       /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $marks_grade = MarkGrade::all();
        return view('backEnd.admin.examination.mark-grade',['marks_grade'=>$marks_grade]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backEnd.admin.examination.add-mark-grade');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required|unique:mark_grades,name',
            'point'         => 'required|numeric|min:0|max:5',
            'percent_from'  => 'required|numeric|min:0|max:100|lte:percent_upto',
            'percent_upto'  => 'required|numeric|min:0|max:100|gte:percent_from',
            'status'        => 'required',
        ], [
            'name.required'         => 'Grade name is required.',
            'name.unique'           => 'This grade name already exists.',
            'point.required'        => 'Grade point is required.',
            'point.numeric'         => 'Grade point must be a number.',
            'point.min'             => 'Grade point cannot be less than 0.',
            'point.max'             => 'Grade point cannot be more than 5.',
            'percent_from.required' => 'Starting percentage is required.',
            'percent_from.numeric'  => 'Starting percentage must be a number.',
            'percent_from.min'      => 'Starting percentage must be at least 0.',
            'percent_from.max'      => 'Starting percentage cannot exceed 100.',
            'percent_from.lte'      => 'Starting percentage must be less than or equal to ending percentage.',
            'percent_upto.required' => 'Ending percentage is required.',
            'percent_upto.numeric'  => 'Ending percentage must be a number.',
            'percent_upto.min'      => 'Ending percentage must be at least 0.',
            'percent_upto.max'      => 'Ending percentage cannot exceed 100.',
            'percent_upto.gte'      => 'Ending percentage must be greater than or equal to starting percentage.',
            'status.required'       => 'Status is required.',
        ]);
        


        $data = [
            'name'          => $request->name,
            'point'         => $request->point,
            'percent_from'  => $request->percent_from,
            'percent_upto'  => $request->percent_upto,
            'remarks'       => $request->remarks,
            'status'        => $request->status,
        ];

        $isCreate = MarkGrade::create($data);

        if ($isCreate) {
            Session::flash('message', 'Marks grade added successfully');
            Session::flash('status', 'success');
            return redirect()->route('admin.mark.grade.index');
        } else {
            Session::flash('message', 'Marks grade not created');
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
        $mark_grade = MarkGrade::find($id);
        return view('backEnd.admin.examination.edit-mark-grade',['mark_grade'=>$mark_grade]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'          => 'required|unique:mark_grades,name,' . $id,
            'point'         => 'required|numeric|min:0|max:5',
            'percent_from'  => 'required|numeric|min:0|max:100|lte:percent_upto',
            'percent_upto'  => 'required|numeric|min:0|max:100|gte:percent_from',
            'status'        => 'required',
            'remarks'       => 'nullable|string|max:255',
        ], [
            'name.required'         => 'Grade name is required.',
            'name.unique'           => 'This grade name already exists.',
            'point.required'        => 'Grade point is required.',
            'percent_from.required' => 'Starting percentage is required.',
            'percent_upto.required' => 'Ending percentage is required.',
            'status.required'       => 'Status is required.',
        ]);
    
        $grade = MarkGrade::findOrFail($id);

        $isUpdate = $grade->update([
            'name'          => $request->name,
            'point'         => $request->point,
            'percent_from'  => $request->percent_from,
            'percent_upto'  => $request->percent_upto,
            'remarks'       => $request->remarks,
            'status'        => $request->status,
        ]);
        
        if ($isUpdate) {
            Session::flash('message', 'Merk Grade update successfully');
            Session::flash('status', 'success');
            return redirect()->route('admin.mark.grade.index');
        } else {
            Session::flash('message', 'Mark Grade not update');
            Session::flash('status', 'error');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $class = MarkGrade::findOrFail($id);
        $class->delete();

        return redirect()->back()->with('success', 'Mark grade deleted successfully.');
    }
}
