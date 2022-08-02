<?php

namespace App\Http\Controllers;

use App\Events\LabCreate;
use App\Models\ManagerLab;
use App\Models\LabSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManagerLabController extends Controller
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
    public function index()
    {
        if (Auth::user()->type === 'M' && Auth::user()->status === '1') {
            $id = Auth::user()->manager->id;
            $labs = LabSchedule::where('MID', $id)->orderBy('status')->get();
            return view('manager.index', compact('labs'));
        } else {
            return view('notLogIn');
        }
    }
    public function dashboardHome($id)
    {
        $lab = LabSchedule::find($id);

        // dd($lab);
        return view('manager.dash', ['lab' => $lab]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('lab.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ManagerLab  $managerLab
     * @return \Illuminate\Http\Response
     */
    public function show(ManagerLab $managerLab)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ManagerLab  $managerLab
     * @return \Illuminate\Http\Response
     */
    public function edit(LabSchedule $managerLab, Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'min:4', 'max:255'],
            'address' => ['required'],
        ]);
        if (isset($request->file)) {
            $file  = $data['file'];
            $nameFile = time() . '.' . $file->getClientOriginalExtension();
            $dest = public_path('doc');
            $file->move($dest, $nameFile);
        } else {
            $nameFile = $managerLab->Ldocument;
        }




        $managerLab->LName = $data['name'];
        $managerLab->LLocation = $data['address'];
        $managerLab->Ldocument = $nameFile;
        $managerLab->LPhone = $request->phone;
        $managerLab->status = 0;
        $managerLab->message = null;
        $managerLab->update();
        // $lab2 = LabSchedule::find($lab->LID);
        $labNotification = [
            'LID' => $managerLab->LID,
            'LName' => $managerLab->LName,
            'LLocation' => $managerLab->LLocation,
            'Ldocument' => $nameFile,
        ];

        event(new LabCreate($labNotification));
        // dd($lab);
      return redirect()->back()->with('message', 'تم اعادة الطلب بنجاح');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ManagerLab  $managerLab
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ManagerLab $managerLab)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ManagerLab  $managerLab
     * @return \Illuminate\Http\Response
     */
    public function destroy(LabSchedule $managerLab)
    {


        // dd($managerLab);
        $managerLab->delete();
        return redirect()->back()->with('message', 'تم حذف المختبر بنجاح');
    }
}
