<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\SalesRepCreation;
use App\Models\DealerCreation;
use App\Models\MarketCreation;
use App\Models\ItemCreation;
use App\Models\DistrictCreation;
use App\Models\MarketManagerCreation;
use App\Models\GroupCreation;
use Carbon\Carbon;

class SalesBoxReportController extends Controller
{
    public function sales_box_report()
    {
        $sales_rep_creation = SalesRepCreation::select('id', 'sales_ref_name')
            ->where('sales_ref_name', '!=', '')
            ->orderBy('sales_ref_name')
            ->get();

        $district_name = DistrictCreation::select('id', 'district_name')->where('district_name', '!=', '')->orderBy('district_name')->get();

        $item_creation = ItemCreation::select('id', 'item_name')
            ->where('item_name', '!=', '')
            ->orderBy('item_name')
            ->get();


        $group_creation = GroupCreation::select('id', 'group_name')
        ->where(function ($query) {
            $query->where('delete_status', '0')->orWhereNull('delete_status');
        }) ->orderBy('group_name')
            ->get();

        $dealer_name = DealerCreation::select('id', 'dealer_name')->where(function ($query) {
            $query->where('delete_status', '0')->orWhereNull('delete_status');
        })->orderBy('dealer_name')->get();

        $area_name = MarketCreation::select('id', 'area_name')->where(function ($query) {
            $query->where('delete_status', '0')->orWhereNull('delete_status');
        })->orderBy('area_name')->get();

        $manager_creation=MarketManagerCreation::select('id','manager_name')->where('delete_status', '0')->orWhereNull('delete_status')->orderBy('manager_no')->get();


        return view('Reports.sales_box_report.admin', [
            'sales_rep_creation' => $sales_rep_creation,
            'item_creation' => $item_creation,
            'dealer_creation' => $dealer_name,
            'market_creation' => $area_name,
            'district_name' => $district_name,
            'manager_creation' => $manager_creation,
            'group_creation'=>$group_creation,


        ]);
    }
    public function retrieve_sales_box($from_date, $sales_ref_id, $dealer_id, $item_id, $manager_id,$group_id)
    {

            $sales_box1 = DB::table('sales_order_d2s_main as sodsm')
                ->leftJoin('area_creation as ac', 'sodsm.market_creation_id', '=', 'ac.id')
                ->leftJoin('dealer_creation as dc', 'dc.id', '=', 'sodsm.dealer_creation_id')
                ->leftJoin('sales_order_d2s_sublist as sodss', 'sodss.sales_order_main_id', '=', 'sodsm.id')
                ->leftJoin('sales_ref_creation as src', 'src.id', '=', 'sodsm.sales_exec')
                ->leftJoin('market_manager_creation as mmc', 'mmc.id', '=', 'src.manager_id')
                ->leftJoin('item_creation as ic', 'ic.id', '=', 'sodss.item_creation_id')
                ->groupBy('ac.area_name', 'dc.id', 'sodsm.market_creation_id', 'sodss.item_creation_id', 'ic.item_name')
                ->select(
                    'ac.area_name',
                    'dc.id as dealer_id',
                    'sodsm.market_creation_id as market_id',
                    'sodss.item_creation_id as item_id',
                    DB::raw('SUM(sodss.order_quantity) as total_order_quantity'),
                    DB::raw('COUNT(sodss.status_check) as total_status_check'),
                    DB::raw('SUM(sodss.current_stock) as total_current_stock'),
                    'ic.item_name'
                );

                if (empty($from_date)) {
                    $currentDay = date('d');
                    $currentMonth = date('m');
                    $currentYear = date('Y');
                    $from_date = $currentYear . '-' . $currentMonth . '-' . $currentDay;

                    // Assuming $currentDay1 is defined somewhere

                }




            if (!empty($from_date)) {
                $year = date('Y', strtotime($from_date));
                $month = date('m', strtotime($from_date));

                $sales_box1->whereYear('sodss.order_date_sub', $year)
                    ->whereMonth('sodss.order_date_sub', $month);
            }

            if (!empty($sales_ref_id)) {
                $sales_box1->where('sodsm.sales_exec', '=', $sales_ref_id);
            }

            if (!empty($dealer_id)) {
                $sales_box1->where('sodsm.dealer_creation_id', '=', $dealer_id);
            }
            if (!empty($item_id)) {
                $sales_box1->where('sodss.item_creation_id', '=', $item_id);
            }
            if (!empty($manager_id)) {
                $sales_box1->where('src.manager_id', '=', $manager_id);
            }
            if (!empty($group_id)) {
                $sales_box1->where('ic.group_id', '=', $group_id);
            }
            $sales_box1->where(function ($query) {
                $query->where('sodss.delete_status', '0')->orWhereNull('sodss.delete_status');
            });
            $sales_box1->where(function ($query) {
                $query->where('sodsm.delete_status', '0')->orWhereNull('sodsm.delete_status');
            });


            $sales_box1->where('sodss.status_check', '=', "Yes");
            $sales_box = $sales_box1->get();



        return $sales_box;
        //return $sales_box_report;
    }

    public function retrieve_sales_ref($sales_ref_id)
    {
             $sales_name = SalesRepCreation::select('id', 'sales_ref_name')->where(function ($query) {
                $query->where('delete_status', '0')->orWhereNull('delete_status');
            })->orderBy('sales_ref_name');
            if (!empty($sales_ref_id)) {
                $sales_name->where('id', '=', $sales_ref_id);

            }
            $sales_name1 = $sales_name->get();

        return $sales_name1;
    }

    public function retrieve_item($item_id)
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



        return $item_name1;
    }

    public function retrieve_dealer($dealer_id)
    {
         $dealer_name1 = DealerCreation::select('id', 'dealer_name', 'area_id')->where(function ($query) {
                $query->where('delete_status', '0')->orWhereNull('delete_status');
            })->orderBy('dealer_name');


            if (!empty($dealer_id)) {
                $dealer_name1->where('id', $dealer_id);
            }


            $dealer_name = $dealer_name1->get();



        return $dealer_name;
    }

    public function retrieve_market($dealerCreationIdArray)
    {

        $areas = MarketCreation::select('area_creation.area_name', 'area_creation.id')
        ->leftJoin('dealer_creation as dc', 'area_creation.id', '=', 'dc.area_id')
        ->whereIn('dc.id', $dealerCreationIdArray)
        ->where(function ($query) {
            $query->whereNull('dc.delete_status')
                  ->orWhereNull('dc.delete_status');
        })
        ->get();


        return $areas;
    }

    public function retrieve_count($from_date,  $sales_ref_id, $dealer_id, $item_id,$manager_id)
    {


            $sales_box_count1 = DB::table('sales_order_d2s_main as sodsm')
                ->leftJoin('area_creation as ac', 'sodsm.market_creation_id', '=', 'ac.id')

                ->leftJoin('sales_order_d2s_sublist as sodss', 'sodss.sales_order_main_id', '=', 'sodsm.id')
                ->leftJoin('sales_ref_creation as src', 'src.id', '=', 'sodsm.sales_exec')
                ->leftJoin('market_manager_creation as mmc', 'mmc.id', '=', 'src.manager_id')


                ->groupBy('sodsm.market_creation_id')
                ->select(
                    'sodsm.market_creation_id as market_id',

                    DB::raw('COUNT(sodss.status_check) as total_status_count'),
                    DB::raw('SUM(sodss.order_quantity) as total_order_quantity')
                );
            if (!empty($from_date)) {
                $year = date('Y', strtotime($from_date));
                $month = date('m', strtotime($from_date));

                $sales_box_count1->whereYear('sodss.order_date_sub', $year)
                    ->whereMonth('sodss.order_date_sub', $month);
            }

            if (!empty($sales_ref_id)) {
                $sales_box_count1->where('sodsm.sales_exec', '=', $sales_ref_id);
            }

            if (!empty($dealer_id)) {
                $sales_box_count1->where('sodsm.dealer_creation_id', '=', $dealer_id);
            }
            if (!empty($item_id)) {
                $sales_box_count1->where('sodss.item_creation_id', '=', $item_id);
            }
            if (!empty($manager_id)) {
                $sales_box_count1->where('src.manager_id', '=', $manager_id);
            }
            $sales_box_count1->where(function ($query) {
                $query->where('sodss.delete_status', '0')->orWhereNull('sodss.delete_status');
            });
            $sales_box_count1->where(function ($query) {
                $query->where('sodsm.delete_status', '0')->orWhereNull('sodsm.delete_status');
            });

            $sales_box_count1->where('sodss.status_check', '=', "Yes");
            $sales_box_count = $sales_box_count1->get();



        return $sales_box_count;
        //return $sales_box_report;
    }

    public function retrieve_last_visit_date($from_date, $sales_ref_id, $dealer_id, $item_id)
    {


            $last_visit1 = DB::table('sales_order_d2s_main as sodsm')
                ->leftJoin('area_creation as ac', 'sodsm.market_creation_id', '=', 'ac.id')
                ->leftJoin('dealer_creation as dc', 'dc.id', '=', 'sodsm.dealer_creation_id')

                ->leftJoin('sales_order_d2s_sublist as sodss', 'sodss.sales_order_main_id', '=', 'sodsm.id')


                ->groupBy('sodsm.market_creation_id', 'sodss.entry_date', 'dc.id')
                ->select(
                    'sodss.entry_date',
                    'dc.id',
                    'sodsm.market_creation_id'
                )
                ->orderByDesc('sodss.entry_date');
            if (!empty($from_date)) {
                $year = date('Y', strtotime($from_date));
                $month = date('m', strtotime($from_date));

                $last_visit1->whereYear('sodss.order_date_sub', $year)
                    ->whereMonth('sodss.order_date_sub', $month);
            }

            if (!empty($sales_ref_id)) {
                $last_visit1->where('sodsm.sales_exec', '=', $sales_ref_id);
            }
            if (!empty($dealer_id)) {
                $last_visit1->where('sodsm.dealer_creation_id', '=', $dealer_id);
            }
            if (!empty($item_id)) {
                $last_visit1->where('sodss.item_creation_id', '=', $item_id);
            }
            $last_visit1->where(function ($query) {
                $query->where('sodss.delete_status', '0')->orWhereNull('sodss.delete_status');
            });
            $last_visit1->where(function ($query) {
                $query->where('sodsm.delete_status', '0')->orWhereNull('sodsm.delete_status');
            });

            $last_visit1->where('sodss.status_check', '=', "Yes");
            $last_visit = $last_visit1->limit(1)
                ->get();



        return $last_visit;
        //return $sales_box_report;
    }


    public function db_cmd(Request $request)
    {
        $action = $request->input('action');
        if ($action == 'retrieve') {
            $sales_box_report = $this->retrieve_sales_box($request->input('from_date'), $request->input('sales_ref_id'), $request->input('dealer_id'), $request->input('item_id'), $request->input('manager_id'), $request->input('group_id'));



            $sales_rep_creation = $this->retrieve_sales_ref($request->input('sales_ref_id'));

            $item_creation = $this->retrieve_item($request->input('item_id'));

            $dealer_creation = $this->retrieve_dealer($request->input('dealer_id'));





            if (empty($request->input('from_date'))) {
                $currentDay = date('d');
                $currentMonth = date('m');
                $currentYear = date('Y');
                $from_date = $currentYear . '-' . $currentMonth . '-' . $currentDay;

                // Assuming $currentDay1 is defined somewhere

            }


            if (empty($request->input('from_date'))) {
                $currentDay = date('d');
                $currentMonth = date('m');
                $currentYear = date('Y');
                $from_date = $currentYear . '-' . $currentMonth . '-' . $currentDay;

                // Assuming $currentDay1 is defined somewhere

            } else {
                $from_date = date('Y-m-d', strtotime($request->input('from_date')));

            }



    $salesExecs = DB::table('sales_order_d2s_main')
    ->select('dealer_creation_id')
    ->groupBy('dealer_creation_id');

    if (!empty($from_date)) {
        $year = date('Y', strtotime($from_date));
        $month = date('m', strtotime($from_date));

        $salesExecs->whereYear('order_date', $year)
            ->whereMonth('order_date', $month);
    }
    $sales_ref_id=$request->input('sales_ref_id');

    if (!empty($sales_ref_id)) {
        $salesExecs->where('sales_exec', '=', $sales_ref_id);
    }
    $dealer_id=$request->input('dealer_id');

    if (!empty($dealer_id)) {
        $salesExecs->where('dealer_creation_id', '=', $dealer_id);
    }

    $salesExecs1 = $salesExecs->get();

   $dealerCreationIdArray = $salesExecs1->pluck('dealer_creation_id')->toArray();

            $market_creation = $this->retrieve_market($dealerCreationIdArray);

            $sales_box_report_count = $this->retrieve_count($request->input('from_date'), $request->input('sales_ref_id'), $request->input('dealer_id'), $request->input('item_id'), $request->input('manager_id'));

            $retrieve_last_visit_date = $this->retrieve_last_visit_date($request->input('from_date'), $request->input('sales_ref_id'), $request->input('dealer_id'), $request->input('item_id'));

            if (empty($from_date)) {
                $currentDay = date('d');
                $currentMonth = date('m');
                $currentYear = date('Y');
                $from_date = $currentYear . '-' . $currentMonth . '-'.$currentDay;

            }
 //return $sales_box_report;
            return view('Reports.sales_box_report.list', [
                'item_creation' => $item_creation, 'sales_box_report' => $sales_box_report,'from_date' => $from_date, 'sales_box_report_count' => $sales_box_report_count, 'dealer_creation' => $dealer_creation, 'market_creation' => $market_creation, 'retrieve_last_visit_date' => $retrieve_last_visit_date,   'sales_rep_creation' => $sales_rep_creation
            ]);
        }  else if ($action == 'getSalesRef') {


            $manager_id= $request->input('manager_id');

            $sales_ref_name = SalesRepCreation::select('id', 'sales_ref_name')->where('manager_id', $manager_id)->where(function ($query) {
                $query->where('delete_status', '0')->orWhereNull('delete_status');
            })->orderBy('sales_ref_name')->get();
            return response()->json($sales_ref_name);
        }else if ($action == 'getMarketName') {

            $market_name = MarketCreation::select('id', 'area_name')->where(function ($query) {
                $query->where('delete_status', '0')->orWhereNull('delete_status');
            })->orderBy('area_name')->get();
            return response()->json($market_name);
        } else if ($action == 'getDealerName') {



            $sales_ref_id = $request->input('sales_ref_id');


            $market_name1 = DealerCreation::select('id', 'dealer_name')->where(function ($query) {
                $query->where('delete_status', '0')->orWhereNull('delete_status');
            })->orderBy('dealer_name');

            if (!empty($sales_ref_id)) {
                $market_name1->where('sales_rep_id', '=', $sales_ref_id);
            }


            $market_name = $market_name1->get();
            return response()->json($market_name);
        }

        else if ($action == 'getitemName') {
            $group_id = $request->input('group_id');
             $item_name1 = ItemCreation::select('id', 'item_name')->where(function ($query) {
                $query->where('delete_status', '0')->orWhereNull('delete_status');
            })->orderBy('item_name');

            if (!empty($group_id)) {
                $item_name1->where('group_id', '=', $group_id);
            }
            $item_name = $item_name1->get();
            return response()->json($item_name);
        }
    }
}
