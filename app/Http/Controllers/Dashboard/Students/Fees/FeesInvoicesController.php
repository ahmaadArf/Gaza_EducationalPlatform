<?php

namespace App\Http\Controllers\Dashboard\Students\Fees;

use App\Models\Fee;
use App\Models\Grade;
use App\Models\Student;
use App\Models\Fee_invoice;
use Illuminate\Http\Request;
use App\Models\StudentAccount;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class FeesInvoicesController extends Controller
{
    public function index()
    {
        $Fee_invoices = Fee_invoice::all();
        $Grades = Grade::all();
        return view('pages.Fees_Invoices.index',compact('Fee_invoices','Grades'));
    }

    public function show($id)
    {
        $student = Student::findorfail($id);
        $fees = Fee::where('classroom_id',$student->classroom_id)->get();
        return view('pages.Fees_Invoices.add',compact('student','fees'));
    }



    public function store(Request $request)
    {
        $List_Fees = $request->List_Fees;

        DB::beginTransaction();

        try {

            foreach ($List_Fees as $List_Fee) {

                $Fees =  Fee_invoice::create([
                    'invoice_date' => date('Y-m-d'),
                    'student_id' => $List_Fee['student_id'],
                    'grade_id' => $request->Grade_id,
                    'classroom_id' => $request->Classroom_id,
                    'fee_id' => $List_Fee['fee_id'],
                    'amount' => $List_Fee['amount'],
                    'description' => $List_Fee['description'],
                ]);

                StudentAccount::create([
                    'date' => date('Y-m-d'),
                    'type' => 'invoice',
                    'fee_invoice_id' => $Fees->id,
                    'student_id' => $List_Fee['student_id'],
                    'debit' => $List_Fee['amount'],
                    'credit' => 0.00,
                    'description' => $List_Fee['description'],
                ]);

            }
            DB::commit();

            return redirect()->route('dashboard.fees_Invoices.index')->
            with('msg', trans('messages.success'))->with('type', 'success');;
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function edit($id)
    {
        $fee_invoices = Fee_invoice::findorfail($id);
        $fees = Fee::where('classroom_id',$fee_invoices->classroom_id)->get();
        return view('pages.Fees_Invoices.edit',compact('fee_invoices','fees'));
    }

    public function update($id,Request $request)
    {
        DB::beginTransaction();
        try {
            $Fees = Fee_invoice::findorfail($id);
            $Fees->update([
                'fee_id' => $request->fee_id,
                'amount' => $request->amount,
                'description' => $request->description,
            ]);


            $StudentAccount = StudentAccount::where('fee_invoice_id',$id)->first();
            $StudentAccount->update([
                'debit' => $request->amount,
                'description' => $request->description,
            ]);

            DB::commit();

            return redirect()->route('dashboard.fees_Invoices.index')->
            with('msg', trans('messages.Update'))->with('type', 'success');;
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            Fee_invoice::destroy($id);
            return redirect()->back()->
            with('msg', trans('messages.Delete'))->with('type', 'danger');;
        }
        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
