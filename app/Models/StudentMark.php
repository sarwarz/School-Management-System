<?php

namespace App\Models;

use App\Models\AcademicClass;
use App\Models\ExamType;
use App\Models\MarkGrade;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Database\Eloquent\Model;

class StudentMark extends Model
{
    protected $fillable = [
        'student_id', 'class_id', 'subject_id', 'exam_type_id', 'mark'
    ];

    // Relationships
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function class()
    {
        return $this->belongsTo(AcademicClass::class); // Replace with actual class model name
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function examType()
    {
        return $this->belongsTo(ExamType::class);
    }

    public function getGradeAttribute()
    {
        $grade = MarkGrade::where('percent_from', '<=', $this->mark)
                        ->where('percent_upto', '>=', $this->mark)
                        ->first();

        return $grade?->name ?? 'N/A';
    }

    public function getPointAttribute()
    {
        $grade = MarkGrade::where('percent_from', '<=', $this->mark)
                        ->where('percent_upto', '>=', $this->mark)
                        ->first();

        return $grade?->point ?? 0;
    }
}

