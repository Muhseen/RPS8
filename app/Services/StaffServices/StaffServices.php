<?php

namespace App\Services\StaffServices;

use App\Models\Department;

use App\Models\Staff;

class StaffServices
{
    public static function getStaffByFileNo($file_no)
    {

        return Staff::where('file_no', $file_no)->first();
    }
}