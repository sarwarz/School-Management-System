<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcademicClass extends Model
{
   
   protected $fillable = [
       'name',
       'status'
   ];

    public function subjectAssigns()
    {
        return $this->hasMany(SubjectAssign::class, 'class_id');
    }

    public function students()
    {
        return $this->hasMany(Student::class, 'class_id');
    }
}
