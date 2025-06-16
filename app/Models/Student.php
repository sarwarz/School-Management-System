<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\MarkGrade;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory; 

    protected $fillable = [
        'student_id', 'roll_no', 'first_name', 'last_name',
        'father_name', 'mother_name', 'email', 'phone',
        'gender', 'religion', 'date_of_birth',
        'department_id', 'class_id', 'image', 'status'
    ];

    // Relationships
    public function class()
    {
        return $this->belongsTo(AcademicClass::class); // Replace with actual class model name
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function marks()
    {
        return $this->hasMany(StudentMark::class);
    }

    public function getGradeDataAttribute()
    {
        $totalMark = $this->marks->sum('mark');
        $maxMark = $this->marks->count() * 100;
        $percent = $maxMark ? round(($totalMark / $maxMark) * 100, 2) : 0;

        return MarkGrade::getByPercentage($percent);
    }

    public function getGpaAttribute()
    {
        if ($this->marks->count() === 0) return 0;

        return round($this->marks->avg('point'), 2);
    }

}
