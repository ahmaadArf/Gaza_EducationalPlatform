<?php

namespace App\Http\Controllers\Dashboard\Students\Fees;

use App\Models\Student;
use App\Models\FundAccount;
use Illuminate\Http\Request;
use App\Models\ReceiptStudent;
use App\Models\StudentAccount;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ReceiptStudentController extends Controller
{
    public function index()
    {
        $receipt_students = ReceiptStudent::all();
        return view('pages.Receipt.index',compact('receipt_students'));

    }

    public function show($id)
    {
        $student = Student::findorfail($id);
        return view('pages.Receipt.add',compact('student'));
    }

    public function edit($id)
    {
        $receipt_student = ReceiptStudent::findorfail($id);
        return view('pages.Receipt.edit',compact('receipt_student'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {

            // حفظ البيانات في جدول سندات القبض
            $receipt_students = ReceiptStudent::create([
                'date'=>date('Y-m-d'),
                'student_id'=>$request->student_id ,
                'debit'=>$request->Debit ,
                'description'=>$request->description ,
            ]);


            FundAccount::create([
                'date'=>date('Y-m-d'),
                'receipt_id'=>$receipt_students->id,
                'debit'=>$request->Debit,
                'credit'=>0.00,
                'description'=>$request->description,

            ]);
            StudentAccount::create([
                'date' => date('Y-m-d'),
                'type' => 'receipt',
                'receipt_id' => $receipt_students->id,
                'student_id' =>  $request->student_id,
                'debit' =>0.00,
                'credit' => $request->Debit,
                'description' => $request->description,
            ]);


            DB::commit();
            return redirect()->route('dashboard.receipt_students.index');

        }

        catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update(Request $request)
    {
        DB::beginTransaction();

        try {
            $receipt_students = ReceiptStudent::findorfail($request->id);
            $receipt_students->update([
                'date'=>date('Y-m-d'),
                'student_id'=>$request->student_id ,
                'debit'=>$request->Debit ,
                'description'=>$request->description ,
            ]);

            // تعديل البيانات في جدول الصندوق
            $fund_accounts = FundAccount::where('receipt_id',$request->id)->first();
            $fund_accounts->update([
                'date'=>date('Y-m-d'),
                'receipt_id'=>$receipt_students->id,
                'debit'=>$request->Debit,
                'credit'=>0.00,
                'description'=>$request->description,

            ]);


            // تعديل البيانات في جدول الصندوق

            $students_accounts = StudentAccount::where('receipt_id',$request->id)->first();
            $students_accounts->update([
                'date'=>date('Y-m-d'),
                'credit' => $request->Debit,
                'description' => $request->description,
            ]);


            DB::commit();
            return redirect()->route('dashboard.receipt_students.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy(Request $request)
    {
        try {
            ReceiptStudent::destroy($request->id);
            return redirect()->back();
        }

        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
