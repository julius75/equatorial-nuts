<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\SendSMS;
use App\Mail\BuyerCreated;
use App\Models\Admin;
use App\Models\BuyingCenter;
use App\Models\Farmer;
use App\Models\Order;
use App\Models\RawMaterial;
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

/**
 * This controller has all the ENP Buyer Logic
 *
 */
class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('role:admin')->only(['create', 'store', 'edit', 'update']);

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

    /**
     * Get Users DataTable
     *
     * @return \Illuminate\Http\Response
     */
    public function getUsers()
    {
        $user = Auth::user();
        $users = User::role('buyer')->get();
        if ($user->hasRole(['admin','general_management'])) {
            return Datatables::of($users)
                ->addColumn('action', function ($users) {
                    return '<div class="dropdown dropdown-inline">
								<a href="" class="btn btn-sm btn-clean btn-icon" data-toggle="dropdown">
	                                <i class="la la-cog"></i>
	                            </a>
							  	<div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
									<ul class="nav nav-hoverable flex-column">
							    		<li class="nav-item"><a class="nav-link" href="'.route('admin.app-users.show',Crypt::encrypt($users->id)).'"><i class="nav-icon la la-user"></i><span class="nav-text">View User Details</span></a></li>
							    		<li class="nav-item"><a class="nav-link" href="'.route('admin.view-buyer-assignments',Crypt::encrypt($users->id)).'"><i class="nav-icon la la-address-book"></i><span class="nav-text">View Assignments</span></a></li>
							    		<li class="btn btn-light font-size-sm mr-5"data-toggle="modal"data-target="#smallModal" id="smallButton"><i class="nav-icon la la-sync-alt"></i><span class="nav-text">Update Status</span></li>
							    	</ul>
							  	</div>
							</div>

						';
                })
                ->make(true);
        }
        else {
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
							    		<li class="nav-item"><a class="nav-link" href="'.route('admin.view-buyer-assignments',Crypt::encrypt($users->id)).'"><i class="nav-icon la la-address-book"></i><span class="nav-text">View Assignments</span></a></li>
							    	</ul>
							  	</div>
							</div>

						';
                })
                ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $regions = Region::all();
        $raw_materials = RawMaterial::all();
        return view('admin.users.create', compact('regions', 'raw_materials'));
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
            'region_id' => 'required|exists:regions,id',
            'raw_material_id' => 'required|exists:raw_materials,id',
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

        try {

            $user = User::query()->create([
                'first_name' => $input['first_name'],
                'last_name' => $input['last_name'],
                'email' => $input['email'],
                'phone_number' => '254'.substr($input['phone_number'], -9),
                'password' => $input['password'],
                'status' => true,
                'passcode' => mt_rand(1000,9999)
            ]);

            $user->regions()
                ->attach($request->region_id,[
                    'current'=> true,
                    'assigned_by'=> Auth::id(),
                    'assigned_at'=> now(),
                    'raw_material_id'=>$request->raw_material_id
                ]);

            $user->assignRole('buyer');

            $details = [
                'name'=>$user->first_name.' '.$user->last_name,
                'email'=>$user->email,
                'phone_number'=>$user->phone_number,
                'password'=>$password
            ];
           Mail::send(new BuyerCreated($details));

           $message = "Hello $user->full_name, your ENP Buyer Account has been registered successfully. Credentials are as follows:\nMobile: $user->phone_number\nPassword: $password";
           SendSMS::dispatch($user->phone_number, $message);

            return Redirect::route('admin.app-users.index')->with('message','Buyer created Successfully');

        } catch (\Exception $exception) {
            return Redirect::route('admin.app-users.create')->with('error', 'Something went wrong');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function show(Request $request,$id)
    {
        try {
            $id = Crypt::decrypt($id);
            $buyer = User::query()->findOrFail($id);
            $data['user'] = $buyer;
            $data['id'] =$id;
            $data['regions'] = Region::all();
            $data['raw_materials'] = RawMaterial::all();
            $data['current_region'] = "all";
            $data['buyers'] = User::query()->where('status', '=', true)->get();
            $data['current_buyer'] = 'all';
            $data['current'] = Carbon::now()->format('M-Y');

            $complete_orders_amount = Order::query()->where(['disbursed' => true,'user_id' => $id])->sum('amount');
            $complete_orders_count = Order::query()->where(['disbursed' => true,'user_id' => $id])->count();

            $get_current_assignment = DB::table('region_users')
                ->where('current', '=', true)
                ->where('user_id', '=', $buyer->id)
                ->first();
            if ($get_current_assignment){
                $current_assignment['region'] = Region::query()->find($get_current_assignment->region_id);
                $current_assignment['raw_material'] = RawMaterial::query()->find($get_current_assignment->raw_material_id);
                $current_assignment['query_data'] = $get_current_assignment;
                $data['current_assignment'] = $current_assignment;
            }

            $data['transactionsAmount'] = $complete_orders_amount;
            $data['transactionsCount'] = $complete_orders_count;
            $data['monthly_payments_data_array'] = $this->paymentsChartData($request,$id);
            return view('admin.users.show',$data);
        } catch (ModelNotFoundException $e) {
            return Redirect::back()->with('error', 'Something went wrong');
        }
    }

    /**
     * Loads the chart once the page is opened
     *
     * @return array
     */
    protected function paymentsChartData($request,$id)
    {
        $order_dates = Order::query()
            ->where('disbursed','=', true)
            ->where('user_id','=', $id)
            ->whereMonth('disbursed_at', Carbon::now())
            ->whereYear('disbursed_at', Carbon::now())
            ->orderBy( 'disbursed_at', 'ASC' )
            ->pluck( 'disbursed_at');
        $month_array = array();
        $order_dates = json_decode( $order_dates );
        if ( ! empty( $order_dates ) ) {
            foreach ( $order_dates as $unformatted_date ) {
                $date = new \DateTime( $unformatted_date );
                $day = $date->format( 'd' );
                $month_name = $date->format( 'd-M' );
                $month_array[ $day ] = $month_name;
            }
        }
        $monthly_disbursement_count_array = array();
        $month_name_array = array();
        $monthly_disbursement_amount_array = array();
        if ( ! empty( $month_array ) ) {
            foreach ( $month_array as $day => $month_name ){
                if($request->has('region') && $request->region != 'all'){
                    $region = Region::query()->find($request->region);
                    $monthly_disbursement_count = Order::query()
                        ->whereHas('order_region', function ($q) use ($region){
                            $q->where('region_id', '=', $region->id);
                        })->where('disbursed', '=', true)->whereDay('disbursed_at', $day)->whereMonth('disbursed_at', Carbon::now())->whereYear('disbursed_at', Carbon::now())
                        ->get()->count();
                    $monthly_disbursement_amount = Order::query()
                        ->whereHas('order_region', function ($q) use ($region){
                            $q->where('region_id', '=', $region->id);
                        })->where('disbursed', '=', true)
                        ->whereDay('disbursed_at', $day)->whereMonth('disbursed_at', Carbon::now())->whereYear('disbursed_at', Carbon::now())
                        ->sum('amount');
                } else {
                    $monthly_disbursement_count = Order::query()->with('mpesa_disbursement_transaction')
                        ->where('disbursed','=', true)
                        ->whereDay('disbursed_at', $day)->whereMonth('disbursed_at', Carbon::now())->whereYear('disbursed_at', Carbon::now())
                        ->get()->count();
                    $monthly_disbursement_amount = Order::query()->with('mpesa_disbursement_transaction')
                        ->where('disbursed','=', true)
                        ->whereDay('disbursed_at', $day)->whereMonth('disbursed_at', Carbon::now())->whereYear('disbursed_at', Carbon::now())
                        ->sum('amount');
                }
                array_push( $monthly_disbursement_count_array, $monthly_disbursement_count );
                array_push( $monthly_disbursement_amount_array, $monthly_disbursement_amount );
                array_push( $month_name_array, $month_name );
            }
        }
        if (!empty($monthly_disbursement_count_array)){
            $max_disb_no = max( $monthly_disbursement_count_array );
            $max_disbursement = round(( $max_disb_no + 10/2 ) / 10 ) * 10;
        }else{
            $max_disbursement = 0;
        }

        if (!empty($monthly_disbursement_amount_array)){
            $max_amount_no = max( $monthly_disbursement_amount_array );
            $max_amount = round(( $max_amount_no + 10/2 ) / 10 ) * 10;
        }else{
            $max_amount = 0;
        }

        return json_encode($monthly_loan_data_array = array(
            'month' => $month_name_array,
            'post_count_data' => $monthly_disbursement_count_array,
            'payment_amount' => $monthly_disbursement_amount_array,
            'max_disbursement' => $max_disbursement,
            'max_amount' => $max_amount,
        ));
    }

    /**
     * Filter the chart
     *
     * @return array
     */
    public function disbursed_payments_filter_buyer($month, $region, $id)
    {
        if($month != 'current' and $region == 'all'){
            $month = Carbon::parse($month);
            $user = User::query()->find($id);
            $loans_dates = $user->orders()->where('disbursed', true)
                ->whereMonth('disbursed_at', $month)
                ->whereYear('disbursed_at', $month)
                ->orderBy( 'disbursed_at', 'ASC' )
                ->pluck( 'disbursed_at' );
            $month_array = array();
            $loans_dates = json_decode( $loans_dates );
            if ( ! empty( $loans_dates ) ) {
                foreach ( $loans_dates as $unformatted_date ) {
                    $date = new \DateTime( $unformatted_date );
                    $day = $date->format( 'd' );
                    $month_name = $date->format( 'd-M' );
                    $month_array[ $day ] = $month_name;
                }
            }
            $monthly_loan_count_array = array();
            $month_name_array = array();
            $monthly_loan_amount_array = array();
            if ( ! empty( $month_array ) ) {
                foreach ( $month_array as $day => $month_name ){
                    $monthly_loan_count = Order::query()->where('disbursed','=', true)->whereDay('disbursed_at', $day)->whereMonth('disbursed_at', $month)->whereYear('disbursed_at', $month)->get()->count();
                    $monthly_loan_amount = Order::query()->where('disbursed','=', true)->whereDay('disbursed_at', $day)->whereMonth('disbursed_at', $month)->whereYear('disbursed_at', $month)->sum('amount');
                    array_push( $monthly_loan_count_array, $monthly_loan_count );
                    array_push( $monthly_loan_amount_array, $monthly_loan_amount );
                    array_push( $month_name_array, $month_name );
                }
            }
            if (!empty($monthly_loan_count_array)){
                $max_disb_no = max( $monthly_loan_count_array );
                $max_disbursement = round(( $max_disb_no + 10/2 ) / 10 ) * 10;
            }else{
                $max_disbursement = 0;
            }

            if (!empty($monthly_loan_amount_array)){
                $max_amount_no = max( $monthly_loan_amount_array );
                $max_amount = round(( $max_amount_no + 10/2 ) / 10 ) * 10;
            }else{
                $max_amount = 0;
            }

            $disbAmount = array_sum($monthly_loan_amount_array);
            $monthly_loan_data_array = array(
                'month' => $month_name_array,
                'post_count_data' => $monthly_loan_count_array,
                'payment_amount' => $monthly_loan_amount_array,
                'max_disbursement' => $max_disbursement,
                'max_amount' => $max_amount,
                'current_buyer' => 'all',
                'current_region' => 'all',
                'current' => Carbon::now()->format('M-Y'),
                'disbAmount' => $disbAmount,
                'disbCount' =>  array_sum($monthly_loan_count_array),
            );
        }
        elseif($month != 'current' and $region != 'all'){
            $month = Carbon::parse($month);
            $user = User::query()->find($id);
            $region = Region::query()->find($region);
            $loans_dates = $user->orders()->where('disbursed', true)
                ->whereHas('order_region', function ($q) use ($region){
                    $q->where('region_id', '=', $region->id);
                })->whereMonth('disbursed_at', $month)->whereYear('disbursed_at', $month)->orderBy( 'disbursed_at', 'ASC' )->pluck( 'disbursed_at' );
            $month_array = array();
            $loans_dates = json_decode( $loans_dates );
            if ( ! empty( $loans_dates ) ) {
                foreach ( $loans_dates as $unformatted_date ) {
                    $date = new \DateTime( $unformatted_date );
                    $day = $date->format( 'd' );
                    $month_name = $date->format( 'd-M' );
                    $month_array[ $day ] = $month_name;
                }
            }
            $monthly_loan_count_array = array();
            $month_name_array = array();
            $monthly_loan_amount_array = array();
            if ( ! empty( $month_array ) ) {
                foreach ( $month_array as $day => $month_name ){
                    $monthly_loan_count = $user->orders()->where('disbursed', true)
                        ->whereHas('order_region', function ($q) use ($region){
                            $q->where('region_id', '=', $region->id);
                        })->whereDay('disbursed_at', $day)->whereMonth('disbursed_at', $month)->whereYear('disbursed_at', $month)->get()->count();
                    $monthly_loan_amount = $user->orders()->where('disbursed', true)
                        ->whereHas('order_region', function ($q) use ($region){
                            $q->where('region_id', '=', $region->id);
                        })->whereDay('disbursed_at', $day)->whereMonth('disbursed_at', $month)->whereYear('disbursed_at', $month)->sum('amount');
                    array_push( $monthly_loan_count_array, $monthly_loan_count );
                    array_push( $monthly_loan_amount_array, $monthly_loan_amount );
                    array_push( $month_name_array, $month_name );
                }
            }
            if (!empty($monthly_loan_count_array)){
                $max_disb_no = max( $monthly_loan_count_array );
                $max_disbursement = round(( $max_disb_no + 10/2 ) / 10 ) * 10;
            }else{
                $max_disbursement = 0;
            }

            if (!empty($monthly_loan_amount_array)){
                $max_amount_no = max( $monthly_loan_amount_array );
                $max_amount = round(( $max_amount_no + 10/2 ) / 10 ) * 10;
            }else{
                $max_amount = 0;
            }

            $disbAmount = array_sum($monthly_loan_amount_array);
            $monthly_loan_data_array = array(
                'month' => $month_name_array,
                'post_count_data' => $monthly_loan_count_array,
                'payment_amount' => $monthly_loan_amount_array,
                'max_disbursement' => $max_disbursement,
                'max_amount' => $max_amount,
                'current_buyer' => 'all',
                'current_region' => 'all',
                'current' => Carbon::now()->format('M-Y'),
                'disbAmount' => $disbAmount,
                'disbCount' =>  array_sum($monthly_loan_count_array),
            );
        }
        else{
            $user = User::query()->find($id);
            $loans_dates = $user->orders()->where('disbursed', true)
                ->whereMonth('disbursed_at', Carbon::now())
                ->whereYear('disbursed_at', Carbon::now())
                ->orderBy( 'disbursed_at', 'ASC' )
                ->pluck( 'disbursed_at' );

            $month_array = array();
            $loans_dates = json_decode( $loans_dates );
            if ( ! empty( $loans_dates ) ) {
                foreach ( $loans_dates as $unformatted_date ) {
                    $date = new \DateTime( $unformatted_date );
                    $day = $date->format( 'd' );
                    $month_name = $date->format( 'd-M' );
                    $month_array[ $day ] = $month_name;
                }
            }
            $monthly_loan_count_array = array();
            $month_name_array = array();
            $monthly_loan_amount_array = array();
            if ( ! empty( $month_array ) ) {
                foreach ( $month_array as $day => $month_name ) {
                    $monthly_loan_count = Order::query()->where('disbursed', '=', true)
                        ->whereDay('disbursed_at', $day)
                        ->whereMonth('disbursed_at', Carbon::now())
                        ->whereYear('disbursed_at', Carbon::now())->get()->count();
                    $monthly_loan_amount = Order::query()->where('disbursed', '=', true)->whereDay('disbursed_at', $day)->whereMonth('disbursed_at', Carbon::now())->whereYear('disbursed_at', Carbon::now())->sum('amount');
                    array_push($monthly_loan_count_array, $monthly_loan_count);
                    array_push($monthly_loan_amount_array, $monthly_loan_amount);
                    array_push($month_name_array, $month_name);
                }
            }
            if (!empty($monthly_loan_count_array)){
                $max_disb_no = max( $monthly_loan_count_array );
                $max_disbursement = round(( $max_disb_no + 10/2 ) / 10 ) * 10;
            }else{
                $max_disbursement = 0;
            }

            if (!empty($monthly_loan_amount_array)){
                $max_amount_no = max( $monthly_loan_amount_array );
                $max_amount = round(( $max_amount_no + 10/2 ) / 10 ) * 10;
            }else{
                $max_amount = 0;
            }

            $disbAmount = array_sum($monthly_loan_amount_array);
            $monthly_loan_data_array = array(
                'month' => $month_name_array,
                'post_count_data' => $monthly_loan_count_array,
                'payment_amount' => $monthly_loan_amount_array,
                'max_disbursement' => $max_disbursement,
                'max_amount' => $max_amount,
                'current_buyer' => 'all',
                'current_region' => 'all',
                'current' => Carbon::now()->format('M-Y'),
                'disbAmount' => $disbAmount,
                'disbCount' =>  array_sum($monthly_loan_count_array),
            );
        }
        return $monthly_loan_data_array;
    }

    /**
     * Form for editing Buyer Details
     *
     */
    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        $user = User::query()->findOrFail($id);
        return view('admin.users.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput()->with('error', $validator->errors()->first());
        }

        try {
            $user = User::query()->findOrFail($id);
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->phone_number = $request->phone_number;
            $user->save();

            return Redirect::route('admin.app-users.index')->with('message', 'User Updated successfully');
        }
        catch (ModelNotFoundException $e) {
            return Redirect::back()->with('error', 'User Not Found');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function statusUpdate(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required',
        ]);
        if ($validator->fails()) {
            return Redirect::back()->with('error', 'Status required');
        }
        try {
            $user = User::query()->findOrFail($id);
            $user->status = $request->status;
            $user->save();
            return Redirect::route('admin.app-users.index')->with('message', 'User Status Updated successfully');
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

    /**
     * View page for changing a users assigned region
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function view_buyer_assignments(string $id)
    {
        $buyer = User::query()->find(Crypt::decrypt($id));
        $regions = Region::all();
        $raw_materials = RawMaterial::all();
        return view('admin.users.view_buyer_assignments', compact('buyer', 'regions', 'raw_materials'));
    }
    /**
     * Data Table for user assignments
     *
     * @param  string  $encryptedId
     * @return \Illuminate\Http\Response
     */
    public function view_buyer_assignments_data(string $encryptedId)
    {
        $data = DB::table('region_users')->where('user_id', '=', Crypt::decrypt($encryptedId))->get();
        return Datatables::of($data)
            ->addColumn('region', function ($data) {
                return Region::query()->find($data->region_id)->name;
            })
            ->addColumn('raw_material', function ($data) {
                return RawMaterial::query()->find($data->raw_material_id)->name;
            })
            ->addColumn('assigner', function ($data) {
                return Admin::query()->find($data->assigned_by)->full_name;
            })
            ->make(true);
    }

    /**
     * Update Buyer Region/Raw Material Assignment
     *
     * @param Request $request
     * @param string $encryptedId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update_buyer_assignments(Request $request, string $encryptedId)
    {
        $validator = Validator::make($request->all(), [
            'region_id' => 'required|exists:regions,id',
            'raw_material_id' => 'required|exists:raw_materials,id',
        ]);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput()->with('error', $validator->errors()->first());
        }
        $buyer = User::query()->find(Crypt::decrypt($encryptedId));
        $check_for_previous = DB::table('region_users')
            ->where('user_id', '=', Crypt::decrypt($encryptedId))
            ->where('current', '=', true)
            ->exists();
        if ($check_for_previous){
            DB::table('region_users')
                ->where('user_id', '=', Crypt::decrypt($encryptedId))
                ->where('current', '=', true)
                ->update(['current'=>false]);
        }
        $buyer->regions()
            ->attach($request->region_id,[
                'current'=> true,
                'assigned_by'=> Auth::id(),
                'assigned_at'=> now(),
                'raw_material_id' => $request->raw_material_id
            ]);

        return Redirect::back()->with('success', 'Buyer Assignment updated successfully');
    }

    /**
     * Get Buyer Orders
     *
     * @param Request $request
     * @param string $encryptedId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function get_orders(Request $request, string $encryptedId)
    {
        $buyer = User::query()->find(Crypt::decrypt($encryptedId));
        //region specified rest are "all"
        if ($request->region_id != "all" and $request->raw_material_id == "all"){
            $data = Order::query()
                ->where('user_id', '=', $buyer->id)
                ->whereHas('order_region', function ($q) use ($request){
                    $q->where('region_id', '=', $request->region_id);
                })->with(['order_region.region', 'order_raw_material.raw_material', 'user'])
                ->get();
        }
        //raw material specified rest are "all"
        elseif ($request->raw_material_id != "all" and $request->region_id == "all"){
            $data = Order::query()
                ->where('user_id', '=', $buyer->id)
                ->whereHas('order_raw_material', function ($q) use ($request){
                    $q->where('raw_material_id', '=', $request->raw_material_id);
                })->with(['order_region.region', 'order_raw_material.raw_material', 'user'])
                ->get();
        }
        //region and raw material specified
        elseif ($request->region_id != "all" and $request->raw_material_id != "all"){
            $data = Order::query()
                ->where('user_id', '=', $buyer->id)
                ->where(function($q) use($request){
                    $q->whereHas('order_raw_material', function ($q) use ($request){
                        $q->where('raw_material_id', '=', $request->raw_material_id);
                    });
                    $q->whereHas('order_region', function ($q) use ($request){
                        $q->where('region_id', '=', $request->region_id);
                    });
                })
                ->with(['order_region.region', 'order_raw_material.raw_material', 'user'])
                ->get();
        }
        else{
            $data = Order::query()
                ->where('user_id', '=', $buyer->id)
                ->with(['order_region.region', 'order_raw_material.raw_material', 'user'])
                ->get();
        }
        return Datatables::of($data)
            ->addColumn('action', function ($data) {
                return '<a href="'.route('admin.orders.show', $data->ref_number).'" class="btn btn-secondary btn-sm">
                            <i class="flaticon2-pie-chart"></i> View
                        </a>
						';
            })
            ->make(true);
    }

}
