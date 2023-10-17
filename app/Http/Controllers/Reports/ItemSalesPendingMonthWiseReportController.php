<?php

namespace App\Http\Controllers\Reports;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Entry\SalesOrderDeliveryMain;
use App\Models\Entry\SalesOrderDeliverySub;
use App\Models\SalesRepCreation;
use App\Models\ItemCreation;
use App\Models\MarketManagerCreation;
use App\Models\GroupCreation;
use Carbon\Carbon;
class ItemSalesPendingMonthWiseReportController extends Controller
{
    public function item_sales_pending_month_wise_report()
    {
        $sales_rep_creation = SalesRepCreation::select('id', 'sales_ref_name')
        ->where('sales_ref_name', '!=', '')
        ->orderBy('sales_ref_name')
        ->get();

        $item_creation = ItemCreation::select('id', 'item_name')->where(function ($query) {
            $query->where('delete_status', '0')->orWhereNull('delete_status');
        })->orderBy('id')->get();

        $manager_creation=MarketManagerCreation::select('id','manager_name')->where('delete_status', '0')->orWhereNull('delete_status')->orderBy('manager_no')->get();

        $group_creation = GroupCreation::select('id', 'group_name')
        ->where(function ($query) {
            $query->where('delete_status', '0')->orWhereNull('delete_status');
        })->orderBy('group_name')
        ->get();

        return view('Reports.item_sales_pending_month_wise_report.admin',[
        'sales_rep_creation'=>$sales_rep_creation, 'group_creation'=>$group_creation, 'manager_creation'=>$manager_creation,
        'item_creation'=>$item_creation
        ]);
    }
    public function retrieve($from_date, $to_date, $sales_ref_id, $item_id, $manager_id, $group_id)
    {
        if (empty($from_date)) {
            $currentDay = date('d');
            $currentMonth = date('m');
            $currentYear = date('Y');
            $from_date = $currentYear . '-' . $currentMonth . '-'.$currentDay;
        }

        $sales_order_deli = DB::table('sales_order_delivery_sublist_c as sods')
            ->leftJoin('sales_order_delivery_main_c as sodm', 'sods.sales_order_main_id', '=', 'sodm.id')
            ->leftJoin('item_creation as ic', 'sods.item_creation_id', '=', 'ic.id')
            ->leftJoin('sales_ref_creation as src', 'src.id', '=', 'sodm.sales_exec')
            ->leftJoin('market_manager_creation as mmc', 'mmc.id', '=', 'src.manager_id')
            ->groupBy('sodm.sales_exec', 'ic.id')
            ->orderBy('sodm.sales_exec')
            ->orderBy('ic.id')
            ->select('sodm.sales_exec', 'ic.id as item_id', DB::raw('SUM(sods.order_quantity) as total_order_quantity'), DB::raw('SUM(sods.balance_quantity) as total_balance_quantity'));

        if (!empty($from_date)) {
            $sales_order_deli->where('sodm.entry_date', '>=', $from_date);
        }

        if (!empty($to_date)) {
            $sales_order_deli->where('sodm.entry_date', '<=', $to_date);
        }

        if (!empty($sales_ref_id)) {
            $sales_order_deli->where('sodm.sales_exec', '=', $sales_ref_id);
        }

        if (!empty($item_id)) {
            $sales_order_deli->where('sods.item_creation_id', '=', $item_id);
        }

        if (!empty($manager_id)) {
            $sales_order_deli->where('src.manager_id', '=', $manager_id);
        }

        if (!empty($group_id)) {
            $sales_order_deli->where('ic.group_id', '=', $group_id);
        }

        $sales_order_deli->where(function ($query) {
            $query->where('sodm.delete_status', '0')->orWhereNull('sodm.delete_status');
        });

        $sales_order_deli1 = $sales_order_deli->get();

        return $sales_order_deli1;
    }

    public function retrieve1($sales_ref_id,$salesExecArray,$manager_id)
{

        $sales_name = SalesRepCreation::select('id', 'sales_ref_name')->where(function ($query) use ($salesExecArray) {
            $query->whereIn('id', $salesExecArray)
                ->orWhereNull('delete_status', '0')
                ->orWhereNull('delete_status');
        })->orderBy('sales_ref_name');

        if (!empty($manager_id)) {
            $sales_name->where('manager_id', '=', $manager_id);
        }

        if (!empty($sales_ref_id)) {
            $sales_name->where('id', '=', $sales_ref_id);
        }

        $sales_name1 = $sales_name->get();

        return $sales_name1;

}

public function retrieve2($item_id)
{

            $item_name=ItemCreation::select('item_creation.id','item_creation.item_name','item_creation.short_code','group_creation.group_name')
            ->join('group_creation', 'group_creation.id', '=', 'item_creation.group_id')
            ->where(function($query){
                $query->where('item_creation.delete_status', '0')->orWhereNull('item_creation.delete_status');
            })
            ->orderBy('item_creation.id');
            if (!empty($item_id)) {
                $item_name->where('item_creation.id', '=', $item_id);
            }
            $item_name1 = $item_name->get();

           return $item_name1;

}


public function retrieve3($from_date, $to_date, $sales_ref_id, $item_id, $manager_id)
    {
        if (empty($from_date)) {
            $currentDay = date('d');
            $currentMonth = date('m');
            $currentYear = date('Y');
            $from_date = $currentYear . '-' . $currentMonth . '-'.$currentDay;

        }

            $sales_order_deli_t = DB::table('sales_order_delivery_sublist_c as sods')
            ->leftJoin('sales_order_delivery_main_c as sodm', 'sods.sales_order_main_id', '=', 'sodm.id')
            ->leftJoin('item_creation as ic', 'sods.item_creation_id', '=', 'ic.id')
            ->leftJoin('sales_ref_creation as src', 'src.id', '=', 'sodm.sales_exec')
            ->leftJoin('market_manager_creation as mmc', 'mmc.id', '=', 'src.manager_id')
            ->groupBy('ic.id')

            ->orderBy('ic.id')
            ->select('ic.id as item_id',DB::raw('SUM(sods.order_quantity) as total_order_quantity'), DB::raw('SUM(sods.balance_quantity) as total_balance_quantity'));


        if (!empty($from_date)) {
            $sales_order_deli_t->where('sodm.entry_date', '>=', $from_date);
        }

        if (!empty($to_date)) {
            $sales_order_deli_t->where('sodm.entry_date', '<=', $to_date);
        }

        if (!empty($sales_ref_id)) {
            $sales_order_deli_t->where('sodm.sales_exec', '=', $sales_ref_id);
        }

        if (!empty($item_id)) {
            $sales_order_deli_t->where('sods.item_creation_id', '=', $item_id);
        }

        if (!empty($manager_id)) {
            $sales_order_deli_t->where('src.manager_id', '=', $manager_id);
        }

        $sales_order_deli_t->where(function ($query) {
            $query->where('sodm.delete_status', '0')->orWhereNull('sodm.delete_status');
        });

        $sales_order_deli_t1 = $sales_order_deli_t->get();
      return $sales_order_deli_t1;

    }


    public function db_cmd(Request $request)
    {
        $action=$request->input('action');
        if($action=='retrieve')
        {

            $item_sales_pending_month_wise_report = $this->retrieve($request->input('from_date'),$request->input('to_date'),$request->input('sales_ref_id'),$request->input('item_id'),$request->input('manager_id'),$request->input('group_id'));
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


    $salesExecs = DB::table('sales_order_delivery_main_c')
    ->select('sales_exec')
    ->groupBy('sales_exec');
    if (!empty($from_date)) {
        $salesExecs->where('entry_date', '>=', $from_date);
    }

    if (!empty($to_date)) {
        $salesExecs->where('entry_date', '<=', $to_date);
    }
    $salesExecs1 = $salesExecs->get();

   $salesExecArray = $salesExecs1->pluck('sales_exec')->toArray();
            $sales_rep_creation = $this->retrieve1($request->input('sales_ref_id'),$salesExecArray,$request->input('manager_id'));

            $item_creation = $this->retrieve2($request->input('item_id'));

            $item_sales_total = $this->retrieve3($request->input('from_date'),$request->input('to_date'),$request->input('sales_ref_id'),$request->input('item_id'),$request->input('manager_id'));

        if (empty($from_date)) {
            $currentDay = date('d');
            $currentMonth = date('m');
            $currentYear = date('Y');
            $from_date = $currentYear . '-' . $currentMonth . '-'.$currentDay;

        }


        $group_creation = GroupCreation::select('id', 'group_name')
        ->where(function ($query) {
            $query->where('delete_status', '0')->orWhereNull('delete_status');
        })->orderBy('group_name')
        ->get();

            return view('Reports.item_sales_pending_month_wise_report.list',['item_creation' => $item_creation,'sales_order_deli' => $item_sales_pending_month_wise_report, 'sales_rep_creation' => $sales_rep_creation, 'group_creation' => $group_creation, 'from_date' => $from_date, 'item_sales_total' => $item_sales_total,'salesExecArray' => $salesExecArray
            ]);
        }else if ($action == 'getSalesRef') {


            $manager_id= $request->input('manager_id');

            $sales_ref_name = SalesRepCreation::select('id', 'sales_ref_name')->where('manager_id', $manager_id)->where(function ($query) {
                $query->where('delete_status', '0')->orWhereNull('delete_status');
            })->orderBy('sales_ref_name')->get();
            return response()->json($sales_ref_name);
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
