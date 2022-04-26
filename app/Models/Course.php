<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    public $primaryKey = "COURSE_ID";
    public $guarded = [];
    public $timestamps = false;
    public function ScoresBreakDown()
    {
        return $this->hasOne(ScoresBreakDown::class, 'course_id', 'COURSE_ID');
    }
    public function programme()
    {
        return $this->belongsTo(Programme::class, 'PROG_ID', 'PROG_ID');
    }
}