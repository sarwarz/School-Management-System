<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubjectAssignDetail extends Model
{
    protected $fillable = [
        'assign_id',
        'subject_id',
        'teacher_id'
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function assign()
    {
        return $this->belongsTo(SubjectAssign::class, 'assign_id');
    }


}
