<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\BuyerCreated;
use App\Models\Admin;
use App\Models\Region;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{

    public function __construct()
    {
      $this->middleware('auth:admin');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.users.index');
    }

    public function test()
    {
        $users = User::role('buyer')->get();
        return $users;
    }

    /**
     * Get Users DataTable
     *
     * @return \Illuminate\Http\Response
     */

    public function getUsers()
    {
        $users = User::role('buyer')->get();
        return Datatables::of($users)
            ->addColumn('action', function ($users) {
                return '<div class="dropdown dropdown-inline">
								<a href="" class="btn btn-sm btn-clean btn-icon" data-toggle="dropdown">
	                                <i class="la la-cog"></i>
	                            </a>
							  	<div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
									<ul class="nav nav-hoverable flex-column">
							    		<li class="nav-item"><a class="nav-link" href="'.route('admin.app-users.show',Crypt::encrypt($users->id)).'"><i class="nav-icon la la-user"></i><span class="nav-text">View User Details</span></a></li>
							    		<li class="nav-item"><a class="nav-link" href="'.route('admin.app-users.edit',Crypt::encrypt($users->id)).'"><i class="nav-icon la la-edit"></i><span class="nav-text">Edit Details</span></a></li>
							    		<li class="btn btn-light font-size-sm mr-5"data-toggle="modal"data-target="#smallModal" id="smallButton"><i class="nav-icon la la-sync-alt"></i><span class="nav-text">Update Status</span></li>
							    	</ul>
							  	</div>
							</div>

						';
            })
            ->make(true);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $regions = Region::all();
        return view('admin.users.create', compact('regions'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' =>  'required|regex:/^[a-zA-Z]+$/u|min:4|max:12',
            'last_name' =>  'required|regex:/^[a-zA-Z]+$/u|min:4|max:12',
            'email' => 'required|email|unique:users',
            'phone_number' => 'required|unique:users',
            'password' => 'required',
            'region_id' => 'required',
        ]);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput()->with('error', $validator->errors()->first());
        }
        $input = $request->only(
            'first_name', 'last_name', 'email', 'password', 'phone_number'
        );
        $password = $request->password;
        $input['password'] = Hash::make($input['password']);
        $check_phone_number = User::where('phone_number', '=', '254'.substr($input['phone_number'], -9))->exists();
        if ($check_phone_number){
            return Redirect::back()->withInput()->with('error', 'Phone Number already exists');
        }
        // remove non digits including spaces, - and +
        try {

            $user = User::create([
                'first_name' => $input['first_name'],
                'last_name' => $input['last_name'],
                'email' => $input['email'],
                'phone_number' => '254'.substr($input['phone_number'], -9),
                'password' => $input['password'],
                'status' => true,
                'passcode' => mt_rand(1000,9999)
            ]);
            $region = DB::table('region_users')->insert([
                'region_id' => $request->region_id,
                'user_id' => $user->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
            $user->assignRole('buyer');

            $details = [
                'name'=>$user->first_name.' '.$user->last_name,
                'email'=>$user->email,
                'password'=>$password
            ];
           Mail::send(new BuyerCreated($details));

            return Redirect::route('admin.app-users.index')->with('message','Buyer created Successfully');

        } catch (\Exception $exception) {
            return Redirect::route('admin.app-users.create')->with('error', 'Something went wrong');
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        try {
            $id = Crypt::decrypt($id);
            $user = User::findOrFail($id);
            return view('admin.users.show',compact('user'));
        } catch (ModelNotFoundException $e) {
            return $e;
        }

    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        try {
            $id = Crypt::decrypt($id);
            $user = User::findOrFail($id);
            return view('admin.users.edit',compact('user'));
        } catch (ModelNotFoundException $e) {
            return $e;
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('error', 'User Not Found');
        }

        try {
            $user = User::findOrFail($id);
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->save();

            return redirect()->route('admin.app-users.index')->with('message', 'User Updated successfully');
        }
        catch (ModelNotFoundException $e) {
            return back()->with('error', 'User Not Found');
        }
    }

    public function statusUpdate(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->with('error', 'User Not Found');
        }

        try {
            $user = User::findOrFail($id);
            $user->status = $request->status;
            $user->save();
            return redirect()->route('admin.app-users.index')->with('message', 'User Status Updated successfully');
        }
        catch (ModelNotFoundException $e) {
            return back()->with('error', 'Error Try Again...');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
