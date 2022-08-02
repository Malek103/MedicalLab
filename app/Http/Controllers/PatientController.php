<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Patient;
use App\Models\PatientExamination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PatientController extends Controller
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
    // hannen
    public function index()
    {

        $user = Patient::where('ACNO', Auth::user()->id)->first();
        $patient_examinations = PatientExamination::where('PNO', $user->id)->get();

        return view('patient.dash', compact('patient_examinations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // hannen
    public function create($lid)
    {
        //

        // return view('components.patient.create');
        return view('patient.create', compact('lid'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $lid)
    {

        $validated = $request->validate([
            'UserName' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'min:8', 'confirmed'],
            'phone' => ['numeric|min:2|max:10'],
            'address' => ['required',  'string'],
            'phone' => ['required', ' numeric', 'min:10'],
            'PID' => [' numeric', 'required', 'unique:patients'],
        ]);


        $user = new User;
        //$user->UserName = $request->UserName;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->status = 1;
        $user->type = 'P';
        $user->save();

        $patient = new Patient;
        $patient->PID = $request->PID;
        $patient->PName = $request->UserName;
        $patient->PPhone = $request->phone;
        $patient->PAddress = $request->address;
        $patient->PDofB = $request->birth_date;
        $patient->PGender = $request->gender;
        $patient->lab_id = $lid;
        $user->patient()->save($patient);
        return redirect()->back()->with('message', 'تم انشاء حساب مريض بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */

    //  hannen

    public function searchpatient(Request $request, $lid)
    {


        $search = $request->input('search');
        // Search in the title and body columns from the posts table
        $patients = Patient::query()
            ->where('PName', 'LIKE', "%{$search}%")
            ->orwhere('PID', 'LIKE', "%{$search}%")
            ->get();

        // Return the search view with the resluts compacted
        return view('patient.showall', compact('patients', 'lid'));
    }
    public function show($lid)
    {
        $patients = Patient::get();
        return view('patient.showall', compact('patients', 'lid'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    // hannen
    public function edit(Patient $patient, $id, $lid)
    {
        //
        $patient = Patient::get()->find($id);
        return view('patient.edit', compact('patient', 'lid'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    // hannen
    public function update(Request $request, Patient $patient, $id)
    {

        $patient = Patient::find($id);
        // return $patient;
        $patient->update($request->all());
        return redirect()->back()->with('message', 'تم تعديل المريض بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patient $patient)
    {
        //
    }

    public function showpatientexamination($id, $lid)
    {
        $examination = PatientExamination::where('PNO', $id)->get();
        return view('patient.examination', compact('examination', 'lid'));
    }
}
