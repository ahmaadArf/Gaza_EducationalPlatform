<?php

namespace App\Http\Controllers\Dashboard\Students\Fees;

use App\Models\Student;
use App\Models\FundAccount;
use Illuminate\Http\Request;
use App\Models\PaymentStudent;
use App\Models\StudentAccount;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    public function index()
    {
        $payment_students = PaymentStudent::all();
        return view('pages.Payment.index',compact('payment_students'));
    }

    public function show($id)
    {
        $student = Student::findorfail($id);
        return view('pages.Payment.add',compact('student'));
    }

    public function edit($id)
    {
        $payment_student = PaymentStudent::findorfail($id);
        return view('pages.Payment.edit',compact('payment_student'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {

            $payment_students =  PaymentStudent::create([
                'student_id'=>$request->student_id ,
                'amount'=>$request->Debit ,
                'description'=>$request->description ,
            ]);

            FundAccount::create([
                'date'=>date('Y-m-d'),
                'payment_id'=>$payment_students->id,
                'debit'=>0.00,
                'credit'=>$request->Debit,
                'description'=>$request->description,

            ]);
            StudentAccount::create([
                'date' => date('Y-m-d'),
                'type' => 'payment',
                'payment_id' =>$payment_students->id,
                'student_id' => $request->student_id,
                'debit' => $request->Debit,
                'credit' => 0.00,
                'description' => $request->description,
            ]);

            DB::commit();
            return redirect()->route('dashboard.payment_students.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update(Request $request)
    {
        DB::beginTransaction();

        try {

            $payment_students = PaymentStudent::findorfail($request->id);
            $payment_students->update([
                'student_id' => $request->student_id,
                'amount' => $request->Debit,
                'description' => $request->description,
            ]);

            $fund_accounts = FundAccount::where('payment_id',$request->id)->first();
            $fund_accounts->update([
                'date'=>date('Y-m-d'),
                'payment_id'=>$payment_students->id,
                'debit'=>0.00,
                'credit'=>$request->Debit,
                'description'=>$request->description,

            ]);

            $students_accounts = StudentAccount::where('payment_id',$request->id)->first();
            $students_accounts->update([
                'date'=>date('Y-m-d'),
                'debit' => $request->Debit,
                'description' => $request->description,
            ]);

            DB::commit();
            return redirect()->route('dashboard.payment_students.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy(Request $request)
    {
        try {
            PaymentStudent::destroy($request->id);
            return redirect()->back();
        }

        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
