<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentShopController extends Controller
{
    function index(Request $request)
    {
        dd($request->all());
        return view('index');
    }

    function store($student_id)
    {
        // cheack if student exists
        $student = \App\Models\student::find($student_id);
        if (!$student) {
            $msg = 'Student_not_found';
            return view('school.index', ['error' => ' الطالب غير موجود ']);
        }
        // cheack if student has already attended today
        // get name of student

        $student_attend = \App\Models\student_attend:: where('student_id', $student_id)
        ->where('date', now()->format('Y-m-d'))->first();
        if ($student_attend) {
            $msg = 'الطالب : ' . $student->name . ' لقد اخذ وجبتة ';
            return view('school.index', ['error' =>  $msg]);
        }
        $student_attend = new \App\Models\student_attend;
        $student_attend->student_id = $student_id;
        $student_attend->date = now();
        $student_attend->save();

        $student_name = $student->name;
        $msg = 'الطالب : ' . $student_name . ' تم تسجيل حضوره بنجاح ';

        // $user_id = auth()->user()->id;
        // $students_attends = \App\Models\student_attend::where('date', now()->format('Y-m-d'))
        //     ->whereHas('student', function ($query) use ($user_id) {
        //         $query->where('school_id', $user_id);
        //     })->get();
        // $students = \App\Models\student::all()->where('school_id', $user_id);


        return view('school.index', ['success'=> 'تم تسجيل حضور الطالب بنجاح']);
    }

    // report function to show all students who attended today  on this schoool

    function reportdayly()
    {
        $user_id = auth()->user()->id;
        $students = \App\Models\student::all() ->where('school_id', $user_id);
        $student_attends = \App\Models\student::whereHas('student_attends', function ($query) {
            $query->where('date', now()->format('Y-m-d'));
        })->where('school_id', $user_id)
        ->get();
        $student_attends_count = $student_attends->count();
        $student_absents = \App\Models\student::whereDoesntHave('student_attends', function ($query) {
            $query->where('date', now()->format('Y-m-d'));
        })->where('school_id', $user_id)
        ->get();
        $student_absents_count = $student_absents->count();
        return view('reports.dayly', compact('student_absents', 'student_attends', 'student_attends_count', 'student_absents_count'));
    }
}

// report function to show all students who attended monthly  on this schoool
function reportmonthly(Request $request)
{
    if ($request->start && $request->end) {
        $start = $request->start;
        $end = $request->end;
    } else {
        $start = now()->startOfMonth()->format('Y-m-d');
        $end = now()->endOfMonth()->format('Y-m-d');
    }
    $user_id = auth()->user()->id;
    $students = \App\Models\student::all() ->where('school_id', $user_id);
    $student_attends = \App\Models\student_attend::where('date', now()->format('Y-m-d'))
        ->whereHas('student', function ($query) use ($user_id) {
            $query->where('school_id', $user_id);
        })
    ->get();
    return view('student_shop_report', compact('students', 'student_attends'));
}

// report function to show one students who attended   on this schoool
function reportstudent(Request $request)
{
    if ($request->start && $request->end) {
        $start = $request->start;
        $end = $request->end;
    } else {
        $start = now()->startOfMonth()->format('Y-m-d');
        $end = now()->endOfMonth()->format('Y-m-d');
    }
    $user_id = auth()->user()->id;
    $students = \App\Models\student::all() ->where('school_id', $user_id);
    $student_attends = \App\Models\student_attend::where('date', now()->format('Y-m-d'))
        ->whereHas('student', function ($query) use ($user_id) {
            $query->where('school_id', $user_id);
        })
        ->where('student_id', $request->student_id)
    ->get();
    return view('student_shop_report', compact('students', 'student_attends'));
}