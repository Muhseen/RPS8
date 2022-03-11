<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    public function programmes()
    {
        return $this->hasMany(Programme::class, 'DEPT_ID', 'DEPT_ID');
    }
    public function staff()
    {
        return $this->hasMany(Staff::class, 'dept_id', 'DEPT_ID');
    }
    public function college()
    {
        return $this->belongsTo(College::class, 'COL_ID', 'COL_ID');
    }
    public function school()
    {
        return $this->belongsTo(School::class, 'SCH_ID', 'SCH_ID');
    }
}