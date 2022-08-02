<?php

namespace App\Http\Controllers;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Template;
use App\Models\TestResult;
use App\Models\LabSchedule;
use Illuminate\Http\Request;
use App\Models\TechnicianLab;
use App\Models\Template_Item;
use App\Models\PatientExamination;
use Illuminate\Support\Facades\Auth;
use App\Models\Receipt;
use App\Models\Payment;
class PatientExaminationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index($lid)
    {

        //
        // $patient=Patient::get();
        // return $patient;
        return view('examinations.create', compact('lid'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $lid)
    {
        // return $lid;
        $doctorName=Doctor::find($request->Doctor)->name;
        $patientName = Patient::find($request->patient)->PName;
        $template = Template::find($request->template)->TName;
        $templateItems = Template_Item::where('TTID', $request->template)->get();
        return view('examinations.createTwo')->with('header', $request->all())->with('lid', $request->lid)->with('doctorName', $doctorName)->with('patientName', $patientName)->with('template', $template)->with('templateItems', $templateItems)->with('price', $request->Price);
    }
    public function storeTwo(Request $request, $lid)
    {

        // dd($request->all());
        $tid = Auth::user()->technician->id;

        //hannen
        $data = $request->validate([
            'patient' => ['required'],
            'template' => ['required'],
            'Lab_Dep' => ['required', 'string', 'max:255'],
            'Doctor' => ['required', 'string', 'max:255'],
            'Price' => ['numeric', 'min:1'],
            'date' => ['required'],
            'time' => ['required'],
            'amount' => ['required', 'numeric'],
            // 'created_by' => ['required'],

        ]);
        // dd($request->lid, $data['lid']);
        $templateName = Template::find($data['template'])->TName;


        // $lab_id = $data['created_by'];
        // dd($data['lid']);
        // dd($lab_id);
        $patientEx = new PatientExamination;

        $patientEx->created_by = $lid;
        $patientEx->PNO = $data['patient'];
        $patientEx->MEname = $templateName;
        $patientEx->Lab_Dep = $data['Lab_Dep'];
        $patientEx->Doctor = $data['Doctor'];
        $patientEx->Price = $data['Price'];
        $patientEx->Date = $data['date'];
        $patientEx->Time = $data['time'];

        // $pateintEx->created_by = $lab_id;
        $patientEx->TID = $tid;
        $patientEx->template_id = $data['template'];
        $patientEx->amount = $data['amount'];
        $patientEx->save();
        // dd($patientEx->all());
        foreach ($request->test as $key => $value) {
            // $tempItem = Template_Item::find($key)->Name;
            $test = new TestResult();
            $test->MEID = $patientEx->id;
            $test->template_id = $key;
            $test->result = $value;
            $test->save();
        }
        // receipt
        $patient=Patient::find($data['patient']);
        $receipt = new Receipt;
        $receipt->created_by = $lid;
        $receipt->type ='D';
        $receipt->amount = $data['amount'];
        $receipt->note =' دفعة من فجص المريض'.$patient->PName;
        $receipt->save();
        return redirect('/show-examination/'.$patientEx->id)->with('message', 'تم إنشاء الاختبار بنجاح');
        return redirect()->route('examinationCreate', [$lid])->with('message', 'تم إنشاء الاختبار بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PatientExamination  $patientExamination
     * @return \Illuminate\Http\Response
     *
     */
    public function show(PatientExamination $patientExamination, $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PatientExamination  $patientExamination
     * @return \Illuminate\Http\Response
     */
    public function edit(PatientExamination $patientExamination)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PatientExamination  $patientExamination
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PatientExamination $patientExamination)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PatientExamination  $patientExamination
     * @return \Illuminate\Http\Response
     */
    public function destroy(PatientExamination $patientExamination)
    {
        //
    }
    public function showpatientexam($id)
    {

        $examinations = PatientExamination::where('MEID', $id)->first();

        $EXid = $examinations->MEID;
        $techid = $examinations->TID;
        $patientid = $examinations->PNO;
        $templateid = $examinations->template->id;
        $lab = LabSchedule::find($examinations->created_by);

        $tech = TechnicianLab::where('id', $techid)->first();
        $templateItems = Template_Item::where('TTID', $EXid)->get();
        $patient = Patient::where('id', $patientid)->first();

        $results = TestResult::where("MEID", $id)->get();

        $name = [];
        $res = [];

        foreach ($results as  $result) {
            $temp = Template_Item::find($result['template_id']);

            array_push($res,  $result['result']);
            array_push($name,  $temp['Name']);
        }


        return view('patient.details', compact('examinations', 'templateItems', 'tech', 'patient', 'name', 'res', 'lab'));
    }
    public function showallpatientexam($lid)
    {

        $examination = PatientExamination::where('created_by', $lid)->get();

        // $patient = Patient::where('id', 4)->get();

        return view('examinations.show', compact('examination', 'lid'));
    }
    public function searchexam(Request $request, $lid)
    {
        $search = $request->input('search');
        $examination = PatientExamination::query()
            ->where('MEname', 'LIKE', "%{$search}%")
            ->orWhere('Doctor', 'LIKE', "%{$search}%")
            ->orWhere('Lab_Dep', 'LIKE', "%{$search}%")
            ->orWhere('Price', 'LIKE', "%{$search}%")
            ->get();

        return view('examinations.show', compact('examination', 'lid'));
    }
    public function comparepatientexam($id)
    {

        $examinations = PatientExamination::where('MEID', $id)->first();
        $dateEx = $examinations->Date;
        $timeEx = $examinations->Time;
        $EXid = $examinations->MEID;
        $techid = $examinations->TID;
        $patientid = $examinations->PNO;
        $templateid = $examinations->template->id;
        $lab = LabSchedule::find($examinations->created_by);
        // dd($lab);
        $tech = TechnicianLab::where('id', $techid)->first();
        $templateItems = Template_Item::where('TTID', $EXid)->get();
        $patient = Patient::where('id', $patientid)->first();
        $compareEx = PatientExamination::where('PNO', $patientid)

            ->where('template_id', $templateid)
            ->where('Date', '<=', $dateEx)

            ->where('MEID', '<>', $id)->orderBy('created_at', 'desc')->first();

        $results = TestResult::where("MEID", $id)->get();
        $results2 = TestResult::where("MEID", $compareEx->MEID)->get();
        $name = [];
        $res = [];
        $name2 = [];
        $res2 = [];
        foreach ($results as  $result) {
            $temp = Template_Item::find($result['template_id']);

            array_push($res,  $result['result']);
            array_push($name,  $temp['Name']);
        }
        foreach ($results2 as  $result) {
            $temp = Template_Item::find($result['template_id']);

            array_push($res2,  $result['result']);
            array_push($name2,  $temp['Name']);
        }

        return view('patient.printcompere', compact('examinations', 'templateItems', 'tech', 'patient', 'name', 'res', 'name2', 'res2', 'lab'));
    }

    public function AddDoctor($lid)
    {
        $doctor=Doctor::get();
        return view('examinations.doctor', compact('lid','doctor'));
    }
    public function CreateDoctor($lid)
    {
        return view('examinations.createdoctor', compact('lid'));

    }

    public function StoreDoctor(Request $request,$lid)
    {
        $lab_id=$lid;
        $data = $request->validate([
            'doctorname' => ['required', 'max:255'],
        ]);
        $doctor=new Doctor();
        $doctor->name = $data['doctorname'];
        $doctor->lab_id=$lab_id;
        $doctor->save();
        return redirect()->back()->with('message', 'تم انشاء الطبيب بنجاح');
    }
    public function Debt()
    {
       $lab=LabSchedule::get();
       return view('patient.patientlab',compact('lab'));
    }
    public function showDebt($lid)
    {

        $patient_id=Auth::user()->id;
        $patient=Patient::where('ACNO',$patient_id)->get();
        foreach ($patient as $patients)
        {
             $patients->id;
        }
         $EXamount=PatientExamination::where('PNO',$patients->id)
         ->where('created_by',$lid)
        ->sum('amount');
        $EXprice=PatientExamination::where('PNO',$patients->id)
        ->where('created_by',$lid)
       ->sum('Price');
       $payment=Payment::where('patient_id',$patients->id)
       ->where('lab_id',$lid)
       ->sum('amount');
       return view('patient.ShowDept',compact('EXamount','EXprice','payment'));
    }
}
