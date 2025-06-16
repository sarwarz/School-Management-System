<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AcademicClass;
use App\Models\Subject;
use App\Models\SubjectAssign;
use App\Models\SubjectAssignDetail;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class SubjectAssignController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Load classes with their subject assignments and eager load subjects and teachers via details
        $classes = SubjectAssign::with([
            'academicClass', 
            'details.subject', 
            'details.teacher'
        ])->get();
        return view('backEnd.admin.academic.subject-assign', compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $academic_class = AcademicClass::where('status', 1)->get();
        $subjects = Subject::where('status', 1)->get();
        $teachers = Teacher::where('status', 1)->get();

        return view('backEnd.admin.academic.add-subject-assign', compact('academic_class', 'subjects', 'teachers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'class_id'     => 'required|unique:subject_assigns,class_id',
            'subject_id'   => 'required|array',
            'teacher_id'   => 'required|array',
            'status'       => 'required|boolean',
        ], [
            'class_id.required'      => 'Class is required.',
            'class_id.unique'        => 'This class already has assigned subjects.',
            'subject_id.required'    => 'At least one subject is required.',
            'teacher_id.required'    => 'At least one teacher is required.',
            'status.required'        => 'Status is required.',
        ]);

        DB::beginTransaction();

        try {
            // Create SubjectAssign (class + status)
            $subjectAssign = SubjectAssign::create([
                'class_id' => $request->class_id,
                'status'   => $request->status,
            ]);

            // Insert related subject-teacher assignments in details table
            foreach ($request->subject_id as $index => $subjectId) {
                SubjectAssignDetail::create([
                    'assign_id'  => $subjectAssign->id,
                    'subject_id' => $subjectId,
                    'teacher_id' => $request->teacher_id[$index] ?? null,
                ]);
            }

            DB::commit();

            Session::flash('message', 'Subjects assigned successfully.');
            Session::flash('status', 'success');
            return redirect()->route('admin.academic.subject.assign.index');

        } catch (\Exception $e) {
            DB::rollback();

            Session::flash('message', 'Failed to assign subjects: ' . $e->getMessage());
            Session::flash('status', 'error');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $assign = SubjectAssign::with('details')->findOrFail($id);
        $academic_class = AcademicClass::where('status', 1)->get();
        $subjects = Subject::where('status', 1)->get();
        $teachers = Teacher::where('status', 1)->get();

        return view('backEnd.admin.academic.edit-subject-assign', compact('assign', 'academic_class', 'subjects', 'teachers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'class_id'     => 'required|unique:subject_assigns,class_id,' . $id,
            'subject_id'   => 'required|array',
            'teacher_id'   => 'required|array',
            'status'       => 'required|boolean',
        ], [
            'class_id.required'      => 'Class is required.',
            'class_id.unique'        => 'This class already has assigned subjects.',
            'subject_id.required'    => 'At least one subject is required.',
            'teacher_id.required'    => 'At least one teacher is required.',
            'status.required'        => 'Status is required.',
        ]);

        DB::beginTransaction();

        try {
            $subjectAssign = SubjectAssign::findOrFail($id);
            $subjectAssign->update([
                'class_id' => $request->class_id,
                'status'   => $request->status,
            ]);

            // Delete old details and insert new ones
            SubjectAssignDetail::where('assign_id', $subjectAssign->id)->delete();

            foreach ($request->subject_id as $index => $subjectId) {
                SubjectAssignDetail::create([
                    'assign_id'  => $subjectAssign->id,
                    'subject_id' => $subjectId,
                    'teacher_id' => $request->teacher_id[$index] ?? null,
                ]);
            }

            DB::commit();

            Session::flash('message', 'Subject assignment updated successfully.');
            Session::flash('status', 'success');
            return redirect()->route('admin.academic.subject.assign.index');

        } catch (\Exception $e) {
            DB::rollback();

            Session::flash('message', 'Failed to update subject assignment: ' . $e->getMessage());
            Session::flash('status', 'error');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();

        try {
            $subjectAssign = SubjectAssign::findOrFail($id);

            // Delete details first
            SubjectAssignDetail::where('assign_id', $subjectAssign->id)->delete();

            // Delete main assignment
            $subjectAssign->delete();

            DB::commit();

            Session::flash('message', 'Subject assignment deleted successfully.');
            Session::flash('status', 'success');
            return redirect()->route('admin.academic.subject.assign.index');

        } catch (\Exception $e) {
            DB::rollback();

            Session::flash('message', 'Failed to delete subject assignment: ' . $e->getMessage());
            Session::flash('status', 'error');
            return redirect()->back();
        }
    }
}
