<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Payment;
use App\Models\Receipt;
use App\Models\ManagerLab;
use App\Models\LabSchedule;
use Illuminate\Http\Request;
use App\Models\PatientExamination;
use Illuminate\Support\Facades\DB;

class ReceiptController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function ShowReceipt($lid)
    {
        # code...
        $receipts = Receipt::where('created_by', $lid)->get();
        $Pull = Receipt::query()
            ->where('type', 'P')
            ->Where('created_by', $lid)
            ->sum('amount');
        $Deposit = Receipt::query()
            ->where('type', 'D')
            ->Where('created_by', $lid)
            ->sum('amount');
        return view('receipt.index', compact('receipts', 'lid', 'Pull', 'Deposit'));
    }
    public function CreateReceipt($lid)
    {

        return view('receipt.create', compact('lid'));
    }

    public function StoreReceipt(Request $request, $lid)
    {
        $validated = $request->validate([
            'note' => ['required',  'string'],
            'amount' => [' numeric', 'required'],
        ]);

        if ($request->type == 'P') {
            if ($request->amount > DB::table('receipts')->where('created_by', $lid)->sum('amount')){
                    return redirect()->back()->with('maxAmount', 'لا يوجد رصيد كافي')->withInput($request->all());
            }
                $amount = -1 * $request->amount;
        } else {
            $amount = $request->amount;
        }

        $receipt = new Receipt;
        $receipt->created_by = $lid;
        $receipt->type = $request->type;
        $receipt->amount = $amount;
        $receipt->note = $request->note;
        $receipt->save();
        return redirect()->back()->with('message', 'تم العملية بنجاح');
    }

    public function search(Request $request, $lid)
    {
        $search = $request['search'];

        $valid = $request['valid'];

        if ($search) {
            switch ($valid) {
                case 'deposit':
                    $receipts = Receipt::where('type', '=', 'D')
                        ->where(function ($query) use ($search) {
                            $query->where('amount', 'LIKE', "%{$search}%")
                                ->orWhere('note', 'LIKE', "%{$search}%");
                        })->get();
                    break;

                case 'pull':
                    $receipts = Receipt::where('type', '=', 'P')
                        ->where(function ($query) use ($search) {
                            $query->where('amount', 'LIKE', "%{$search}%")
                                ->orWhere('note', 'LIKE', "%{$search}%");
                        })->get();
                    break;
                default:
                    $receipts = Receipt::query()
                        ->where(function ($query) use ($search) {
                            $query->where('amount', 'LIKE', "%{$search}%")
                                ->orWhere('note', 'LIKE', "%{$search}%");
                        })->get();
            }
        } else {
            switch ($valid) {
                case 'deposit':
                    $receipts =  Receipt::where('type', '=', 'D')->get();

                    break;
                case 'pull':
                    $receipts = Receipt::where('type', '=', 'P')->get();

                    break;
                default:
                    $receipts = Receipt::get();
            }
        }

        $all = ['receipts' => $receipts, 'search' => $search, 'valid' => $valid];
        $Pull = Receipt::where('type', 'P')->sum('amount');
        $Deposit = Receipt::where('type', 'D')->sum('amount');
        return view('receipt.index', compact('receipts', 'lid', 'Pull', 'Deposit'));
    }

    public function PrintReceipt(Request $request, $lid)
    {

        $nowtime = now();

        // dd($request->all(), $lid);
        if ($request->startDate == null) {

            $request->startDate = '1980-01-01';
        }
        if ($request->endDate == null) {
            $request->endDate = $nowtime;
        }



        $lab = LabSchedule::where('LID', $lid)->first();
        $manager = ManagerLab::where('id', $lab->MID)->first();
        // $receipts = Receipt::where('created_by', $lid)->get();
        $receipts = Receipt::where('created_by', $lid)
            ->where(function ($query) use ($request) {
                $query->where('created_at', '>=',  $request->startDate)
                    ->where('created_at', '<=',  $request->endDate);
            })->get();

        $Pull = Receipt::query()
            ->where('type', 'P')
            ->Where('created_by', $lid)
            ->where(function ($query) use ($request) {
                $query->where('created_at', '>=',  $request->startDate)
                    ->where('created_at', '<=',  $request->endDate);
            })->sum('amount');
        $Deposit = Receipt::query()
            ->where('type', 'D')
            ->Where('created_by', $lid)
            ->where(function ($query) use ($request) {
                $query->where('created_at', '>=',  $request->startDate)
                    ->where('created_at', '<=',  $request->endDate);
            })->sum('amount');
        return view('receipt.print', compact('lab', 'receipts', 'manager', 'Pull', 'Deposit'));
    }

    public function receivable($lid)
    {

        # code...
        $patient = Patient::get();
        return view('receipt.receivable', compact('patient', 'lid'));
    }
    public function ShowReceivable($id, $lid)
    {


        # code...
        $examination = PatientExamination::where('PNO', $id)
            ->where('created_by', $lid)
            ->get();
        return view('receipt.receivabledetails', compact('examination', 'lid', 'id'));
    }
    public function PrintReceivable(Request $request, $lid, $id)
    {

        # code...
        $nowtime = now();
        if ($request->startDate == null) {

            $request->startDate = '1980-01-01';
        }
        if ($request->endDate == null) {
            $request->endDate = $nowtime;
        }
        $lab = LabSchedule::where('LID', $lid)->first();
        $manager = ManagerLab::where('id', $lab->MID)->first();

        $examinations = PatientExamination::where('PNO', $id)
            ->where('created_by', $lid)
            ->where(function ($query) use ($request) {
                $query->where('created_at', '>=',  $request->startDate)
                    ->where('created_at', '<=',  $request->endDate);
            })->get();
        $patient = Patient::where('id', $id)->first();
        $price = PatientExamination::query()
            ->where('PNO', $id)
            ->Where('created_by', $lid)
            ->where(function ($query) use ($request) {
                $query->where('created_at', '>=',  $request->startDate)
                    ->where('created_at', '<=',  $request->endDate);
            })->sum('Price');
        $amount = PatientExamination::query()
            ->where('PNO', $id)
            ->Where('created_by', $lid)
            ->where(function ($query) use ($request) {
                $query->where('created_at', '>=',  $request->startDate)
                    ->where('created_at', '<=',  $request->endDate);
            })->sum('amount');

        $payment = Payment::where('patient_id', $id)
            ->where('lab_id', $lid)
            ->where(function ($query) use ($request) {
                $query->where('created_at', '>=',  $request->startDate)
                    ->where('created_at', '<=',  $request->endDate);
            })->get();
        $pay = Payment::where('patient_id', $id)
            ->where('lab_id', $lid)
            ->where(function ($query) use ($request) {
                $query->where('created_at', '>=',  $request->startDate)
                    ->where('created_at', '<=',  $request->endDate);
            })->sum('amount');
        return view('receipt.receivableprint', compact('lab', 'examinations', 'manager', 'patient', 'price', 'amount', 'payment', 'pay'));
    }
    public function payReceivable($id, $lid)
    {
        # code....
        $payment = Payment::query()
            ->where('patient_id', $id)
            ->Where('lab_id', $lid)
            ->sum('amount');
        $price = PatientExamination::query()
            ->where('PNO', $id)
            ->Where('created_by', $lid)
            ->sum('Price');
        $amount = PatientExamination::query()
            ->where('PNO', $id)
            ->Where('created_by', $lid)
            ->sum('amount');



        return view('receipt.payment', compact('id', 'lid', 'price', 'amount', 'payment'));
    }
    public function paymentsave(Request $request, $id, $lid)
    {
        $patient=Patient::find($id);
        $payment = new Payment;
        $payment->patient_id = $id;
        $payment->lab_id = $lid;
        $payment->amount = $request->amount;
        $payment->save();
        $receipt = new Receipt;
        $receipt->created_by = $lid;
        $receipt->type ='D';
        $receipt->amount = $request->amount;
        $receipt->note ='دفعة من المريض '.$patient->PName;
        $receipt->save();
        return redirect()->back()->with('message', 'تم العملية بنجاح');
    }


}
