<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScoresBreakDown extends Model
{
    use HasFactory;
    public $table = "scores_breakdown";
    public $guarded = [];
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'COURSE_ID');
    }
}