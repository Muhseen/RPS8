<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResultAnalysisData extends Model
{
    use HasFactory;
    protected $table = "analysis_data";
    public $timestamps = false;
}