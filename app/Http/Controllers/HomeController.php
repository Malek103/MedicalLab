<?php

namespace App\Http\Controllers;

use App\Models\User;

use App\Models\ManagerLab;

use App\Models\LabSchedule;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $users = User::all();

        return view('home', compact('users'));

        //return $users;
        // return view('receivable.index', compact('receivables'));
        // return view('dashboard');
    }
    public function showall()
    {
        $mangerusers = ManagerLab::all();
        return view('AdminUser.showall', compact('mangerusers'));
    }
    public function search(Request $request)
    {
        // dd($request->input('search'));

        $search = $request['search'];

        $valid = $request['valid'];

        if ($search) {
            switch ($valid) {
                case 'valid':
                    $ManagerLabs = User::where('status', '=', 1)
                        ->where(function ($query) use ($search) {
                            $query->where('email', 'LIKE', "%{$search}%")
                                ->orWhereHas('manager', function ($query) use ($search) {
                                    $query->where('MName', 'LIKE', "%{$search}%");
                                    //  ->orWhere('email', 'LIKE', "%{$search}%");
                                });
                        })->get();
                    break;
                case 'unvalid':
                    $ManagerLabs = User::where('status', '=', 0)
                        ->where(function ($query) use ($search) {
                            $query->where('email', 'LIKE', "%{$search}%")
                                ->orWhereHas('manager', function ($query) use ($search) {
                                    $query->where('MName', 'LIKE', "%{$search}%");
                                    //  ->orWhere('email', 'LIKE', "%{$search}%");
                                });
                        })->get();
                    break;
                default:
                    $ManagerLabs = User::query()
                        ->where(function ($query) use ($search) {
                            $query->where('email', 'LIKE', "%{$search}%")
                                ->orWhereHas('manager', function ($query) use ($search) {
                                    $query->where('MName', 'LIKE', "%{$search}%");
                                    //  ->orWhere('email', 'LIKE', "%{$search}%");
                                });
                        })->get();
            }
        } else {
            switch ($valid) {
                case 'valid':
                    $ManagerLabs = User::where('status', 1)->get();

                    break;
                case 'unvalid':
                    $ManagerLabs = User::where('status', 0)->get();

                    break;
                default:
                    $ManagerLabs = User::get();
            }
        }

        $all = ['ManagerLabs' => $ManagerLabs, 'search' => $search, 'valid' => $valid];
        $notifications = $user = User::where('type', 'A')->first()->notifications;
        //return $ManagerLabs;
        // dd($valid, $search);
        return view('components.sharchmanager', compact('ManagerLabs', 'notifications'));
    }
    public function getaccount($id)
    {
        $users = User::find($id);
        $managers = $users->manager;
        return view('AdminUser.showmanager', compact('users', 'managers'));
    }
    public function unactive(User $user)
    {

        $user = User::find($user->id);
        $user->update(['status' => '0']);
        return redirect('AdminUser.showmanager');
    }
    public function update($id)
    {
        $user = User::find($id);
        $user->update(['status' => '1']);

        return redirect()->back()->with('message', 'تم تفعيل حساب المستخدم');
    }
    public function updateunactive($id)
    {
        $user = User::find($id);
        $user->update(['status' => '0']);

        return redirect()->back()->with('message', 'تم الغاء حساب المستخدم');
    }
    public function adminshow($id)
    {
        $labs = LabSchedule::where('MID', $id)->orderBy('status')->get();
        return view('AdminUser.showlab', compact('labs'));
    }
    public function ActiveLabStatus($id)
    {
        $labs = LabSchedule::find($id);
        $labs->update(['status' => '1']);
        return redirect()->back()->with('message', 'تم تفعيل حساب المختبر');
    }
    public function unActiveLabStatus($id)
    {
        $labs = LabSchedule::find($id);
        $labs->update(['status' => '0']);
        return redirect()->back()->with('message', 'تم الغاء حساب المختبر');
    }

    // safa labRefused

    public function labRefused(Request $request, LabSchedule $lab)
    {

        $lab->message = $request->messagetext;
        $lab->status = 3;
        $lab->update();
        return redirect()->back()->with('message', 'تم ارسال الرسالة بنجاح');
    }
    public function notification()
    {
        $user = User::where('type', 'A')->first();
        foreach ($user->notifications as $notification) {
            echo $notification->data['id'];
            echo '<br/>';
            echo $notification->data['name'];
            echo '<br/>';
            echo $notification->data['location'];
            echo '<br/>';
            echo $notification->data['document'];
            echo '<br/>';
            echo '<hr/>';
        }
    }

    public function labAccept($labID, $notification)
    {
        # code...

        auth()->user()->unreadNotifications->where('id', $notification)->markAsRead();
        $lab = LabSchedule::find($labID);

        $notifications = $user = User::where('type', 'A')->first()->notifications;
        // dd($notifications);
        return view('AdminUser.acceptlab', compact('lab', 'notifications'));
    }
}
