<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ManagerLab;
use App\Models\LabSchedule;
use Illuminate\Http\Request;
use App\Models\TechnicianLab;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class TechnicianLabController extends Controller
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
    public function     index()
    {
        ///HANNEN
        //

        $id = Auth::user()->technician->id;
        $labs = TechnicianLab::find($id)->labs;
        return view('tech.index', compact('labs'));
        //$id = Auth::user()->manager->id;
        //$id=Auth::user()->technician->id;
        // $manager=DB::table('technician_labs')->select('MID')->where('id','=',$id);
        // dd($manager);
        // $labs = LabSchedule::where('MID', 2)->get();
        // return view('tech.index', compact('labs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id, $lid)
    {
        return view('tech.create', compact('id', 'lid'));
    }
    ///hannen
    public function addtech($id, $lid)
    {
        $lab = LabSchedule::find($lid);
        // dd($lab);
        $manager = $lab->ManagerLab->id;
        $techs = $lab->technicians;
        // $nottech = DB::select('select * from technician_labs where create_by not in ( select technician_lab_id from lab_schedule_technician_lab where lab_schedule_LID = '.$lid.' and technician_lab_id = '.$id.');');
        // $nottech = DB::table('technician_labs')->where('create_by', '!=', $lid)->get();
        $nottech = TechnicianLab::whereDoesntHave('labs', function ($q) use ($lid, $manager) {
            $q->where('lab_schedule_LID', $lid);
        })->where('MID', $manager)->get();

        return view('tech.show', compact('techs', 'lid', 'nottech'));
    }

    ////////hannen
    public function addtechlab($id, $lid)
    {
        $lab = LabSchedule::find($lid);
        // $tech = TechnicianLab::find($id);
        // $tech->labs()->attach($lid);
        // $lab= LabSchedule::find($lid);
        $lab->technicians()->attach($id);
        return redirect()->back()->with('message', 'تم العملية بنجاح ');
    }

    /////hannen
    public function deleteTechLab($id, $lid)
    {
        // $tech = TechnicianLab::find($id);
        // $tech->labs()->detach($lid);
        $lab = LabSchedule::find($lid);
        $lab->technicians()->detach($id);
        return redirect()->back()->with('message', 'تم العملية بنجاح ');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // hannen
    public function store(Request $request, $lid)
    {
        $data = $request->validate([
            'UserName' => ['required', 'string', 'min:4', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string' , 'confirmed', 'min:8'],
            'phone' => ['required'],
            'address' => ['required'],
            'lab' => ['required'],
        ]);

        $user = new User;
        // $user->UserName = $request->UserName;
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->status = 1;
        $user->type = 'T';
        $user->save();
        $labId = $lid;
        $lab = LabSchedule::find($labId);
        $tech = new TechnicianLab;
        $tech->ACNO = $user->id;
        $tech->create_by = $labId;
        $tech->MID = Auth::user()->manager->id;
        $tech->TPhone = $data['phone'];
        $tech->TAddress = $data['address'];
        $tech->TName = $data['UserName'];
        $tech->save();
        $lab->technicians()->attach($tech);
        return redirect()->back()->with('message', 'تم انشاء حساب الفني بنجاح');
    }


    public function dashboardHome($id)
    {
        $tid = Auth::user()->technician->id;
        $lab = LabSchedule::find($id);
        $lid = $id;

        return view('tech.dash', ['lab' => $lab, 'lid' => $lid]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TechnicianLab  $technicianLab
     * @return \Illuminate\Http\Response
     */
    public function show(TechnicianLab $technicianLab)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TechnicianLab  $technicianLab
     * @return \Illuminate\Http\Response
     */
    public function edit(TechnicianLab $technicianLab)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TechnicianLab  $technicianLab
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TechnicianLab $technicianLab)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TechnicianLab  $technicianLab
     * @return \Illuminate\Http\Response
     */
    public function destroy(TechnicianLab $technicianLab)
    {
        //
    }
}
