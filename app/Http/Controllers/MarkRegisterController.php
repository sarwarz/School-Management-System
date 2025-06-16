<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AcademicClass;
use App\Models\ExamType;
use App\Models\Student;
use App\Models\StudentMark;
use App\Models\Subject;
use App\Models\SubjectAssignDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class MarkRegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $studentMarks = StudentMark::with(['student', 'class', 'subject', 'examType'])->get();
    
        // Group marks by exam_type_id, class_id, and subject_id
        $marksGrouped = $studentMarks->groupBy(function($item) {
            return $item->exam_type_id . '-' . $item->class_id . '-' . $item->subject_id;
        });
    
        return view('backEnd.admin.examination.mark-register', compact('marksGrouped'));
    }
    


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $academic_class = AcademicClass::where('status', 1)->get();
        $subjects = Subject::where('status', 1)->get();
        $exam_types = ExamType::where('status', 1)->get();
        return view('backEnd.admin.examination.add-mark-register',compact('academic_class','subjects','exam_types'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        // Validate request
        $request->validate([
            'class_id' => 'required|exists:academic_classes,id',
            'subject_id' => 'required|exists:subjects,id',
            'exam_type_id' => 'required|exists:exam_types,id',
            'student_id' => 'required|array',
            'student_id.*' => 'exists:students,id',
            'mark' => 'required|array',
            'mark.*' => 'nullable|numeric|min:0|max:100',
        ]);

       

        $classId = $request->class_id;
        $subjectId = $request->subject_id;
        $examTypeId = $request->exam_type_id;
        $studentIds = $request->student_id;
        $marks = $request->mark;

         // Check if any marks already exist for these students in this subject/class/exam
        $existing = StudentMark::where('class_id', $classId)
        ->where('subject_id', $subjectId)
        ->where('exam_type_id', $examTypeId)
        ->whereIn('student_id', $studentIds)
        ->pluck('student_id')
        ->toArray();

        if (count($existing)) {
            Session::flash('message', 'Marks already added for these students.');
            Session::flash('status', 'error');
            return redirect()->back()->withInput();
        }

        DB::beginTransaction();
        try {
            foreach ($studentIds as $index => $studentId) {

                $markValue = $marks[$index] ?? null;

                // Update or create the mark record
                StudentMark::updateOrCreate(
                    [
                        'student_id' => $studentId,
                        'class_id' => $classId,
                        'subject_id' => $subjectId,
                        'exam_type_id' => $examTypeId,
                    ],
                    [
                        'mark' => $markValue,
                        'status' => 1,
                    ]
                );
            }

            DB::commit();

            Session::flash('message', 'Marks saved successfully.');
            Session::flash('status', 'success');
            return redirect()->route('admin.mark.register.index');

        } catch (\Exception $e) {
            DB::rollBack();

            Session::flash('message', 'Failed to save marks:');
            Session::flash('status', 'error');
            return redirect()->back();
        }
    }


    /**
     * Display the specified resource.
     */
    public function getSubjectsByClass(string $classId)
    {
        $subjects = SubjectAssignDetail::with('subject')
            ->whereHas('assign', function ($query) use ($classId) {
                $query->where('class_id', $classId);
            })
            ->get()
            ->pluck('subject')
            ->unique('id')
            ->values();

        return response()->json($subjects);
    }

    public function getStudentsByClass($classId)
    {
        $students = Student::where('class_id', $classId)
            ->orderBy('roll_no')
            ->get(['id', 'first_name', 'last_name', 'roll_no']);

        return response()->json($students);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $mark_register = StudentMark::with('student')->findOrFail($id);
        $exam_types = ExamType::all();
        $academic_class = AcademicClass::all();


        $classId = $mark_register->class_id;
        $subjects = SubjectAssignDetail::with('subject')
        ->whereHas('assign', function ($query) use ($classId) {
            $query->where('class_id', $classId);
        })
        ->get()
        ->pluck('subject')
        ->unique('id')
        ->values();

        $students = StudentMark::where('exam_type_id', $mark_register->exam_type_id)
        ->where('class_id', $mark_register->class_id)
        ->where('subject_id', $mark_register->subject_id)
        ->with('student')
        ->get();

        return view('backEnd.admin.examination.edit-mark-register', compact('mark_register', 'exam_types', 'academic_class','subjects','students'));
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'exam_type_id' => 'required|exists:exam_types,id',
            'class_id' => 'required|exists:academic_classes,id',
            'subject_id' => 'required|exists:subjects,id',
            'student_id' => 'required|array',
            'student_id.*' => 'exists:students,id',
            'mark' => 'required|array',
            'mark.*' => 'numeric|min:0|max:100',
        ]);
    
        // Update the common info (optional if stored separately)
        $examTypeId = $request->exam_type_id;
        $classId = $request->class_id;
        $subjectId = $request->subject_id;
    
        // Remove old marks for this exam+class+subject (optional based on logic)
        StudentMark::where('exam_type_id', $examTypeId)
            ->where('class_id', $classId)
            ->where('subject_id', $subjectId)
            ->delete();
    
        // Re-insert updated marks
        foreach ($request->student_id as $index => $studentId) {
            StudentMark::create([
                'exam_type_id' => $examTypeId,
                'class_id' => $classId,
                'subject_id' => $subjectId,
                'student_id' => $studentId,
                'mark' => $request->mark[$index],
            ]);
        }
    
        Session::flash('message', 'Marks updated successfully.');
        Session::flash('status', 'success');
        return redirect()->route('admin.mark.register.index');
    }
    


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Get the mark entry to identify which group to delete
        $mark = StudentMark::findOrFail($id);

        // Delete all marks for the same exam type, class, and subject
        StudentMark::where('exam_type_id', $mark->exam_type_id)
            ->where('class_id', $mark->class_id)
            ->where('subject_id', $mark->subject_id)
            ->delete();

        return redirect()->back()->with('success', 'Mark grade deleted successfully.');
    }


}
