<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function student_user(Request $request)
    {
        $user = Auth::user();
        if ($user->student_id == null) {
            $student = Student::create([
                'study_sequence' => $request->study_sequence,
                'section' => $request->section,

                'current_year' => $request->current_year,
                'study_semester' => $request->study_semester,


            ]);
            $user = User::where('id', $user->id)->update([
                'student_id' => $student->id
            ]);
        } else
            return ' already student';
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        //
    }
}
