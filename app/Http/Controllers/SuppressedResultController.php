<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SuppressedResultController extends Controller
{
    public function __construct()
    {
        $this->middleware('HOD');
    }
    public function index()
    {
        return view('suppress.index');
    }
}