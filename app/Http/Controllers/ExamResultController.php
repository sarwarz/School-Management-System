<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AcademicClass;
use App\Models\ExamType;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PDF;
use ZipArchive;
use File;

class ExamResultController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $academic_class = AcademicClass::where('status', 1)->get();
        $exam_types = ExamType::where('status', 1)->get();
        $studentsWithMarks = Student::whereHas('marks')->with(['marks','marks.examType', 'class'])->get();
        return view('backEnd.admin.examination.exam-result',compact('studentsWithMarks','academic_class','exam_types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function downloadTranscript($student_id)
    {
        
        $student = Student::with(['marks.subject', 'marks.examType', 'class'])
                ->where('id', $student_id)
                ->firstOrFail();

        // $html = view('backEnd.admin.examination.transcript', compact('student'))->render();
        // return $html;

        $pdf = PDF::loadView('backEnd.admin.examination.transcript', compact('student'));

        $studentName = $student->first_name.' '.$student->last_name;

        $fileName = "transcript_{$studentName}.pdf";

        // Download the generated PDF file
        return $pdf->download($fileName);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function marksheet()
    {
        $academic_class = AcademicClass::where('status', 1)->get();
        $exam_types = ExamType::where('status', 1)->get();
        return view('backEnd.admin.examination.exam-marksheet',compact('academic_class','exam_types'));
    }


    public function downloadAllMarksheet(Request $request)
    {
        $request->validate([
            'class_id' => 'required',
            'exam_type_id' => 'required',
            'session_number' => 'required|integer',
        ]);

        $classId = $request->class_id;
        $examTypeId = $request->exam_type_id;
        $session = $request->session;

        // Filter students
        $students = Student::with(['marks' => function ($query) use ($examTypeId, $session) {
            $query->where('exam_type_id', $examTypeId);
        }, 'marks.subject', 'marks.examType', 'class'])
        ->where('class_id', $classId)
        ->get()
        ->filter(function ($student) {
            return $student->marks->isNotEmpty(); // Only include students who have marks
        });


        if ($students->isEmpty()) {
            return back()->with('error', 'No students found for the selected filters.');
        }

        $tempPath = storage_path('app/public/marksheets/');
        File::ensureDirectoryExists($tempPath);

        $zipFileName = "marksheets_class{$classId}_exam{$examTypeId}_session{$session}.zip";
        $zipFilePath = $tempPath . $zipFileName;

        $zip = new ZipArchive;

        if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
            foreach ($students as $student) {
                $pdf = PDF::loadView('backEnd.admin.examination.transcript', compact('student'));
                $studentName = preg_replace('/[^A-Za-z0-9\-]/', '_', $student->first_name . '_' . $student->last_name);
                $pdfPath = "{$tempPath}transcript_{$studentName}.pdf";
                $pdf->save($pdfPath);
                $zip->addFile($pdfPath, "transcript_{$studentName}.pdf");
            }
            $zip->close();
        } else {
            return back()->with('error', 'Failed to create ZIP file.');
        }

        // Delete the individual PDFs after zipping (optional)
        foreach (File::files($tempPath) as $file) {
            if ($file->getExtension() === 'pdf') {
                File::delete($file->getPathname());
            }
        }

        return response()->download($zipFilePath)->deleteFileAfterSend(true);
    }

}
