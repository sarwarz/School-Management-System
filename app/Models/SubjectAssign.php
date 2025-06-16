<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubjectAssign extends Model
{
    protected $fillable = [
        'class_id',
        'status'
    ];

    public function academicClass()
    {
        return $this->belongsTo(AcademicClass::class, 'class_id');
    }

    public function details()
    {
        return $this->hasMany(SubjectAssignDetail::class, 'assign_id');
    }



    


}
