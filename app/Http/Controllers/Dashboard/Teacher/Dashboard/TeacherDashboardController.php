<?php

namespace App\Http\Controllers\Dashboard\Teacher\Dashboard;

use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class TeacherDashboardController extends Controller
{
    public function index()  {
        return view('pages.Teachers.dashboard.index');
    }

    public function sections()
    {
        $sections = Teacher::find( Auth::user()->id)->Sections;
        return view('pages.Teachers.dashboard.sections.index', compact('sections'));
    }
}
