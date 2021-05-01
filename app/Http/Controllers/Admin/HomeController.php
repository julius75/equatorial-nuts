<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BuyingCenter;
use App\Models\Farmer;
use App\Models\Order;
use App\Models\Region;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class HomeController extends Controller
{

    /**
     * Dashboard Home Page
     * @param Request $request
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|mixed
     */
    public function index(Request $request)
    {
        $data['user'] = Auth::guard('admin')->user();
        $data['first_letter'] = ucfirst(substr($data['user']->first_name, 0, 1));
        $data['page_title'] = 'Dashboard';
        $data['regions'] = Region::all();
        $farmers = Farmer::all();
        $complete_orders_amount = Order::query()->where('disbursed', '=', true)->sum('amount');
        if ($request->has('region') and $request->region != "all"){
            $validator = Validator::make($request->all(), [
                'region' => 'required'
            ]);
            if ($validator->fails()) {
                return Redirect::back()->withErrors($validator)->withInput()->with('error', $validator->errors()->first());
            }
            try{
                $region = Region::query()->find($request->region);
                if (!$region)
                    return Redirect::back()->with('warning', 'Invalid Region has been submitted, refresh page and try again');
            }catch (\Exception $e){
                return Redirect::back()->with('warning', 'Invalid Region has been submitted, refresh page and try again');
            }
            $complete_orders_amount = Order::query()
                ->whereHas('order_region', function ($q) use ($region){
                    $q->where('region_id', '=', $region->id);
                })
                ->where('orders.disbursed', '=', true)
                ->sum('orders.amount');

            $data['page_description'] = "Specified Region: $region->name";
            $data['farmersCount'] = $region->farmers()->count();
            $data['buyingCentersCount'] = $region->buying_centers()->count();
            $data['transactionsAmount'] = $complete_orders_amount;
            $data['current_region'] = $region->id;
            $data['buyersCount'] = $region->buyers()->count();
            $data['monthly_payments_data_array'] = $this->paymentsChartData($request);
        }
        else
            {
                $data['page_description'] = 'Stats for all the registered ENP Regions';
                $data['farmersCount'] = count($farmers);
                $data['buyingCentersCount'] = BuyingCenter::all()->count();
                $data['transactionsAmount'] = $complete_orders_amount;
                $data['current_region'] = "all";
                $data['buyersCount'] = User::all()->count();
                $data['monthly_payments_data_array'] = $this->paymentsChartData($request);

            }
        return view('admin.dashboard', $data);

    }

    protected function paymentsChartData($request)
    {
        $order_dates = Order::query()
            ->where('disbursed','=', true)
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

    public function disbursed_payments_filter(Request $request)
    {
        $this->data['page_title'] = "Monthly Payments";
        $this->data['page_description'] = "Monthly Payments Filter";
        $this->data['regions'] = Region::all();
        $this->data['buyers'] = User::query()->where('status', '=', true)->get();
        if ($request->has('region') and $request->region != 'all' and $request->buyer == 'all')
        {
            $this->region_specified($request);
        }
        //if buyer is specified and region isn't
        elseif ($request->has('buyer') and $request->buyer != 'all' and $request->region == 'all')
        {
          $this->buyer_specified($request);
        }
        //if both buyer and region are specified
        elseif ($request->buyer and $request->region and $request->buyer != 'all' and $request->region != 'all')
        {
            $this->buyer_region_specified($request);
        }
        //month only
        elseif ($request->month and $request->buyer == 'all' and $request->region == 'all')
        {
            $this->month_specified($request);
        }
        //default page data
        else{
            $loans_dates = Order::query()->where('disbursed','=', true)
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
                    $monthly_loan_count = Order::query()->where('disbursed', '=', true)->whereDay('disbursed_at', $day)->whereMonth('disbursed_at', Carbon::now())->whereYear('disbursed_at', Carbon::now())->get()->count();
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
            $monthly_loan_data_array = array(
                'month' => $month_name_array,
                'post_count_data' => $monthly_loan_count_array,
                'payment_amount' => $monthly_loan_amount_array,
                'max_disbursement' => $max_disbursement,
                'max_amount' => $max_amount,
            );
            $this->data['current'] = Carbon::now()->format('M-Y');
            $disbAmount = array_sum($monthly_loan_amount_array);
            $this->data['disbAmount'] = $disbAmount;
            $this->data['disbCount'] = array_sum($monthly_loan_count_array);
            $this->data['current_region'] = 'all';
            $this->data['current_buyer'] = 'all';
            $this->data['monthly_payments_data_array'] = json_encode($monthly_loan_data_array);
        }

        return view('admin.transaction_region_filter', $this->data);
    }

    protected function region_specified($request){
        $month = Carbon::parse($request->month);
        $region = Region::query()->find($request->region);
        $order_dates = Order::query()
            ->where('disbursed','=', true)
            ->whereHas('order_region', function ($q) use ($region){
                $q->where('region_id', '=', $region->id);
            })
            ->whereMonth('disbursed_at', $month)
            ->whereYear('disbursed_at', $month)
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

        $monthly_loan_data_array = array(
            'month' => $month_name_array,
            'post_count_data' => $monthly_disbursement_count_array,
            'payment_amount' => $monthly_disbursement_amount_array,
            'max_disbursement' => $max_disbursement,
            'max_amount' => $max_amount,
        );
        $this->data['current'] = $request->month;
        $this->data['current_region'] = $request->region;
        $this->data['current_buyer'] = 'all';
        $disbAmount = array_sum($monthly_disbursement_amount_array);
        $this->data['disbAmount'] = $disbAmount;
        $this->data['disbCount'] = array_sum($monthly_disbursement_count_array);
        $this->data['monthly_payments_data_array'] = json_encode($monthly_loan_data_array);
    }

    protected function buyer_specified($request){
        $month = Carbon::parse($request->month);
        $user = User::query()->find($request->buyer);
        $loans_dates = $user->orders()->where('disbursed', true)->whereMonth('disbursed_at', $month)->whereYear('disbursed_at', $month)->orderBy( 'disbursed_at', 'ASC' )->pluck( 'disbursed_at' );
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
                $monthly_loan_count = $user->orders()->where('disbursed', true)->whereDay('disbursed_at', $day)->whereMonth('disbursed_at', $month)->whereYear('disbursed_at', $month)->get()->count();
                $monthly_loan_amount = $user->orders()->where('disbursed', true)->whereDay('disbursed_at', $day)->whereMonth('disbursed_at', $month)->whereYear('disbursed_at', $month)->sum('amount');
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

        $monthly_loan_data_array = array(
            'month' => $month_name_array,
            'post_count_data' => $monthly_loan_count_array,
            'payment_amount' => $monthly_loan_amount_array,
            'max_disbursement' => $max_disbursement,
            'max_amount' => $max_amount,
        );
        $this->data['current'] = $request->month;
        $this->data['current_region'] ='all';
        $this->data['current_buyer'] = $request->buyer;
        $disbAmount = array_sum($monthly_loan_amount_array);
        $this->data['disbAmount'] = $disbAmount;
        $this->data['disbCount'] = array_sum($monthly_loan_count_array);
        $this->data['monthly_payments_data_array'] = json_encode($monthly_loan_data_array);
    }

    protected function buyer_region_specified($request){
        $month = Carbon::parse($request->month);
        $user = User::query()->find($request->buyer);
        $region = Region::query()->find($request->region);
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

        $monthly_loan_data_array = array(
            'month' => $month_name_array,
            'post_count_data' => $monthly_loan_count_array,
            'payment_amount' => $monthly_loan_amount_array,
            'max_disbursement' => $max_disbursement,
            'max_amount' => $max_amount,
        );
        $this->data['current'] = $request->month;
        $this->data['current_region'] =$request->region;
        $this->data['current_buyer'] = $request->buyer;
        $disbAmount = array_sum($monthly_loan_amount_array);
        $this->data['disbAmount'] = $disbAmount;
        $this->data['disbCount'] = array_sum($monthly_loan_count_array);
        $this->data['monthly_payments_data_array'] = json_encode($monthly_loan_data_array);
    }

    protected function month_specified($request){
        $month = Carbon::parse($request->month);
        $loans_dates = Order::query()->where('disbursed', '=',true)
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
            $max_disb_no = 0;
            $max_disbursement = 0;
        }

        if (!empty($monthly_loan_amount_array)){
            $max_amount_no = max( $monthly_loan_amount_array );
            $max_amount = round(( $max_amount_no + 10/2 ) / 10 ) * 10;
        }else{
            $max_amount_no = 0;
            $max_amount = 0;
        }
        $monthly_loan_data_array = array(
            'month' => $month_name_array,
            'post_count_data' => $monthly_loan_count_array,
            'payment_amount' => $monthly_loan_amount_array,
            'max_disbursement' => $max_disbursement,
            'max_amount' => $max_amount,
        );
        $this->data['current'] = $month->format('M-Y');
        $disbAmount = array_sum($monthly_loan_amount_array);
        $this->data['disbAmount'] = $disbAmount;
        $this->data['disbCount'] = array_sum($monthly_loan_count_array);
        $this->data['current_region'] = 'all';
        $this->data['current_buyer'] = 'all';
        $this->data['monthly_payments_data_array'] = json_encode($monthly_loan_data_array);
    }
}
