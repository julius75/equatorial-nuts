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

use Yajra\DataTables\Facades\DataTables;

class HomeController extends Controller
{
    public function index()
    {
        $data['user'] = Auth::guard('admin')->user();
        $data['first_letter'] = ucfirst(substr($data['user']->first_name, 0, 1));
        $data['page_title'] = 'Dashboard';
        $data['page_description'] = 'Some description for the page';
        $data['regions'] = Region::all();
        $data['farmersCount'] = Farmer::all()->count();
        $data['buyingCentersCount'] = BuyingCenter::all()->count();
        $data['transactionsAmount'] = 200000;
        $data['buyersCount'] = User::all()->count();
        $data['monthly_payments_data_array']=
            json_encode([
                "month" => ["01-Apr", "03-Apr", "05-Apr", "06-Apr", "09-Apr", "11-Apr", "12-Apr", "13-Apr", "16-Apr", "17-Apr", "18-Apr", "19-Apr", "20-Apr", "23-Apr"],
                "post_count_data" => [1, 5, 2, 2, 1, 7, 2, 1, 4, 6, 4, 7, 5, 4],
                "payment_amount" => [ "20000", "58000", "35000", "12000", "8000", "64000", "18000", "9000", "42000", "60000",  "34000",  "65000",  "49000",  "43000"],
                "max_disbursement" => 10.0,
                "max_amount" => 66000.0
            ], true);
        return view('admin.dashboard', $data);
    }

    /**
     * Get Teleco Providers DataTable
     *
     * @return \Illuminate\Http\Response
     */

}
