<?php

use App\Http\Controllers\BackEndController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\ExamResultController;
use App\Http\Controllers\ExamTypeController;
use App\Http\Controllers\MarkGradeController;
use App\Http\Controllers\MarkRegisterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectAssignController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TeacherDepartmentController;
use App\Http\Controllers\TeacherDesignationController;
use Illuminate\Support\Facades\Route;













Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



// for admin routes

Route::get('/admin', [BackEndController::class, 'admin'])->middleware(['auth', 'verified','checkadmin'])->name('admin');

Route::middleware(['auth', 'verified','checkadmin'])->prefix('/admin')->group(function () {

    Route::get('/student', [StudentController::class, 'index'])->name('admin.student.index');
    Route::get('/student/add', [StudentController::class, 'create'])->name('admin.student.add');
    Route::post('/student/create', [StudentController::class, 'store'])->name('admin.student.create');
    Route::get('/student/edit/{id}', [StudentController::class, 'edit'])->name('admin.student.edit');
    Route::put('/student/edit/{id}', [StudentController::class, 'update'])->name('admin.student.update');
    Route::delete('/student/delete/{id}', [StudentController::class, 'destroy'])->name('admin.student.destroy');


    Route::get('/teacher', [TeacherController::class, 'index'])->name('admin.teacher.index');
    Route::get('/teacher/add', [TeacherController::class, 'create'])->name('admin.teacher.add');
    Route::post('/teacher/create', [TeacherController::class, 'store'])->name('admin.teacher.create');
    Route::get('/teacher/edit/{id}', [TeacherController::class, 'edit'])->name('admin.teacher.edit');
    Route::put('/teacher/edit/{id}', [TeacherController::class, 'update'])->name('admin.teacher.update');
    Route::delete('/teacher/delete/{id}', [TeacherController::class, 'destroy'])->name('admin.teacher.destroy');

    Route::get('/teacher/department', [TeacherDepartmentController::class, 'index'])->name('admin.teacher.department.index');
    Route::get('/teacher/department/add', [TeacherDepartmentController::class, 'create'])->name('admin.teacher.department.add');
    Route::post('/teacher/department/create', [TeacherDepartmentController::class, 'store'])->name('admin.teacher.department.create');
    Route::get('/teacher/department/edit/{id}', [TeacherDepartmentController::class, 'edit'])->name('admin.teacher.department.edit');
    Route::put('/teacher/department/edit/{id}', [TeacherDepartmentController::class, 'update'])->name('admin.teacher.department.update');
    Route::delete('/teacher/department/delete/{id}', [TeacherDepartmentController::class, 'destroy'])->name('admin.teacher.department.destroy');

    Route::get('/teacher/designation', [TeacherDesignationController::class, 'index'])->name('admin.teacher.designation.index');
    Route::get('/teacher/designation/add', [TeacherDesignationController::class, 'create'])->name('admin.teacher.designation.add');
    Route::post('/teacher/designation/create', [TeacherDesignationController::class, 'store'])->name('admin.teacher.designation.create');
    Route::get('/teacher/designation/edit/{id}', [TeacherDesignationController::class, 'edit'])->name('admin.teacher.designation.edit');
    Route::put('/teacher/designation/edit/{id}', [TeacherDesignationController::class, 'update'])->name('admin.teacher.designation.update');
    Route::delete('/teacher/designation/delete/{id}', [TeacherDesignationController::class, 'destroy'])->name('admin.teacher.designation.destroy');


    Route::get('/assign-subject', [SubjectAssignController::class, 'index'])->name('admin.academic.subject.assign.index');
    Route::get('/assign-subject/add', [SubjectAssignController::class, 'create'])->name('admin.academic.subject.assign.add');
    Route::post('/assign-subject/create', [SubjectAssignController::class, 'store'])->name('admin.academic.subject.assign.create');
    Route::get('/assign-subject/edit/{id}', [SubjectAssignController::class, 'edit'])->name('admin.academic.subject.assign.edit');
    Route::put('/assign-subject/edit/{id}', [SubjectAssignController::class, 'update'])->name('admin.academic.subject.assign.update');
    Route::delete('/assign-subject/delete/{id}', [SubjectAssignController::class, 'destroy'])->name('admin.academic.subject.assign.destroy');

    Route::get('/classes', [ClassController::class, 'index'])->name('admin.class.index');
    Route::get('/classes/add', [ClassController::class, 'create'])->name('admin.class.add');
    Route::post('/classes/create', [ClassController::class, 'store'])->name('admin.class.create');
    Route::get('/classes/edit/{id}', [ClassController::class, 'edit'])->name('admin.class.edit');
    Route::put('/classes/edit/{id}', [ClassController::class, 'update'])->name('admin.class.update');
    Route::delete('/classes/delete/{id}', [ClassController::class, 'destroy'])->name('admin.class.destroy');

    Route::get('/subject', [SubjectController::class, 'index'])->name('admin.subject.index');
    Route::get('/subject/add', [SubjectController::class, 'create'])->name('admin.subject.add');
    Route::post('/subject/create', [SubjectController::class, 'store'])->name('admin.subject.create');
    Route::get('/subject/edit/{id}', [SubjectController::class, 'edit'])->name('admin.subject.edit');
    Route::put('/subject/edit/{id}', [SubjectController::class, 'update'])->name('admin.subject.update');
    Route::delete('/subject/delete/{id}', [SubjectController::class, 'destroy'])->name('admin.subject.destroy');

    Route::get('/exam-type', [ExamTypeController::class, 'index'])->name('admin.exam.type.index');
    Route::get('/exam-type/add', [ExamTypeController::class, 'create'])->name('admin.exam.type.add');
    Route::post('/exam-type/create', [ExamTypeController::class, 'store'])->name('admin.exam.type.create');
    Route::get('/exam-type/edit/{id}', [ExamTypeController::class, 'edit'])->name('admin.exam.type.edit');
    Route::put('/exam-type/edit/{id}', [ExamTypeController::class, 'update'])->name('admin.exam.type.update');
    Route::delete('/exam-type/delete/{id}', [ExamTypeController::class, 'destroy'])->name('admin.exam.type.destroy');

    Route::get('/marks-grade', [MarkGradeController::class, 'index'])->name('admin.mark.grade.index');
    Route::get('/marks-grade/add', [MarkGradeController::class, 'create'])->name('admin.mark.grade.add');
    Route::post('/marks-grade/create', [MarkGradeController::class, 'store'])->name('admin.mark.grade.create');
    Route::get('/marks-grade/edit/{id}', [MarkGradeController::class, 'edit'])->name('admin.mark.grade.edit');
    Route::put('/marks-grade/edit/{id}', [MarkGradeController::class, 'update'])->name('admin.mark.grade.update');
    Route::delete('/marks-grade/delete/{id}', [MarkGradeController::class, 'destroy'])->name('admin.mark.grade.destroy');

    Route::get('/marks-register', [MarkRegisterController::class, 'index'])->name('admin.mark.register.index');
    Route::get('/marks-register/add', [MarkRegisterController::class, 'create'])->name('admin.mark.register.add');
    Route::post('/marks-register/create', [MarkRegisterController::class, 'store'])->name('admin.mark.register.create');
    Route::get('/marks-register/edit/{id}', [MarkRegisterController::class, 'edit'])->name('admin.mark.register.edit');
    Route::put('/marks-register/edit/{id}', [MarkRegisterController::class, 'update'])->name('admin.mark.register.update');
    Route::delete('/marks-register/delete/{id}', [MarkRegisterController::class, 'destroy'])->name('admin.mark.register.destroy');
    Route::get('/get-subjects-by-class/{class_id}', [MarkRegisterController::class, 'getSubjectsByClass']);
    Route::get('/get-students-by-class/{class_id}', [MarkRegisterController::class, 'getStudentsByClass']);

    Route::get('/exam-result', [ExamResultController::class, 'index'])->name('admin.exam.result.index');
    Route::get('/exam-result/{student}/transcript', [ExamResultController::class, 'downloadTranscript'])->name('examResult.downloadTranscript');
    Route::get('/exam-marksheet', [ExamResultController::class, 'marksheet'])->name('admin.exam.marksheet.index');
    Route::post('/download-marksheets', [ExamResultController::class, 'downloadAllMarksheet'])->name('admin.downloadAllMarksheet');




    
});

// for teacher routes

Route::get('/teacher', [BackEndController::class, 'teacher'])->middleware(['auth', 'verified','checkteacher'])->name('teacher');

Route::middleware(['auth', 'verified','checkteacher'])->prefix('/teacher')->group(function () {

    
});

// for student routes

Route::get('/student', [BackEndController::class, 'student'])->middleware(['auth', 'verified','checkstudent'])->name('student');

Route::middleware(['auth', 'verified','checkstudent'])->prefix('/student')->group(function () {

    
});

require __DIR__.'/auth.php';
