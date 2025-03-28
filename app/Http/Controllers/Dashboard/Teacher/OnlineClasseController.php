<?php

namespace App\Http\Controllers\Dashboard\Teacher;

use App\Models\Grade;
use App\Models\OnlineClass;
use Illuminate\Http\Request;
use Jubaer\Zoom\Facades\Zoom;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OnlineClasseController extends Controller
{
    public function index()
    {
        $online_classes = OnlineClass::all();
        return view('pages.online_classes.index', compact('online_classes'));
    }


    public function create()
    {
        $Grades = Grade::all();
        return view('pages.online_classes.add', compact('Grades'));
    }

    public function store(Request $request)
    {
        try {
            $meeting = Zoom::createMeeting([
                "topic" => $request->topic,
                "duration" => $request->duration, // in minutes
                "timezone" => config('zoom.timezone'), // set your timezone
                "password" => '22password',
                "start_time" => $request->start_time, // set your start time
            ]);

            OnlineClass::create([
                'grade_id' => $request->Grade_id,
                'classroom_id' => $request->Classroom_id,
                'section_id' => $request->section_id,
                'created_by' => Auth::user()->email,
                'meeting_id' => $meeting['data']['id'],
                'topic' => $request->topic,
                'start_time' => $request->start_time,
                'duration' => $meeting['data']['duration'],
                'password' => $meeting['data']['password'],
                'start_url' =>$meeting['data']['start_url'] ,
                'join_url' =>$meeting['data']['join_url'] ,
            ]);
            return redirect()->route('dashboard.online_classes.index')->
            with('msg', trans('messages.success'))->with('type', 'success');

        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }

    }

    public function destroy(Request $request)
    {
       try {
        $onlineClass=OnlineClass::where('meeting_id', $request->meeting_id)->first();

        Zoom::deleteMeeting($request->meeting_id);
        $onlineClass->delete();

        return redirect()->route('dashboard.online_classes.index')->
        with('msg', trans('messages.Delete'))->with('type', 'danger');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }

    }
}
