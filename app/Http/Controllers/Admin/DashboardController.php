<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faculty;
use App\Models\Department;
use App\Models\Course;

class DashboardController extends Controller
{
       public function index()
    {
        $faculties = Faculty::count();
        $departments = Department::count();
        $courses = Course::count();

        return view('admin.dashboard', compact('faculties', 'departments', 'courses'));
    }

}
