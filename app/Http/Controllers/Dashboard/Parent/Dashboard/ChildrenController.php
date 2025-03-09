<?php

namespace App\Http\Controllers\Dashboard\Parent\Dashboard;

use App\Models\Student;
use App\Models\MyParent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChildrenController extends Controller
{
    public function index()
    {
        $students = Student::where('parent_id', Auth::user()->id)->get();
        return view('pages.parents.dashboard.children.index', compact('students'));
    }
    public function profile()
    {
        $information = MyParent::findorFail(Auth::user()->id);
        return view('pages.parents.dashboard.profile', compact('information'));
    }

    public function update(Request $request, $id)
    {

        $information = MyParent::findorFail($id);

        if (!empty($request->password)) {
            $information->Name_Father = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $information->password = Hash::make($request->password);
            $information->save();
        } else {
            $information->Name_Father = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $information->save();
        }
        return redirect()->back()->
        with('msg', trans('messages.Update'))->with('type', 'success');;


    }
}
