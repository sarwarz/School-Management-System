<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = [
        'teacher_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'gender',
        'date_of_birth',
        'joining_date',
        'marital_status',
        'status',
        'designation_id', // Or 'designation_id'
        'department_id', // Or 'department_id'
        'address',
        'basic_salary',
        'image',
    ];

    public function department()
    {
        return $this->belongsTo(TeacherDepartment::class, 'department_id');
    }

    public function designation()
    {
        return $this->belongsTo(TeacherDesignation::class, 'designation_id');
    }
    
}
