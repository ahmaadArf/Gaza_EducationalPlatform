<?php

namespace App\Http\Controllers\Dashboard\Students\Dashboard;

use App\Models\Week;
use App\Models\Subject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SubjectController extends Controller
{
    function index() {
        $subjects=Subject::where('classroom_id',Auth::user()->classroom_id)
        ->where('grade_id',Auth::user()->grade_id)->get();

        return view('pages.Students.dashboard.subject.index',compact('subjects'));
    }

    public function show($id){
        $subject=Subject::find($id);
        $quizes= $subject->quizzes;
        $topics=$subject->topics;
        $weeks=Week::all();
        return view('pages.Students.dashboard.subject.topics',compact('weeks','topics','subject','quizes'));
    }
}
