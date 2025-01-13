<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Grade;
use App\Models\Section;
use App\Models\Classroom;
use App\Http\Requests\SectionRole;
use App\Http\Controllers\Controller;

class SectionController extends Controller
{
    public function index(){
        $Grades = Grade::with(['Sections'])->get();
        $list_Grades = Grade::all();
        return view('pages.Sections.index',compact('Grades','list_Grades'));

    }
    public function getclasses($id)
    {
        $list_classes = Classroom::where("grade_id", $id)->pluck("name", "id");

        return $list_classes;
    }
    public function store(SectionRole $request)
   {
        $request->validated();
        Section::create([
            'name'=>['ar' => $request->Name_Section_Ar, 'en' => $request->Name_Section_En],
            'grade_id'=>$request->Grade_id,
            'class_id'=>$request->Class_id,
            'status'=>1
        ]);


        return redirect()->route('dashboard.sections.index')->
            with('msg', trans('messages.success'))->with('type', 'success');

    }
    public function update(SectionRole $request){
        $request->validated();
        $section = Section::findOrFail($request->id);

        if(!$request->Status)$status = 0;
        else $status = 1;

        $section->update([
        'name'=>['ar' => $request->Name_Section_Ar, 'en' => $request->Name_Section_En],
        'grade_id'=>$request->Grade_id,
        'class_id'=>$request->Class_id,
        'status'=>$status

        ]);

        return redirect()->route('dashboard.sections.index')->
        with('msg', trans('messages.Update'))->with('type', 'success');
    }
    public function destroy(string $id)
    {
        $sections=Section::findOrFail($id);

        $sections->delete();
        return redirect()->route('dashboard.sections.index')->
        with('msg', trans('messages.Delete'))->with('type', 'danger');
    }
}
