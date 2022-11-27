<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseRegistration extends Model
{
    use HasFactory;
    public $table = "course_registrations";
    public $primaryKey = "SN";
    public $timestamps = false;
    public function student()
    {
        return $this->belongsTo(Student::class, 'REG_NUMBER', 'REG_NUMBER');
    }
    public function getTotalAttribute()
    {
        return $this->test1Score + $this->test2Score + $this->assignment1Score + $this->assignment2Score + $this->practical1Score + $this->examination;
    }
    public function course()
    {
        return $this->belongsTo(Course::class, 'COURSE_ID', 'COURSE_ID');
    }
}