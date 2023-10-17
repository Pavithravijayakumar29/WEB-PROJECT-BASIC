<?php
namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Entry\SalesOrderD2SMain;
use App\Models\Entry\SalesOrderD2Ssub;
use App\Models\Entry\SalesOrderStockMain;
use App\Models\Entry\SalesOrderStockSub;
use App\Models\MarketCreation;
use App\Models\DealerCreation;
use App\Models\ItemCreation;
use App\Models\ItemLitersType;
use App\Models\ItemPropertiesType;
use App\Models\ShopsType;
use App\Models\ShopCreation;
use App\Models\SalesRepCreation;
use App\Models\Entry\VisitorCreation;
use Carbon\Carbon;
use App\Models\MarketManagerCreation;
use App\Models\GroupCreation;
use PhpParser\Node\Stmt\Return_;

class EffectiveCalls extends Controller
{
    public function effective_calls_Report()
    {
        $order_no_list = SalesOrderD2SMain::select('sales_exec')->where(function ($query) {
            $query->where('delete_status', '0')->orWhereNull('delete_status');
        })->get();
        $market_creation = MarketCreation::select('id', 'area_name')->where(function ($query) {
            $query->where('delete_status', '0')->orWhereNull('delete_status');
        })->orderBy('area_name')->get();
        $dealer_creation = DealerCreation::select('id', 'dealer_name')->where(function ($query) {
            $query->where('delete_status', '0')->orWhereNull('delete_status');
        })->orderBy('dealer_name')->get();
        $shop_creation = ShopsType::select('id', 'shops_type')->where(function ($query) {
            $query->where('delete_status', '0')->orWhereNull('delete_status');
        })->orderBy('shops_type')->get();

        $sales_name = SalesRepCreation::select('id', 'sales_ref_name')->where(function ($query) {
            $query->where('delete_status', '0')->orWhereNull('delete_status');
        })->orderBy('sales_ref_name')->get();

        $item_namess = ItemCreation::select('id', 'item_name')->where(function ($query) {
            $query->where('delete_status', '0')->orWhereNull('delete_status');
        })->orderBy('item_name')->get();

        $manager_names = MarketManagerCreation::select('id', 'manager_name')->where(function ($query) {
            $query->where('delete_status', '0')->orWhereNull('delete_status');
        })->orderBy('manager_name')->get();

        $group_creation = GroupCreation::select('id', 'group_name')
        ->where(function ($query) {
            $query->where('delete_status', '0')->orWhereNull('delete_status');
        })->orderBy('group_name')
        ->get();

        return view('Reports.effective_calls_Report.admin', ['order_no_list' => $order_no_list, 'market_creation' => $market_creation, 'dealer_creation' => $dealer_creation, 'shop_creation' => $shop_creation, "sales_name" => $sales_name,'item_namess' =>$item_namess,'manager_names'=>$manager_names, 'group_creation'=>$group_creation]);
    }
    public function retrieve($from_date_1, $to_date_1, $sales_exec, $dealer_creation_id_1, $manager_na, $order_shop, $item_name_1, $group_id)
    {
        $query = DB::table('sales_order_d2s_main AS main_table')
            ->leftJoin('area_creation', 'area_creation.id', '=', 'main_table.market_creation_id')
            ->leftJoin('sales_ref_creation', 'sales_ref_creation.id', '=', 'main_table.sales_exec')
            ->leftJoin('dealer_creation', 'dealer_creation.id', '=', 'main_table.dealer_creation_id')
            ->leftJoin('sales_order_d2s_sublist AS sublist', 'sublist.sales_order_main_id', '=', 'main_table.id')
            ->leftJoin('shop_creation', 'shop_creation.id', '=', 'sublist.shop_creation_id')
            ->leftJoin('item_creation AS short_code', 'short_code.id', '=', 'sublist.short_code_id')
            ->leftJoin('item_creation', 'item_creation.id', '=', 'sublist.item_creation_id')
            ->leftJoin('market_manager_creation', function ($join) {
                $join->on('market_manager_creation.id', '=', 'dealer_creation.manager_name')
                    ->on('dealer_creation.sales_rep_id', '=', 'main_table.sales_exec');
            })
            ->select([
                'main_table.order_date',
                DB::raw('GROUP_CONCAT(DISTINCT area_creation.area_name) AS area_name'),
                DB::raw('GROUP_CONCAT(DISTINCT sales_ref_creation.sales_ref_name) AS sales_ref_name'),
                DB::raw('GROUP_CONCAT(DISTINCT dealer_creation.dealer_name) AS dealer_name'),
                DB::raw('MAX(short_code.id) AS short_code'),
                DB::raw('SUM(CASE WHEN sublist.status_check = "Yes" THEN 1 ELSE 0 END) AS status_check_count_1'),
                DB::raw('COUNT(sublist.status_check) AS status_check_count'),
                DB::raw('COUNT(short_code.short_code) AS short_name_code'),
                DB::raw('MAX(market_manager_creation.manager_name) AS manager_name'),
                DB::raw('MAX(item_creation.item_name) AS item_name'),
                DB::raw('MAX(short_code.short_code) AS short_code_2'),
                DB::raw('SUM(sublist.order_quantity) AS order_1'),
            ]);

        if (!empty($from_date_1)) {
            $query->where('main_table.order_date', '>=', $from_date_1);
        }
        if (!empty($to_date_1)) {
            $query->where('main_table.order_date', '<=', $to_date_1);
        }
        if (!empty($sales_exec)) {
            $query->where('main_table.sales_exec', '=', $sales_exec);
        }

        if (!empty($dealer_creation_id_1)) {
            $query->where('main_table.dealer_creation_id', '=', $dealer_creation_id_1);
        }

        if (!empty($item_name_1)) {
            $query->where('sublist.item_creation_id', '=', $item_name_1);
        }

        if (!empty($group_id)) {
            $query->where('short_code.group_id', '=', $group_id);
        }

        if ($order_shop === "1") {
            $query->where('sublist.status_check', '=', 'Yes');
        } elseif ($order_shop === "0") {
            $query->where('sublist.status_check', '=', 'No');
        }

        // Adding deletion status checks
        $query->where(function ($query) {
            $query->where('main_table.delete_status', '0')
                ->orWhereNull('main_table.delete_status');
        });

        $query->groupBy(
            'main_table.order_date',
            'area_creation.area_name',
            'dealer_creation.dealer_name',
            'short_code.id'
        );

        $query->orderBy('main_table.order_date');
        $results = $query->get();

        $resultsArray = $results->toArray();

        return $resultsArray;
    }
    public function db_cmd(Request $request)
    {
        $action = $request->input('action');
      if ($action == 'retrieve') {
        // $item_creation_short = DB::table('item_creation')
        // ->select('item_creation.id', 'item_creation.short_code', 'item_liters_type.item_liters_type','group_creation.group_name')
        // ->leftJoin('item_liters_type', 'item_creation.item_liters_type', '=', 'item_liters_type.id')
        // ->join('group_creation', 'group_creation.id', '=', 'item_creation.group_id')
        // ->where(function ($query) {
        //     $query->where('item_creation.delete_status', '0')
        //         ->orWhereNull('item_creation.delete_status');
        // })
        // ->orderBy('item_creation.short_code')
        // ->get();


        $item_creation_ids = SalesOrderD2Ssub::all()->pluck('item_creation_id')->unique();

        $item_creation_short = [];

        foreach ($item_creation_ids as $item_creation_id) {
            $itemCreation = ItemCreation::where('id', $item_creation_id)->first();

            if ($itemCreation) {
                $group_id = $itemCreation->group_id;
                $groupCreation = GroupCreation::where('id', $group_id)->first();

                if ($groupCreation) {
                    $item_creation_short[] = [
                        'short_code' => $itemCreation->short_code,
                        'group_name' => $groupCreation->group_name,
                    ];
                }
            }
        }

        $item_create = SalesOrderD2Ssub::select('id', 'item_creation_id')->where(function ($query) {
            $query->where('delete_status', '0')->orWhereNull('delete_status');
        })->orderBy('item_creation_id')->get();
        // $itemCreationShortCount = $item_creation_short->count();

            $sales_order_d2s_main = $this->retrieve(
                $request->input('from_date_1'),
                $request->input('to_date_1'),
                $request->input('sales_exec'),
                $request->input('dealer_creation_id_1'),
                $request->input('sales_exec_123'),
                $request->input('order_shop'),
                $request->input('item_name_1'),
                $request->input('group_id'),

            );

            $sales_exec1 = $request->input('sales_exec');
            $sales_rep_name = SalesRepCreation::find($sales_exec1);
            if($sales_exec1!=''){
            $rep_name = $sales_rep_name->sales_ref_name;
            }else{
                $rep_name = $sales_exec1;
            }

            $dealer1 =  $request->input('dealer_creation_id_1');
            $dealer_id = DealerCreation::find($dealer1);
            if($dealer1!=''){
                $dea_name = $dealer_id->dealer_name;
                }else{
                    $dea_name = $dealer1;
                }

                $manager2 =  $request->input('sales_exec_123');
                $manager_id = MarketManagerCreation::find($manager2);
                if($manager2!=''){
                    $mana_name = $manager_id->manager_name;
                    }else{
                        $mana_name = $manager2;
                    }


                    $item_1 =  $request->input('item_name_1');
                    $item__id_1 = ItemCreation::find($item_1);
                    if($item_1!=''){
                        $item_nam = $item__id_1->item_name;
                        }else{
                            $item_nam = $item_1;
                        }


                    $grp =  $request->input('group_id');
                    $group_id_1 = GroupCreation::find($grp);
                    if($grp!=''){
                        $grp_nam = $group_id_1->group_name;
                        }else{
                            $grp_nam = $grp;
                        }

                        //  return $sales_order_d2s_main;

            return view('Reports.effective_calls_Report.list', [
                'item_creation_short' =>$item_creation_short,
                'sales_order_d2s_main' => $sales_order_d2s_main,
                // 'itemCreationShortCount' => $itemCreationShortCount,
                'item_create'=> $item_create,
                'rep_name' =>$rep_name,
                'dea_name' =>$dea_name,
                'mana_name' =>$mana_name,
                'item_nam' =>$item_nam,
                'grp_nam' =>$grp_nam,
                'user_rights_edit_1' => $request->input('user_rights_edit_1'),
                'user_rights_delete_1' => $request->input('user_rights_delete_1')
            ]);
        }
        else if ($action == 'getsalesexec') {

            $manag = $request->input('manager_na');

            $dealer_name = SalesRepCreation::select('id', 'sales_ref_name')
            ->where('manager_id', $manag)
            ->get();

            return response()->json($dealer_name);
        }
         else if ($action == 'getdearlername') {

            $sales_exec = $request->input('sales_exec');

            $dealer_name = DealerCreation::select('id', 'dealer_name')
            ->where('sales_rep_id', $sales_exec)
            ->get();

            return response()->json($dealer_name);
        }
        else if ($action == 'getitemname') {

            $group_id = $request->input('group_id');

             $item_name = ItemCreation::select('id', 'item_name')
             ->where(function ($query) {
                $query->where('delete_status', '0')->orWhereNull('delete_status');
            })->orderBy('item_name')
            ->where('group_id', '=', $group_id)
            ->get();

            return response()->json($item_name);
        }
    }
}
