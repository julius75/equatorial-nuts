<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MpesaDisbursementResponse;
use App\Models\MpesaDisbursementTransaction;
use App\Models\Order;
use App\Models\RawMaterial;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;

class MpesaTransactionController extends Controller
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
        $data['regions'] = Region::all();
        $data['raw_materials'] = RawMaterial::all();
        return view('admin.mpesa_transactions.index', $data);
    }

    /**
     * Get Regions Orders
     *
     * @param Request $request
     * @param string $encryptedId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function get_mpesa_transactions(Request $request)
    {
        //region_id specified rest are "all"
        if ($request->region_id != "all" and $request->raw_material_id == "all"){
            $data = MpesaDisbursementTransaction::query()
                ->whereHas('order.order_region', function ($q) use ($request){
                    $q->where('region_id', '=', $request->region_id);
                })
                ->with(['order'])
                ->get();
        }
        //raw material specified rest are "all"
        elseif ($request->raw_material_id != "all" and $request->region_id == "all"){
            $data = MpesaDisbursementTransaction::query()
                ->whereHas('order.order_raw_material', function ($q) use ($request){
                    $q->where('raw_material_id', '=', $request->raw_material_id);
                })
                ->with(['order'])
                ->get();
        }
        //region and raw material specified
        elseif ($request->buying_center_id != "all" and $request->raw_material_id != "all"){
            $data = MpesaDisbursementTransaction::query()
                ->whereHas('order.order_region', function ($q) use ($request){
                    $q->where('region_id', '=', $request->region_id);
                })
                ->whereHas('order.order_raw_material', function ($q) use ($request){
                    $q->where('raw_material_id', '=', $request->raw_material_id);
                })
                ->with(['order'])
                ->get();
        }
        else{
            $data = MpesaDisbursementTransaction::query()
                ->with(['order'])
                ->get();
        }
        return Datatables::of($data)
            ->addColumn('order_ref', function ($data) {
                return '<a href="'.route('admin.orders.show', $data->order->ref_number).'" class="text-success font-weight-boldest text-uppercase">
                            '.$data->order->ref_number.'
                        </a>
						';
            })
            ->addColumn('mpesa_recipient', function ($data) {
                return MpesaDisbursementResponse::query()
                    ->where('TransactionID', '=', $data->transaction_receipt)
                    ->first()
                    ->B2CRecipientIsRegisteredCustomer;
            })
            ->make(true);
    }
}
