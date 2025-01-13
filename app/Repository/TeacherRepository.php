<?php

namespace App\Repository;
use Exception;
use App\Models\Gender;
use App\Models\Teacher;
use App\Models\Specialization;
use Illuminate\Support\Facades\Hash;

class TeacherRepository implements TeacherRepositoryInterface{

  public function getAllTeachers(){
      return Teacher::all();
  }

    public function Getspecialization(){
        return Specialization::all();
    }

    public function GetGender(){
       return Gender::all();
    }

    public function StoreTeachers($request){

    try {
            Teacher::create([
                'email'=>$request->Email,
                'password'=>Hash::make($request->Password),
                'name'=>['en' => $request->Name_en, 'ar' => $request->Name_ar],
                'specialization_id'=>$request->Specialization_id,
                'gender_id'=>$request->Gender_id,
                'joining_Date'=>$request->Joining_Date,
                'address'=>$request->Address,
            ]);


            return redirect()->route('dashboard.teachers.index')->
            with('msg', trans('messages.success'))->with('type', 'success');
        }
        catch (Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }

    }


    public function editTeachers($id)
    {
        return Teacher::findOrFail($id);
    }


    public function UpdateTeachers($request)
    {
        try {
            $teacher = Teacher::findOrFail($request->id);
            $teacher->update([
                'email'=>$request->Email,
                'password'=>Hash::make($request->Password),
                'name'=>['en' => $request->Name_en, 'ar' => $request->Name_ar],
                'specialization_id'=>$request->Specialization_id,
                'gender_id'=>$request->Gender_id,
                'joining_Date'=>$request->Joining_Date,
                'address'=>$request->Address,
            ]);
            return redirect()->route('dashboard.teachers.index')->
            with('msg', trans('messages.Update'))->with('type', 'success');
        }
        catch (Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }


    public function DeleteTeachers($id)
    {
        Teacher::findOrFail($id)->delete();
        return redirect()->route('dashboard.teachers.index')->
        with('msg', trans('messages.Delete'))->with('type', 'danger');
    }



}
