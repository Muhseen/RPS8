<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScoresUploadLog extends Model
{

    use HasFactory;
    public $guarded = [];
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'COURSE_ID');
    }
    public function department()
    {
        return $this->belongsTo(Department::class, 'dept_id', 'DEPT_ID');
    }
    public function staff()
    {
        return   $this->belongsTo(Staff::class, 'file_no', 'file_no');
    }
}