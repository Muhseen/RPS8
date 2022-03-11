<?php

namespace App\Services\ProgrammesServices;

use App\Models\Programme;

class ProgrammesServices
{
    public static function getProgrammesByDeptAndType($dept_id, $programme_type)
    {
        return Programme::where('DEPT_ID', $dept_id)->where('PROG_TYPE', $programme_type)->orderBy('PROGRAMME')->get();
    }
}