<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AcademicClass;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Student::query();
    
        // Filter by class_id
        if ($request->filled('class_id')) {
            $query->where('class_id', $request->class_id);
        }
    
        // Filter by keyword (searching in first name, last name, roll no)
        if ($request->filled('search_keyword')) {
            $keyword = $request->search_keyword;
            $query->where(function ($q) use ($keyword) {
                $q->where('first_name', 'like', "%{$keyword}%")
                  ->orWhere('last_name', 'like', "%{$keyword}%")
                  ->orWhere('roll_no', 'like', "%{$keyword}%")
                  ->orWhere('student_id', 'like', "%{$keyword}%");
            });
        }
    
        $students = $query->latest()->paginate(10);
    
        // Preserve query parameters in pagination links
        $students->appends($request->all());
    
        // Fetch all classes for filter dropdown
        $academic_class = AcademicClass::all();
    
        return view('backEnd.admin.student.student-list', compact('students', 'academic_class'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $academic_class = AcademicClass::where('status', 1)->get();

        return view('backEnd.admin.student.add-student', compact('academic_class'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|unique:students,student_id',
            'roll_no' => [
                'required',
                Rule::unique('students')->where(function ($query) use ($request) {
                    return $query->where('class_id', $request->class_id);
                }),
            ],
            'first_name' => 'required|string|max:100',
            'last_name' => 'nullable|string|max:100',
            'father_name' => 'required|string|max:100',
            'mother_name' => 'required|string|max:100',
            'email' => 'nullable|email|unique:students,email',
            'phone' => 'nullable|string|max:20',
            'gender' => 'required|in:Male,Female,Other',
            'date_of_birth' => 'required|date_format:Y-m-d',
            'religion' => 'required|in:Islam,Hindu,Other',
            'class_id' => 'required',
            'department_id' => 'required',
            'status' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);


        $data = $request->all();

        // Handle Image Upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads/students'), $filename);
            $data['image'] = 'uploads/students/'.$filename;
        }

        $isCreate = Student::create($data);

        if ($isCreate) {
            Session::flash('message', 'Student created successfully');
            Session::flash('status', 'success');
            return redirect()->route('admin.student.index');
        } else {
            Session::flash('message', 'Student not created');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
