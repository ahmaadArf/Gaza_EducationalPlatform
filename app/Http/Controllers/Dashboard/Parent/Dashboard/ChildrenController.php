<?php

namespace App\Http\Controllers\Dashboard\Parent\Dashboard;

use App\Models\Degree;
use App\Models\Student;
use App\Models\MyParent;
use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\FinalDegree;
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

    public function results($id)
    {

        $student = Student::findorFail($id);

        if ($student->parent_id !== Auth::user()->id) {
            return redirect()->route('parent.dashboard.sons.index')->
            with('msg', 'يوجد خطا في كود الطالب')->with('type', 'danger');
            ;
        }
        $degrees = FinalDegree::where('student_id', $id)->get();

        if ($degrees->isEmpty()) {
            return redirect()->route('parent.dashboard.sons.index')->
            with('msg', 'لا توجد نتائج لهذا الطالب')->with('type', 'danger');
        }

        return view('pages.parents.dashboard.degrees', compact('degrees'));

    }


    public function attendances()
    {
        $students = Student::where('parent_id', Auth::user()->id)->get();
        return view('pages.parents.dashboard.Attendance', compact('students'));
    }

    public function attendanceSearch(Request $request)
    {
        $request->validate([
            'from' => 'required|date|date_format:Y-m-d',
            'to' => 'required|date|date_format:Y-m-d|after_or_equal:from'
        ], [
            'to.after_or_equal' => 'تاريخ النهاية لابد ان اكبر من تاريخ البداية او يساويه',
            'from.date_format' => 'صيغة التاريخ يجب ان تكون yyyy-mm-dd',
            'to.date_format' => 'صيغة التاريخ يجب ان تكون yyyy-mm-dd',
        ]);

        $students = Student::where('parent_id', Auth::user()->id)->get();

        if ($request->student_id == 0) {

            $Students = Attendance::whereBetween('attendence_date', [$request->from, $request->to])->get();
            return view('pages.parents.dashboard.Attendance', compact('Students', 'students'));
        } else {
            $Students = Attendance::whereBetween('attendence_date', [$request->from, $request->to])
                ->where('student_id', $request->student_id)->get();
            return view('pages.parents.dashboard.Attendance', compact('Students', 'students'));

        }

    }
}
