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
use Auth;
use DB;


// namespace App\Http\Controllers;
// use Auth;
// use Illuminate\Http\Request;
use App\Location;
class MapController extends Controller
{
    
    public function save()
    {
    	
    	if(Location::where('user_id', Auth::id())->exists()){
        // return redirect('/ownerHome')->with('message','Your Location is here!!!!!!');
        return view('ownerHome');
        }
    	$t = new Location;
    	$t->lat = request()->lat;
    	$t->lng = request()->long;
    	$t->user_id = Auth::id();
    	$t->save();
    	return redirect('/ownerHome')->with('message','You  Sucessfully Add your Location!!!!!!');
    	// return Redirect::back()->with('message','Operation Successful !');
    }

    public function show_location($id,$id1,$id2)
    {
    	$tasks = DB::table('users')
    			->join('owner_informations','users.id','=','owner_informations.user_id')
    			->where('users.id',$id)
    			->get();
    	//return $tasks;
   		 return view('showOwner',compact('tasks') + ['id1' => $id1 ,'id2'=>$id2]);

    }
}
