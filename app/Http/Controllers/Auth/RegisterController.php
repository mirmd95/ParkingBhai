<?php

namespace App\Http\Controllers\Auth;
use Auth;
use App\User;
use App\Owner_information;
use App\Driver_information;
use App\Space_information;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

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
    protected $redirectTo = '/home';

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
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    //Owner Registration 
    protected function register(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'max:255'],
            'area' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'car' => ['required', 'string', 'max:255'],
            'bike' => ['required', 'string', 'max:255'],
            'parking_type' => ['required', 'string', 'max:255'],
            'service_type' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        $u = new User;
        $u->username = $request->username; 
        $u->email = $request->email;  
        $u->role = 1;  
        $u->password = Hash::make($request->password);  
        $u->save();
        
        $inf = new Owner_information;
        $inf->user_id =$u->id;
        $inf->name = $request->name;
        $inf->phone_number = $request->phone_number;
        $inf->area = $request->area;
        $inf->address = $request->address;  
        $inf->parking_type = $request->parking_type;  
        $inf->service_type = $request->service_type;
        $inf->save();

        $inf = new Space_information;
        $inf->owner_id = $u->id;
        $inf->usedcar =0;
        $inf->usedbike =0;
        $inf->car = $request->car;
        $inf->freecar = $request->car;
        $inf->bike = $request->bike;
        $inf->freebike = $request->bike;
        $inf->save();
        Auth::login($u, true);
        return redirect('/gmaps');
        

    }



    public function driver_reg_form()
    {
        return view('auth.register_driver');
    }

    protected function driver_reg(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'vehicle' => ['required', 'string', 'max:255'],
            'license_no' => ['required', 'string', 'max:255'],
            'insurance_no' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        $u = new User;
        $u->username = $request->username; 
        $u->email = $request->email;  
        $u->role = 2;  
        $u->password = Hash::make($request->password);  
        $u->save();
        
        $inf = new Driver_information;
        $inf->user_id =$u->id;
        $inf->name = $request->name;
        $inf->phone_number = $request->phone_number;
        $inf->address = $request->address;
        $inf->vehicle = $request->vehicle;
        $inf->license_no = $request->license_no;
        $inf->insurance_no= $request->insurance_no;
        $inf->save();
        return redirect('/home');

    }


}
