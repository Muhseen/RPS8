<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    //protected   $connection = 'habuDb';
    public $timestamps = false;

    public function getFullnameAttribute()
    {
        return $this->FIRST_NAME . " " . $this->MIDDLE_NAME . " " . $this->LAST_NAME;
    }
    public function registration()
    {
        return $this->hasMany(CourseRegistration::class, 'REG_NUMBER', 'REG_NUMBER');
    }
}