<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Grade;
use App\Models\Classroom;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ClassroomRole;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Grades=Grade::all();
        $Classrooms=Classroom::all();
        return view('pages.My_Classes.index',compact('Grades','Classrooms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClassroomRole $request)
    {
        $List_Classes = $request->List_Classes;
        $validated = $request->validated();
        foreach ($List_Classes as $List_Class) {

            Classroom::create([
                'name'=>['en'=>$List_Class['Name_class_en'],'ar'=>$List_Class['Name']],
                'grade_id'=>$List_Class['Grade_id']
            ]);

        }
        return redirect()->route('dashboard.classrooms.index')->
            with('msg', trans('messages.success'))->with('type', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClassroomRole $request, string $id)
    {
        $request->validated();
        $classroom=Classroom::findOrFail($id);
        $classroom->update([
            'name'=>['en'=>$request->Name_en,'ar'=>$request->Name],
            'grade_id'=>$request->Grade_id
        ]);
        return redirect()->route('dashboard.classrooms.index')->
        with('msg', trans('messages.Update'))->with('type', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Classroom::findOrFail($id)->delete();
        return redirect()->route('dashboard.classrooms.index')->
        with('msg', trans('messages.Delete'))->with('type', 'danger');
    }

    public function Filter_Classes(Request $request){

        $Grades = Grade::all();
        $Search = Classroom::select('*')->where('grade_id','=',$request->Grade_id)->get();
        return view('pages.My_Classes.index',compact('Grades','Search'));
    }
    public function delete_all(Request $request)
    {
        $delete_all_ids = explode(',', $request->delete_all_id);
        Classroom::whereIn('id',$delete_all_ids)->delete();
        return redirect()->route('dashboard.classrooms.index')->
        with('msg', trans('messages.Delete'))->with('type', 'danger');

    }
}
