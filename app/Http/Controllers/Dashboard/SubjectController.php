<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Grade;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSubjectRequest;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::get();
        return view('pages.Subjects.index',compact('subjects'));
    }

    public function create()
    {
        $grades = Grade::get();
        $teachers = Teacher::get();
        return view('pages.Subjects.create',compact('grades','teachers'));
    }


    public function store(StoreSubjectRequest $request)
    {
        try {
             Subject::create([
                'name'=>['en' => $request->Name_en, 'ar' => $request->Name_ar],
                'grade_id'=>$request->Grade_id,
                'classroom_id'=>$request->Class_id,
                'teacher_id'=>$request->teacher_id,
            ]);

            return redirect()->route('dashboard.subjects.index')->
            with('msg', trans('messages.success'))->with('type', 'success');
        }
        catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }


    public function edit($id){

        $subject =Subject::findorfail($id);
        $grades = Grade::get();
        $teachers = Teacher::get();
        return view('pages.Subjects.edit',compact('subject','grades','teachers'));

    }

    public function update(StoreSubjectRequest $request)
    {
        try {
            Subject::findorfail($request->id)->update([
                'name'=>['en' => $request->Name_en, 'ar' => $request->Name_ar],
                'grade_id'=>$request->Grade_id,
                'classroom_id'=>$request->Class_id,
                'teacher_id'=>$request->teacher_id,

            ]);

            return redirect()->route('dashboard.subjects.index')->
            with('msg', trans('messages.Update'))->with('type', 'success');;
        }
        catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function destroy(Request $request)
    {
        try {
            Subject::destroy($request->id);
            return redirect()->back()->
            with('msg', trans('messages.Delete'))->with('type', 'success');
        }

        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
