<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programme extends Model
{
    use HasFactory;
    public function department()
    {
        return $this->belongsTo(Department::class, 'DEPT_ID', 'DEPT_ID');
    }
    public function school()
    {
        return $this->belongsTo(School::class, 'SCH_ID', 'SCH_ID');
    }
    public function course()
    {
        return $this->hasMany(Course::class, 'PROG_ID', 'PROG_ID');
    }
}