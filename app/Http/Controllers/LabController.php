<?php

namespace App\Http\Controllers;

use App\Events\LabCreate;
use App\Models\LabSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\NewLabNotification;
use App\Listeners\SendCreateNewLabNotificattion;

class LabController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        // dd($request->phone);
        $data = $request->validate([
            'file' => ['required'],
            'name' => ['required', 'min:4', 'max:255'],
            'address' => ['required'],
        ]);

        // if ($data['file']) {

        //     $file = $data['file'];
        // } else {
        //     $file = '';
        // }
        $lab = new LabSchedule();
        $file  = $data['file'];
        $nameFile = time() . '.' . $file->getClientOriginalExtension();
        $dest = public_path('doc');
        $file->move($dest, $nameFile);


        $lab->LName = $data['name'];
        $lab->LLocation = $data['address'];
        $lab->Ldocument = $nameFile;
        $lab->MID = Auth::user()->manager->id;
        $lab->LPhone = $request->phone;
        $lab->save();
        // $lab2 = LabSchedule::find($lab->LID);
        $labNotification = [
            'LID' => $lab->LID ,
            'LName' => $lab->LName,
            'LLocation' => $lab->LLocation,
            'Ldocument' => $nameFile,
        ];
        // dd( $labNotification);


            // dd($labNotification);
        event(new LabCreate($labNotification));
        // $lab->message = $data['message'];

        // $labs = LabSchedule::where('MID', $id)->get();
        // return view('manager.index',);
        return redirect()->back()->with('message', ' تم انشاء المختبر بنجاح');
        dd($request->name, $request->address, $request->file);
    }
}
