<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    public $table = 'invoices';
    use HasFactory;

    public function programme()
    {
        return $this->belongsTo(Programme::class, 'PROG_ID', 'PROG_ID');
    }
}