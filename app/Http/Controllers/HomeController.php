<?php

namespace App\Http\Controllers;
Use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
//use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\User;
use App\Application;
use App\Space_information;
use App\Calculated_cost;
use App\Location;
use Auth;
use DB;
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
        
        $id= Auth::user()->id;
        if(User::where('id', $id)->where('role',1)->count()==1)
          return view('ownerHome');
        else
          return view('driverHome');
    }

    public function search(Request $request)
    {
        $this->validate($request, [
            'area' => ['required', 'string', 'max:255'],
            'behicle' => ['required', 'string', 'max:255']
            
        ]);

        $area = $request->area; 
        $behicle = $request->behicle; 
        if($behicle=='Car')
        {
          $id=Auth::user()->id;
          $tasks1 = Application::all()->where('driver_id',$id)->where('behicle_type','Car')->where('status',0)->count();
          $tasks = DB::table('users')
                        ->join('owner_informations','users.id','=','owner_informations.user_id')
                        ->join('space_informations','users.id','=','space_informations.owner_id')
                        ->join('locations','users.id','=','locations.user_id')
                        ->where('users.role',1 )
                        ->where('owner_informations.area','=',$area)
                        ->where('freecar','>',0)
                        ->get();
                        //return $tasks;
          return view('driverHomeResult', compact('tasks','tasks1')+['behicle'=>$behicle]);
        }
        else
        {
          $id=Auth::user()->id;
          $tasks1 = Application::all()->where('driver_id',$id)->where('behicle_type','Bike')->where('status',0)->count();
          $tasks = DB::table('users')
                        ->join('owner_informations','users.id','=','owner_informations.user_id')
                        ->join('space_informations','users.id','=','space_informations.owner_id')
                        ->join('locations','users.id','=','locations.user_id')
                        ->where('users.role',1 )
                        ->where('owner_informations.area','=',$area)
                        ->where('freebike','>',0)
                        ->get();
          return view('driverHomeResult',compact('tasks','tasks1')+['behicle'=>$behicle] );
        }   
    }

    public function send_request($id,$id1)
    {
      $a = $id;
      $b = $id1;
      $id=Auth::user()->id;
      $tasks = new Application;
      $tasks->driver_id = $id;
      $tasks->owner_id = $a;
      $tasks->status = 0;
      $tasks->behicle_type = $b;
      $tasks->save();
      return redirect('/home')->with('message','Your Parking Request send Sucessfully');
    }

     public function request_accept($id)
    {
        date_default_timezone_set('Asia/Dhaka');
        $task=Application::find($id);
        $task->status=1;
        $task->save();
        $oid = Auth::user()->id;
        $stime = Carbon::now(); 
        $diff = $stime->diffInHours($stime);
         // return $diff;
        // $t = Space_information::all()->where('owner_id',$id)->increment('usedcar')->decrement('freecar');
        $count = Application::all()->where('id',$id)->where('behicle_type','Car')->count();
        if($count==1)
        {
          $t = DB::table('space_informations')
                  ->where('owner_id',$oid)
                  ->increment('usedcar');
          $t = DB::table('space_informations')
                  ->where('owner_id',$oid)
                  ->decrement('freecar');
        }
        else
        {
          $t = DB::table('space_informations')
                  ->where('owner_id',$oid)
                  ->increment('usedbike');
          $t = DB::table('space_informations')
                  ->where('owner_id',$oid)
                  ->decrement('freebike');
        }
        
        $t = new Calculated_cost;
        $t->app_id = $id;
        $t->start_time = $stime;
        $t->end_time = $stime;
        $t->hour = $diff;
        $t->cost = $diff*50;
        $t->status = 0;
        $t->save();

        return redirect('/notifications')->with('message','Request is  Sucessfully Accepted !!!!!!');
    }

    public function request_reject($id)
    {
        $task=Application::find($id);
        $task->status=4;
        $task->save();
        return redirect('/notifications')->with('message','Request is  Sucessfully Reject !!!!!!');
    }

    public function send_request_cancel($id)
    {
      
        $task=Application::find($id);
        $task->status=3;
        $task->save();
        return redirect('/home')->with('message','Your Request is  Sucessfully Cancel !!!!!!');
    }

    public function park_finish($id ,$id1,$time)
    {
        $oid =Auth::user()->id;
        date_default_timezone_set('Asia/Dhaka');
        $stime = Carbon::now(); 
        $tm = $time;
        $start = Carbon::parse($stime);
        $end = Carbon::parse($tm);
        $diff = $end->diffInMinutes($start);
        $a= date('H:i', mktime(0,$diff));
        $diff=$diff-15;
        $count = Application::all()->where('id',$id)->where('behicle_type','Car')->count();

        $task=Application::find($id);
        $task->status=2;
        $task->save();
        if($diff<0)
        {
          $diff =$diff+15;
        }
        $t = Calculated_cost::find($id1);
        $t->end_time = $stime;
        $t->hour = $a;
        if($count==1)
        {
          $t->cost = $diff*.85;
        }
        else
        {
          $t->cost = $diff*.6;
        }
        $t->save();

        if($count==1)
        {

          $t = DB::table('space_informations')
                    ->where('owner_id',$oid)
                    ->increment('freecar');
          $t = DB::table('space_informations')
                    ->where('owner_id',$oid)
                    ->decrement('usedcar');
        }
        else
        {

          $t = DB::table('space_informations')
                    ->where('owner_id',$oid)
                    ->increment('freebike');
          $t = DB::table('space_informations')
                    ->where('owner_id',$oid)
                    ->decrement('usedbike');
        }


        return redirect('/activePark')->with('message','Your Park is  Sucessfully Finish !!!!!!');
    }

    public function about()
    {
      $role=Auth::user()->role;
      if($role==1)
        return view('ownerAbout');
      else
        return view('driverAbout');
    }

    public function owner_notification()
    {
       
      $id = Auth::user()->id;
      // $tasks = Application::all()->where('owner_id',$id)->where('status',0);
      $tasks = DB::table('applications')
                  ->join('users','applications.driver_id','=','users.id')
                  ->join('driver_informations','applications.driver_id','=','driver_informations.user_id')
                  ->where('applications.owner_id',$id )
                  ->where('applications.status',0 )
                  ->select('applications.*','driver_informations.name','driver_informations.phone_number','driver_informations.insurance_no','driver_informations.address','driver_informations.license_no')
                  ->orderby('applications.created_at', 'desc')                  
                  ->get();
                  // return $tasks;
      return view('ownerNotification',compact('tasks'));
    }

    public function active_park()
    {
       
      $id = Auth::user()->id;
      // $tasks = Application::all()->where('owner_id',$id)->where('status',0);
      $tasks = DB::table('applications')
                  ->join('driver_informations','applications.driver_id','=','driver_informations.user_id')
                  ->join('calculated_costs','applications.id','=','calculated_costs.app_id')
                  ->where('applications.owner_id',$id )
                  ->where('applications.status',1 )
                  ->select('applications.*','driver_informations.name','driver_informations.phone_number','driver_informations.insurance_no','driver_informations.address','driver_informations.license_no','calculated_costs.id as cid','calculated_costs.start_time')                
                  ->get();
                   // return $tasks;
      return view('activePark',compact('tasks'));
    }


    public function driver_notification()
    {
      $id = Auth::user()->id;
      // $tasks = Application::all()->where('owner_id',$id)->where('status',0);
      $tasks = DB::table('applications')
                  ->join('users','applications.owner_id','=','users.id')
                  ->join('owner_informations','applications.owner_id','=','owner_informations.user_id')
                  ->where('applications.driver_id',$id )
                  ->where('applications.status',1)
                  ->select('applications.*','owner_informations.name','owner_informations.phone_number','owner_informations.address')
                  ->orderby('applications.created_at', 'desc')
                  ->get();
                  // return $tasks;
      return view('driverNotification',compact('tasks') );
    }

    public function owner_record()
    {
      $limit=10;
       $count = request()->input('page', 1) * $limit - $limit + 1;
      $id = Auth::user()->id;
      // $tasks = Application::all()->where('owner_id',$id)->where('status',0);
      $tasks = DB::table('applications')
                  ->join('driver_informations','applications.driver_id','=','driver_informations.user_id')
                  ->join('calculated_costs','applications.id','=','calculated_costs.app_id')
                  ->where('applications.owner_id',$id )
                  ->where('applications.status',2 )
                  ->orderby('applications.created_at', 'desc')
                  ->paginate($limit);
                  // return $tasks;
      return view('ownerRecord',compact('tasks') + ['count' => $count ]);
    }
    public function pendingRequest()
    {
      $id = Auth::user()->id;
      // $tasks = Application::all()->where('owner_id',$id)->where('status',0);
      $tasks = DB::table('applications')
                  // ->join('users','applications.owner_id','=','users.id')
                  ->join('owner_informations','applications.owner_id','=','owner_informations.user_id')
                  ->where('applications.driver_id',$id )
                  ->where('applications.status',0 )
                  ->orderby('applications.created_at', 'desc')
                  ->select('applications.*','owner_informations.name','owner_informations.phone_number','owner_informations.Area','owner_informations.address')
                  ->get();
                  // return $tasks;
      return view('pendingRequest',compact('tasks'));
    }

    public function driver_record()
    {
      $limit=10;
       $count = request()->input('page', 1) * $limit - $limit + 1;
      $id = Auth::user()->id;
      // $tasks = Application::all()->where('owner_id',$id)->where('status',0);
      $tasks = DB::table('applications')
                  ->join('owner_informations','applications.owner_id','=','owner_informations.user_id')
                  ->join('calculated_costs','applications.id','=','calculated_costs.app_id')
                  ->where('applications.driver_id',$id )
                  ->where('applications.status',2)
                  ->orderby('applications.created_at', 'desc')
                  ->paginate($limit);
                   // return $tasks;
      return view('driverRecord',compact('tasks') + ['count' => $count ]);
    }

    


    public function gmaps()

    {
        if(Location::where('user_id', Auth::id())->exists()){
        // return redirect('/ownerHome')->with('message','Your Location is here!!!!!!');
        return view('ownerHome');
        }
        else
        return view('gmaps');

    }
}
