<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class, 'file_no', 'file_no');
    }
    public function dept()
    {
        return $this->belongsTo(Department::class,  'dept_id', 'DEPT_ID');
    }
}