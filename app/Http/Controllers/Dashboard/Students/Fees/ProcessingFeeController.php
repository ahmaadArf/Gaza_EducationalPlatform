<?php

namespace App\Http\Controllers\Dashboard\Students\Fees;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\ProcessingFee;
use App\Models\StudentAccount;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ProcessingFeeController extends Controller
{
    public function index()
    {
        $ProcessingFees = ProcessingFee::all();
        return view('pages.ProcessingFee.index',compact('ProcessingFees'));
    }

    public function show($id)
    {
        $student = Student::findorfail($id);
        return view('pages.ProcessingFee.add',compact('student'));
    }

    public function edit($id)
    {
        $ProcessingFee = ProcessingFee::findorfail($id);
        return view('pages.ProcessingFee.edit',compact('ProcessingFee'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $ProcessingFee = ProcessingFee::create([
                'date'=>date('Y-m-d'),
                'student_id'=>$request->student_id ,
                'amount'=>$request->Debit ,
                'description'=>$request->description ,
            ]);

            StudentAccount::create([
                'date' => date('Y-m-d'),
                'type' => 'ProcessingFee',
                'processing_id' =>$ProcessingFee->id,
                'student_id' => $request->student_id,
                'debit' => 0.00,
                'credit' => $request->Debit,
                'description' => $request->description,
            ]);


            DB::commit();
            return redirect()->route('dashboard.processingFee.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update(Request $request)
    {
        DB::beginTransaction();

        try {
            // تعديل البيانات في جدول معالجة الرسوم
            $ProcessingFee = ProcessingFee::findorfail($request->id);
            $ProcessingFee->update([
                'date'=>date('Y-m-d'),
                'student_id'=>$request->student_id ,
                'amount'=>$request->Debit ,
                'description'=>$request->description ,
            ]);

            $students_accounts = StudentAccount::where('processing_id',$request->id)->first();;
            $students_accounts->update([
                'date'=>date('Y-m-d'),
                'credit' => $request->Debit,
                'description' => $request->description,
            ]);

            DB::commit();
            return redirect()->route('dashboard.processingFee.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy(Request $request)
    {
        try {
            ProcessingFee::destroy($request->id);
            return redirect()->back();
        }

        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
