<?php

namespace App\Http\Controllers\Dashboard\Teacher\Dashboard;

use App\Models\Week;
use App\Models\Topic;
use App\Models\Subject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::where('teacher_id',Auth::user()->id)->get();
        return view('pages.Teachers.dashboard.subject.index',compact('subjects'));
    }
    public function show($id){
        $subject=Subject::find($id);
        $topics=$subject->topics;
        $weeks=Week::all();
        return view('pages.Teachers.dashboard.subject.topics',compact('weeks','topics','subject'));
    }
    public function create(Request $request){
        $subject=Subject::find($request->subject_id);
        return view('pages.Teachers.dashboard.subject.add',compact('subject'));

    }
    public function store(Request $request) {
        Topic::create([
            'title'=>$request->title,
            'description'=>$request->description,
            'link'=>$request->link,
            'subject_id'=>$request->subject_id,
        ]);
        $subject=Subject::find($request->subject_id);
        $topics=$subject->topics;
        $weeks=Week::all();
        return view('pages.Teachers.dashboard.subject.topics',compact('weeks','topics','subject'));

    }
    public function edit($id) {
        $topic=Topic::find($id);
        return view('pages.Teachers.dashboard.subject.edit',compact('topic'));

    }
    function update($id,Request $request) {
        $topic=Topic::find($id);
        $topic->update([
            'title'=>$request->title,
            'description'=>$request->description,
            'link'=>$request->link,
        ]);
        $subject=Subject::find($topic->subject->id);
        $topics=$subject->topics;
        $weeks=Week::all();
        return view('pages.Teachers.dashboard.subject.topics',compact('weeks','topics','subject'));

    }

}
