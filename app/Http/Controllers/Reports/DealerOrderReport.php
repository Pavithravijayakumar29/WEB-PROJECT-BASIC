<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Entry\SalesOrderC2DMain;
use App\Models\Entry\SalesOrderC2DSub;
use App\Models\Entry\SalesOrderD2SMain;
use App\Models\Entry\SalesOrderD2Ssub;
use App\Models\SalesRepCreation;
use App\Models\DealerCreation;
use App\Models\ItemCreation;
use App\Models\GroupCreation;
use App\Models\ItemLitersType;
use App\Models\ShopCreation;
use App\Models\ItemPropertiesType;
use App\Models\MarketManagerCreation;

use Carbon\Carbon;

class DealerOrderReport extends Controller
{
    public function dealer_order_report()
    {

        // $salesRep=SalesRepCreation::select('id','sales_ref_name')->where(function($query){$query->where('delete_status', '0')->orWhereNull('delete_status');})->orderBy('sales_ref_name')->get();

        $manager_creation=MarketManagerCreation::select('id','manager_name')->where('delete_status', '0')->orWhereNull('delete_status')->orderBy('manager_no')->get();

        $dealer_creation=DealerCreation::select('id','dealer_name')->where(function($query){$query->where('delete_status', '0')->orWhereNull('delete_status');})->orderBy('dealer_name')->get();

        return view('Reports.dealer_orders_report.admin',[
            'manager_creation'=>$manager_creation,
            'dealer_creation'=>$dealer_creation

    ]);
    }



     public function db_cmd(Request $request)
    {
        $action=$request->input('action');

         if($action=='retrieve')
        {
            $from_date = $request->input('from_date');
            $to_date = $request->input('to_date');
            $dea_id = $request->input('dealer_id');
            $manager_id = $request->input('manager_id');
            $sales_ref_id = $request->input('sales_ref_id');

            $item_creation_ids = SalesOrderD2Ssub::all()->pluck('item_creation_id')->unique();

            $ItemCreation = [];

            foreach ($item_creation_ids as $item_creation_id) {
                $itemCreation = ItemCreation::where('id', $item_creation_id)->first();

                if ($itemCreation) {
                    $group_id = $itemCreation->group_id;
                    $groupCreation = GroupCreation::where('id', $group_id)->first();

                    if ($groupCreation) {
                        $ItemCreation[] = [
                            'short_code' => $itemCreation->short_code,
                            'group_name' => $groupCreation->group_name,
                        ];
                    }
                }
            }

            // return $ItemCreation;




            // $ItemCreation=ItemCreation::select('item_creation.id','item_creation.short_code','group_creation.group_name')
            // ->join('group_creation', 'group_creation.id', '=', 'item_creation.group_id')
            // ->where(function($query){
            //     $query->where('item_creation.delete_status', '0')->orWhereNull('item_creation.delete_status');
            // })
            // ->orderBy('item_creation.short_code')
            // ->get();

            $query = DB::table('sales_order_d2s_main as sodm')
                ->leftJoin('sales_order_d2s_sublist as sods', 'sodm.id', '=', 'sods.sales_order_main_id')
                ->leftJoin('dealer_creation as dc', 'dc.id', '=', 'sodm.dealer_creation_id')
                ->leftJoin('sales_ref_creation as src', 'src.id', '=', 'dc.sales_rep_id')
                ->leftJoin('market_manager_creation as mmc', 'mmc.id', '=', 'src.manager_id')
                ->leftJoin('shop_creation as sc', 'sc.id', '=', 'sods.shop_creation_id')
                ->leftJoin('item_creation as ic', 'ic.id', '=', 'sods.item_creation_id')
                ->leftJoin('area_creation as ac', 'ac.id', '=', 'sodm.market_creation_id')
                ->groupBy(
                    'mmc.manager_name',
                    'src.id',
                    'src.sales_ref_name',
                    'dc.id',
                    'dc.dealer_name',
                    'sods.item_creation_id',
                    'dc.dealer_name',
                    'sc.shop_name',
                    'sc.mobile_no',
                    'sc.whatsapp_no',
                    'sc.address',
                    'sods.order_date_sub',
                    'sods.item_creation_id',
                    'ic.short_code',
                    'ac.area_name'
                )
                ->select(
                    'mmc.manager_name',
                    'src.sales_ref_name',
                    'dc.dealer_name',
                    'sc.shop_name',
                    'sc.mobile_no',
                    'sc.whatsapp_no',
                    'sc.address',
                    'sods.order_date_sub',
                    'sods.item_creation_id',
                    DB::raw('SUM(sods.order_quantity) as total_order_quantity'),
                    'ic.short_code',
                    'ac.area_name'
                );


                if (empty(($request->input('from_date')))) {
                    $currentDay = date('d');
                    $currentMonth = date('m');
                    $currentYear = date('Y');
                    $from_date = $currentYear . '-' . $currentMonth . '-'.$currentDay;
                    $to_date = $currentYear . '-' . $currentMonth . '-'.$currentDay;

                }else{
                    $from_date =  $request->input('from_date');
                    $to_date =  $request->input('to_date');
                }

            if (!empty($from_date)) {
                $query->whereDate('sods.order_date_sub', '>=', $from_date);
            }

            if (!empty($to_date)) {
                $query->whereDate('sods.order_date_sub', '<=', $to_date);
            }

            if (!empty($dea_id)) {
                $query->where('sodm.dealer_creation_id', $dea_id);
            }
            if (!empty($sales_ref_id)) {
                $query->where('sodm.sales_exec', $sales_ref_id);
            }

            if (!empty($manager_id)) {
                $query->where('mmc.id', $manager_id);
            }

            $records = $query->get();
            if($from_date==''){
                $from_date = date('Y-m').'-'.'01';
            }
            if($to_date==''){
                $to_date = date('Y-m-t');
            }
// return $item_creation;
            return view('Reports.dealer_orders_report.list',[
            'ItemCreation' => $ItemCreation,
            'records' => $records,
            'from_date'=>$from_date,
            'to_date'=>$to_date,
            'user_rights_edit_1'=>$request->input('user_rights_edit_1'),'user_rights_delete_1'=>$request->input('user_rights_delete_1')]);
        } else if ($action == 'getSalesRef') {


            $manager_id= $request->input('manager_id');

            $sales_ref_name = SalesRepCreation::select('id', 'sales_ref_name')->where('manager_id', $manager_id)->where(function ($query) {
                $query->where('delete_status', '0')->orWhereNull('delete_status');
            })->orderBy('sales_ref_name')->get();
            return response()->json($sales_ref_name);
        }
        else if ($action == 'getDealer') {


            $sales_ref_id= $request->input('sales_ref_id');
            $manager_id= $request->input('manager_id');

            $dealer_creation=DealerCreation::select('id','dealer_name')->where('sales_rep_id', $sales_ref_id)->where('manager_name', $manager_id)->where(function($query){$query->where('delete_status', '0')->orWhereNull('delete_status');})->orderBy('dealer_name')->get();
            return response()->json($dealer_creation);
        }


    }
}
