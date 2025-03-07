<?php

namespace App\Http\Controllers\Dashboard\Teacher\Dashboard;

use App\Models\Student;
use App\Models\Subject;
use App\Models\FinalDegree;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class finalDegreeController extends Controller
{
    function index() {
        $subjects = Subject::where('teacher_id',Auth::user()->id)->get();
        return view('pages.Teachers.dashboard.degree.index',compact('subjects'));
    }

    function show($id) {
        $subject = Subject::find($id);
        $students=Student::where('Grade_id',$subject->grade->id)
        ->where('Classroom_id',$subject->classroom->id)->get();
        return view('pages.Teachers.dashboard.degree.show',compact('students','subject'));
    }
    public function store(Request $request){
        foreach ($request->finalMiddegree as $studentid => $mid) {
            FinalDegree::create([
                'subject_id'=>$request->subject_id,
                'student_id'=>$studentid,
                'mid'=>$mid,
                'grade_id'=>$request->grade_id,
                'classroom_id'=>$request->classroom_id,
                'section_id'=>Student::find($studentid)->section->id,
                'academic_year'=>date('Y')
            ]);
        }
        foreach ($request->finalFinaldegree as $studentid => $final) {
            FinalDegree::where('subject_id',$request->subject_id)
            ->where('student_id',$studentid)
            ->where('academic_year',date('Y'))->update([
                'final'=>$final
            ]);
        }
        $subject = Subject::find($request->subject_id);
        $students=Student::where('Grade_id',$subject->grade->id)
        ->where('Classroom_id',$subject->classroom->id)->get();
        return view('pages.Teachers.dashboard.degree.show',compact('students','subject'));

    }

}
