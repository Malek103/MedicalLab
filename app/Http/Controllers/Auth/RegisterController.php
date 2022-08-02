<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\ManagerLab;
use App\Models\TechnicianLab;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration data.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'UserName' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['required']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = new User;
        // $user->UserName = $data['UserName'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->status = 1;
        $user->type = 'M';
        $manager = new ManagerLab;
        $manager->MPhone = $data['phone'];
        $manager->MName = $data['UserName'];
        // if ($data['theFile']) {
        //     $file = $data['theFile'];
        // } else {
        //     $file = '';
        // }

        // $name = time() . '.' . $file->getClientOriginalExtension();
        // $dest = public_path('doc');
        // $file->move($dest, $name);
        // $manager->file_path = $name;
        // $manager->message = $data['message'];

        $user->save();
        $user->manager()->save($manager);

        return $user;
    }
    public function createtechn(array $data)
    {
        $user = new User;
        $user->UserName = $data['UserName'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->status = 0;
        $user->type = $data['type'];
        $user->save();
        if ($user->type == 'M') {

            $manager = new ManagerLab;
            $manager->MPhone = $data['phone'];
            $manager->MAddress = $data['address'];
            $file = $data['theFile'];
            $name = time() . '.' . $file->getClientOriginalExtension();
            $dest = public_path('doc');
            $file->move($dest, $name);
            $manager->file_path = $name;
            $user->manager()->save($manager);
        }
    }
}
