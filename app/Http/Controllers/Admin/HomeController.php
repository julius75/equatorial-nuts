<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BuyingCenter;
use App\Models\Farmer;
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
     *
     */
    public function index(Request $request)
    {
        $data['user'] = Auth::guard('admin')->user();
        $data['first_letter'] = ucfirst(substr($data['user']->first_name, 0, 1));
        $data['page_title'] = 'Dashboard';
        $data['regions'] = Region::all();
        $farmers = Farmer::all();
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

            $data['page_description'] = "Specified Region: $region->name";
            $data['farmersCount'] = $region->farmers()->count();
            $data['buyingCentersCount'] = $region->buying_centers()->count();
            $data['transactionsAmount'] = 100000;
            $data['current_region'] = $region->id;
            $data['buyersCount'] = $region->buyers()->count();
            $data['monthly_payments_data_array'] = $this->paymentsChartData($region);
        }
        else
            {
                $data['page_description'] = 'Stats for all the registered ENP Regions';
                $data['farmersCount'] = count($farmers);
                $data['buyingCentersCount'] = BuyingCenter::all()->count();
                $data['transactionsAmount'] = 200000;
                $data['current_region'] = "all";
                $data['buyersCount'] = User::all()->count();
                $data['monthly_payments_data_array'] = $this->paymentsChartData(null);

            }
        return view('admin.dashboard', $data);

    }

    protected function paymentsChartData($region){
        if ($region == null){
            $monthly_payments_data_array = json_encode([
                "month" => ["01-Apr", "03-Apr", "05-Apr", "06-Apr", "09-Apr", "11-Apr", "12-Apr", "13-Apr", "16-Apr", "17-Apr", "18-Apr", "19-Apr", "20-Apr", "23-Apr"],
                "post_count_data" => [2, 5, 2, 2, 1, 7, 2, 1, 4, 6, 4, 7, 5, 4],
                "payment_amount" => [ "20000", "58000", "35000", "12000", "8000", "64000", "18000", "9000", "42000", "60000",  "34000",  "65000",  "49000",  "43000"],
                "max_disbursement" => 10.0,
                "max_amount" => 66000.0
            ], true);
        }else{
            $monthly_payments_data_array = json_encode([
                "month" => ["01-Apr", "03-Apr", "05-Apr", "06-Apr", "09-Apr", "11-Apr", "12-Apr", "13-Apr", "16-Apr", "17-Apr", "18-Apr", "19-Apr", "20-Apr", "23-Apr"],
                "post_count_data" => [1, 3, 2, 2, 1, 4, 2, 1, 4, 6, 4, 3, 4, 4],
                "payment_amount" => [ "20000", "24000", "15000", "2000", "9000", "30000", "13000", "2000", "20000", "10000",  "17000",  "30000",  "29000",  "23000"],
                "max_disbursement" => 10.0,
                "max_amount" => 36000.0
            ], true);
        }

       return $monthly_payments_data_array;
    }


}
