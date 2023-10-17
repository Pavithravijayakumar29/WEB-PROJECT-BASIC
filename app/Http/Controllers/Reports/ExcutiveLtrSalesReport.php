<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SalesRepCreation;
use App\Models\MarketCreation;
use App\Models\DealerCreation;
use Illuminate\Support\Facades\DB;
use App\Models\Entry\SalesOrderD2SMain;
use App\Models\Entry\SalesOrderD2Ssub;
use App\Models\Entry\AttendanceEntry;
use App\Models\MarketManagerCreation;
class ExcutiveLtrSalesReport extends Controller
{
    public function excutive_report()
    {
        $sales_rep_name = SalesRepCreation::select('id', 'sales_ref_name')
        ->where('delete_status', '!=', '1')
        ->orderBy('sales_ref_name')
        ->get();

        $market_creation = DealerCreation::select('id', 'dealer_name')
        ->where(function ($query) {
            $query->where('delete_status', '0')->orWhereNull('delete_status');
        })
                ->orderBy('dealer_name')
                ->get();

                $manager_names = MarketManagerCreation::select('id', 'manager_name')->where(function ($query) {
                    $query->where('delete_status', '0')->orWhereNull('delete_status');
                })->orderBy('manager_name')->get();


        return view('Reports.Executive_Daily_Ltrs_Sales_Report.admin',[
            'sales_rep_name' => $sales_rep_name,
            'market_creation'=>$market_creation,'manager_names'=>$manager_names

        ]);
    }
        public function db_cmd(Request $request)
        {
        $action = $request->input('action');
        if ($action == 'view') {
            $from_date = $request->input('from_date');
            $area_id = $request->input('area_id');
            $executive_id = $request->input('excutive_id');
            $manager_na = $request->input('manager_na');

            $query = DB::table('area_creation')
            ->join('sales_order_d2s_main', 'sales_order_d2s_main.market_creation_id', '=', 'area_creation.id')
            ->join('sales_ref_creation', 'sales_order_d2s_main.sales_exec', '=', 'sales_ref_creation.id')
            ->join('sales_order_d2s_sublist', 'sales_order_d2s_sublist.sales_order_main_id', '=', 'sales_order_d2s_main.id')
            ->join('dealer_creation', 'dealer_creation.id', '=', 'sales_order_d2s_main.dealer_creation_id')
            ->leftJoin('market_manager_creation', 'market_manager_creation.id', '=', 'dealer_creation.manager_name')
            ->select(
                'area_creation.area_name',
                'sales_ref_creation.sales_ref_name',
                'sales_order_d2s_sublist.order_date_sub',
                'dealer_creation.dealer_name',
                DB::raw('MAX(sales_order_d2s_main.sales_exec) as sales_exec'),
                DB::raw('SUM(sales_order_d2s_sublist.order_quantity) as total_quantity'),
                'market_manager_creation.manager_name'
            )
            ->groupBy('area_creation.area_name', 'sales_order_d2s_sublist.order_date_sub', 'sales_ref_creation.sales_ref_name', 'dealer_creation.dealer_name', 'market_manager_creation.manager_name');



            if (!empty($from_date)) {
                $query->where(DB::raw('DATE_FORMAT(sales_order_d2s_sublist.order_date_sub, "%Y-%m")'), '=',$from_date );
            }

            if (!empty($executive_id)) {
                $query->where('sales_order_d2s_main.sales_exec', $executive_id);
            }

            if (!empty($area_id)) {
                $query->where('dealer_creation.id', $area_id);
            }
            if (!empty($manager_na)) {
                $query->where('market_manager_creation.id', $manager_na);
            }
            $results = $query->limit(25)->get();

            if (empty($from_date)) {
                $currentDay = date('d');
                $currentMonth = date('m');
                $currentYear = date('Y');
                $from_date = $currentYear . '-' . $currentMonth . '-'.$currentDay;

            }

            $attendance = AttendanceEntry::select('id', 'manager_name', 'attendance_status', 'category_type','entry_date')
                ->where(function ($query) {
                    $query->where('delete_status', '0')->orWhereNull('delete_status');
                })
                ->orderBy('entry_date')
                ->get();

            $pairs = [];

            foreach ($attendance as $attendance1) {
                $type = $attendance1['category_type'];
                $date = $attendance1['entry_date'];
                if ($type == 1) {
                    $a = explode(',', $attendance1['manager_name']);
                    $b = explode(',', $attendance1['attendance_status']);

                    for ($i = 0; $i < count($a); $i++) {
                        $sales_rep_id = $a[$i];
                        $attendance_status = ($b[$i] == '1') ? 'Present' : 'Absent';

                        $pair = [
                            'sales_rep_id' => $sales_rep_id,
                            'attendance_status' => $attendance_status,
                            'date' => $date,
                        ];

                        $pairs[] = $pair;
                    }
                }
            }

            $sales_exec1 = $request->input('executive_id');
            $sales_rep_name = SalesRepCreation::find($sales_exec1);
            if($sales_exec1!=''){
            $rep_name = $sales_rep_name->sales_ref_name;
            }else{
                $rep_name = $sales_exec1;
            }

            $dealer1 =  $request->input('area_id');
            $dealer_id = DealerCreation::find($dealer1);
            if($dealer1!=''){
                $dea_name = $dealer_id->dealer_name;
                }else{
                    $dea_name = $dealer1;
                }

            $manager2 =  $request->input('manager_na');
            $manager_id = MarketManagerCreation::find($manager2);
            if($manager2!=''){
                $mana_name = $manager_id->manager_name;
                }else{
                    $mana_name = $manager2;
                }
                //  return $results;
            return view('Reports.Executive_Daily_Ltrs_Sales_Report.list', [
                'from_date' => $from_date,
                'results' => $results,
                'pairs' => $pairs,
                'rep_name' =>$rep_name,
                'dea_name' =>$dea_name,
                'mana_name' =>$mana_name,
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
    }

}
