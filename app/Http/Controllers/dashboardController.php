<?php

namespace App\Http\Controllers;

use App\Models\ClassAllocation;
use App\Models\Course;
use App\Models\CourseRegistration;
use App\Models\Programme;
use App\Models\ScoresUploadLog;
use App\Models\Student;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Cache;
use App\Models\Staff;

class dashboardController extends Controller
{
    public function index()
    {
        // auth()->user()->assignRole('HOD');
        // dd(auth()->user()->roles, auth()->user()->can('set-breakdown'), Role::all());
        // //Role::create(['name' => 'HOD']);
        //auth()->user()->assignRole('HOD');
        //dd(auth()->user()->staff);
        $dept_id = auth()->user()->staff->dept->DEPT_ID ?? 13;
        if (auth()->user()->hasRole('HOD')) {
            $studentsCount = Cache::remember($dept_id . 'studentCount', 3600, function () use ($dept_id) {
                return    Student::where('DEPT_ID', $dept_id)->count();
            });
            $coursesCount = Cache::remember($dept_id . 'coursesCount', 3600, function () use ($dept_id) {
                return  Course::where('DEPT_ID', $dept_id)->count();
            });
            $progCount = Cache::remember($dept_id . 'progCount', 3600, function () use ($dept_id) {
                return  Programme::where('DEPT_ID', $dept_id)->count();
            });
            $staffCount = Cache::remember($dept_id . 'staffCount', 3600, function () use ($dept_id) {
                return  Staff::where('dept_id', $dept_id)->count();
            });
            $scoresUpload = ScoresUploadLog::with(['course', 'staff'])->where('dept_id', auth()->user()->staff->dept_id)->orderBY('id', 'DESC')->paginate(10);

            return view('dashboard.hod')
                ->withStudentCount($studentsCount)
                ->withTotalCourses($coursesCount)
                ->withProgCount($progCount)
                ->withStaffCount($staffCount)
                ->withScoresUpload($scoresUpload);;
        } else if (auth()->user()->hasRole('EO')) {

            $studentsCount = Cache::remember($dept_id . 'studentCount', 3600, function () use ($dept_id) {
                return    Student::where('DEPT_ID', $dept_id)->count();
            });
            $coursesCount = Cache::remember($dept_id . 'coursesCount', 3600, function () use ($dept_id) {
                return  Course::where('DEPT_ID', $dept_id)->count();
            });
            $progCount = Cache::remember($dept_id . 'progCount', 3600, function () use ($dept_id) {
                return  Programme::where('DEPT_ID', $dept_id)->count();
            });
            $scoresUpload = ScoresUploadLog::with(['course', 'staff'])->where('dept_id', $dept_id)->orderBY('id', 'DESC')->paginate(10);
            return view('dashboard.examOfficer')
                ->withStudentCount($studentsCount)
                ->withTotalCourses($coursesCount)
                ->withProgCount($progCount)
                ->withScoresUpload($scoresUpload);
        } else if (auth()->user()->hasRole('TTO')) {

            $coursesCount = Cache::remember($dept_id . 'coursesCount', 3600, function () use ($dept_id) {
                return  Course::where('DEPT_ID', $dept_id)->count();
            });
            $progCount = Cache::remember($dept_id . 'progCount', 3600, function () use ($dept_id) {
                return  Programme::where('DEPT_ID', $dept_id)->count();
            });
            $ca = ClassAllocation::with(['courseRel', 'progRel'])->where('dept_id', $dept_id)->paginate(10);
            return view('dashboard.timtableOfficer')
                ->withTotalCourses($coursesCount)
                ->withProgCount($progCount)
                ->withClassAllocations($ca);
        } else {
            $ca = ClassAllocation::with(['courseRel', 'deptRel', 'progRel'])->where('file_no', auth()->user()->file_no)->get();

            $courses = $ca->groupBy('semester');
            //sdd($courses, $courses->first()->count());
            return view('dashboard.lecturer')
                ->withCourses($courses)
                ->withClassAllocations($ca);
        }
    }
}