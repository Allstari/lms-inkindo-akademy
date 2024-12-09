<?php

// namespace App\Http\Controllers\Instructor;

// use App\Models\Course;
// use App\Models\Instructor;
// use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
// use Yajra\DataTables\Facades\DataTables;

// class CourseController extends Controller
// {
//     public function index(Request $request)
//     {
//         $instructorId = Auth::user()->instructor->id;

//         if ($request->ajax()) {
//             $courses = Instructor::with('Course')
//                 ->find($instructorId)
//                 ->courses ?? collect();

//             return DataTables::of($courses)->make();
//         }

//         return view('instructor.Courses.index', compact('courses'));
//     }
// }


namespace App\Http\Controllers\Instructor;

use App\Models\Course;
use App\Models\Instructor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $instructorId = Auth::user()->instructor->id;

        if ($request->ajax()) {
            $courses = Instructor::with('courses')
                ->find($instructorId)
                ->courses ?? collect();

            return DataTables::of($courses)->make();
        }

        // Mengirimkan variabel $courses ke view
        return view('instructor.course.index');
    }
}
