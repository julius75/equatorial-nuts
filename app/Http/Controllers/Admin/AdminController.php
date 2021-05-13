<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\SendSMS;
use App\Mail\AdminCreated;
use App\Models\Admin;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Permission;
use DB;
class AdminController extends Controller
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
        if (Auth::user()->role != 'general_management') {
            return view('admin.users.index-admin-user');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::query()
            ->where('name', '!=', 'buyer')
            ->where('name', '!=', 'user')
            ->get();
        if (Auth::user()->role != 'general_management') {
            return view('admin.users.create-admin-user', compact('roles'));
        }
        else{
            return abort(403);
        }
    }
    /**
     * Get Users DataTable
     *
     * @return \Illuminate\Http\Response
     */
    public function getAdminUsers()
    {
        $users = Admin::role(['admin','inventory', 'management','quality_management','general_management'])->get();
        return Datatables::of($users)
            ->addColumn('role', function ($users){
                return $users->roles->first()->name ?? '--';
            })
            ->addColumn('action', function ($users) {
                return '<div class="dropdown dropdown-inline">
								<a href="" class="btn btn-sm btn-clean btn-icon" data-toggle="dropdown">
	                                <i class="la la-cog"></i>
	                            </a>
							  	<div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
									<ul class="nav nav-hoverable flex-column">
							    		<li class="nav-item"><a class="nav-link" href="'.route('admin.app-admins.show',Crypt::encrypt($users->id)).'"><i class="nav-icon la la-user"></i><span class="nav-text">View User Details</span></a></li>
							    		<li class="btn btn-light font-size-sm mr-5"data-toggle="modal"data-target="#smallModal" id="smallButton"><i class="nav-icon la la-sync-alt"></i><span class="nav-text">Update Status</span></li>
							    	</ul>
							  	</div>
							</div>

						';
            })
            ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
            $validator = Validator::make($request->all(), [
                'first_name' =>  'required|regex:/^[a-zA-Z]+$/u|min:4|max:12',
                'last_name' =>  'required|regex:/^[a-zA-Z]+$/u|min:4|max:12',
                'email' => 'required|email|unique:admins',
                'phone_number' => 'required|unique:admins',
                'password' => 'required',
                'role' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()->route('admin.app-admins.create')
                    ->withErrors($validator)
                    ->withInput()
                    ->with('error', $validator->errors()->first());

            }
            $password = $request->password;
            $check_phone_number = Admin::query()->where('phone_number', '=', '254'.substr($request->phone_number, -9))->exists();
            if ($check_phone_number){
                return Redirect::back()->withInput()->with('error', 'Phone Number already exists');
            }
            try {
                //$passcode = $this->passcode();
                $user = Admin::create([
                    'first_name' => $request->first_name,
                    'last_name' =>$request->last_name,
                    'email' => $request->email,
                    'phone_number' => '254'.substr($request->phone_number, -9),
                    'password' => Hash::make($request->password),
                ]);
                $user->assignRole($request->role);
                $details = [
                    'name'=>$user->first_name.' '.$user->last_name,
                    'email'=>$user->email,
                    'password'=>$password,
                ];
                if ($user)
                    //you did not include this
                    $user->notify(
                      new \App\Notifications\AdminCreated($details)
                    );
                //temporary
                SendSMS::dispatch($user->phone_number, "Hello $user->first_name,\nYour Equatorial Nut System Password is: $password");
                return redirect()->route('admin.app-admins.index')->with('message','Admin created Successfully');
            } catch (\Exception $exception) {

                return back()->with('error', 'Error Saving the Record...try again');

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
        $user = Admin::findOrFail($id);
           $role = $user->roles->first()->name;
            if (Auth::user()->role != 'general_management') {
                return view('admin.users.show-admin', compact('user', 'role'));
            }
            else{
                return abort(403);
            }
            }
    catch (ModelNotFoundException $e) {
        return $e;
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
            $user = Admin::findOrFail($id);
            $user->status = $request->status;
            $user->save();
            return redirect()->route('admin.app-admins.index')->with('message', 'User Status Updated successfully');
        }
        catch (ModelNotFoundException $e) {
            return back()->with('error', 'Error Try Again...');
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
            $user = Admin::findOrFail($id);
            if (Auth::user()->role != 'general_management') {
                return view('admin.users.edit-admin-user', compact('user'));
            }
            else{
                return abort(403);
            }
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
            'name' => 'required',
            'username' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.app-admins.create')
                ->withErrors($validator)
                ->withInput();
        }

        try {

            $admin = Admin::findOrFail($id);

            $admin->name = $request->name;
            $admin->username = $request->username;
            $admin->email = $request->email;
            $admin->phone_number = $request->name;
            $admin->password = Hash::make($request->password);
           $admin->updated_at = Carbon::now();

            $admin->save();
            return redirect()->route('admin.app-admins.index')->with('flash_success', 'Admin Updated successfully');
        }
        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Admin Record Not Found');
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
