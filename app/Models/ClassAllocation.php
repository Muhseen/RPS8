<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClassAllocation extends Model
{
    use HasFactory;
    use SoftDeletes;
    public $guarded = [];
    public function deptRel()
    {
        return $this->hasOne(Department::class, 'DEPT_ID', 'dept_id');
    }
    public function courseRel()
    {
        return $this->hasOne(Course::class, 'COURSE_ID', 'course_id');
    }
    public function progRel()
    {
        return $this->hasOne(Programme::class, 'PROG_ID', 'prog_id');
    }
}
