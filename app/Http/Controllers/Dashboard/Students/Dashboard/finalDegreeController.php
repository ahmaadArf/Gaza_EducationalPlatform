<?php

namespace App\Http\Controllers\Dashboard\Students\Dashboard;


use App\Models\FinalDegree;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class finalDegreeController extends Controller
{
    function index() {

        return view('pages.Students.dashboard.degree.index');
    }
    function store(Request $request) {
         $finalDegrees=FinalDegree::where('student_id',Auth::user()->id)
         ->where('academic_year',$request->year)->get();
         return view('pages.Students.dashboard.degree.index',compact('finalDegrees'));

    }
}
