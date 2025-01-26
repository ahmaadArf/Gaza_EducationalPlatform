<?php

namespace App\Http\Controllers\Dashboard\Students;

use App\Models\Grade;
use App\Models\Student;
use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function index()
    {
        $Grades = Grade::with(['Sections'])->get();
        $list_Grades = Grade::all();
        return view('pages.Attendance.sections',compact('Grades','list_Grades'));
    }

    public function show($id)
    {
        $students = Student::with('attendance')->where('section_id',$id)->get();
        return view('pages.Attendance.index',compact('students'));
    }

    public function store(Request $request)
    {
        try {

            foreach ($request->attendences as $attendence) {

                Attendance::create([
                    'student_id'=> $request->student_id,
                    'grade_id'=> $request->grade_id,
                    'classroom_id'=> $request->classroom_id,
                    'section_id'=> $request->section_id,
                    'created_by' => Auth::user()->email,
                    'attendence_date'=> date('Y-m-d'),
                    'attendence_status'=> $attendence
                ]);

            }

            return redirect()->back();

        }

        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


}
