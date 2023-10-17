<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DealerCreation;
use App\Models\SalesRepCreation;
use Illuminate\Support\Facades\DB;
use App\Models\MarketManagerCreation;
use App\Models\ItemCreation;
use App\Models\GroupCreation;

class DealersSalesReportController extends Controller
{
    public function dealer_sales_report()
    {

         $salesRep=SalesRepCreation::select('id','sales_ref_name')->where(function($query){$query->where('delete_status', '0')->orWhereNull('delete_status');})->orderBy('sales_ref_name')->get();

        $dealer_creation=DealerCreation::select('id','dealer_name')->where(function($query){$query->where('delete_status', '0')->orWhereNull('delete_status');})->orderBy('dealer_name')->get();

        $manager_names = MarketManagerCreation::select('id', 'manager_name')->where(function ($query) {
            $query->where('delete_status', '0')->orWhereNull('delete_status');
        })->orderBy('manager_name')->get();

        $group_creation = GroupCreation::select('id', 'group_name')
        ->where(function ($query) {
            $query->where('delete_status', '0')->orWhereNull('delete_status');
        }) ->orderBy('group_name')
            ->get();

            $item_creation = ItemCreation::select('id', 'item_name')
            ->where('item_name', '!=', '')
            ->orderBy('item_name')
            ->get();

        return view('Reports.dealer_sales_report.admin',[
            'dealer_creation'=>$dealer_creation,
            'group_creation'=>$group_creation,
            'item_creation'=>$item_creation,
            'salesRep'=>$salesRep,'manager_names'=>$manager_names

    ]);
    }
    public function db_cmd(Request $request)
    {
        $action=$request->input('action');

        if ($action == 'retrieve') {
            $from_date = $request->input('from_date');
            $to_date = $request->input('to_date');
            $rep_id = $request->input('rep_id');
            $dea_id = $request->input('dealer_id');
            $manager_na = $request->input('manager_na');
            $group_id = $request->input('group_id');
            $item_id = $request->input('item_id');

            if ($dea_id) {
                $dealer_name_main = DealerCreation::find($dea_id);
                $name_deal = $dealer_name_main->dealer_name;
                $adress = $dealer_name_main->address;
            }else{
                $name_deal = 'DEALER NAME AND';
                $adress = 'ADDRESS';
            }

//  Order Dispatch
        $dispatch = DB::table('sales_order_delivery_main_c as sodmc')
            ->leftJoin('sales_order_delivery_sublist_c as sodsc', 'sodmc.id', '=', 'sodsc.sales_order_main_id')
            ->leftJoin('item_creation as ic', 'ic.id', '=', 'sodsc.item_creation_id')
            ->select('sodsc.order_date_sub', DB::raw('SUM(sodsc.return_quantity) as total_quantity'))
            ->when($from_date, function ($query) use ($from_date) {
                return $query->where('sodsc.order_date_sub', '>=', $from_date);
            })
            ->when($to_date, function ($query) use ($to_date) {
                return $query->where('sodsc.order_date_sub', '<=', $to_date);
            })
            ->when($dea_id, function ($query) use ($dea_id) {
                return $query->where('sodmc.dealer_creation_id', $dea_id);
            })
            ->when($group_id, function ($query) use ($group_id) {
                return $query->where('ic.group_id', $group_id);
            })
            ->when($item_id, function ($query) use ($item_id) {
                return $query->where('sodsc.item_creation_id', $item_id);
            })
            ->groupBy('sodsc.order_date_sub')
            ->get();



            $datt = DB::table('sales_order_stock_main as sosm')
            ->leftJoin('dealer_creation as dc', 'dc.id', '=', 'sosm.dealer_creation_id')
            ->leftJoin('sales_ref_creation as srf', 'srf.id', '=', 'sosm.sales_exec')
            ->leftJoin('sales_order_stock_sublist as soss', 'soss.sales_order_main_id', '=', 'sosm.id')
            ->leftJoin('item_creation as ic', 'ic.id', '=', 'soss.item_creation_id')
            ->leftJoin('market_manager_creation', 'market_manager_creation.id', '=', 'sosm.sales_exec')
            ->select('soss.entry_date', 'market_manager_creation.manager_name')
            ->groupBy('soss.entry_date', 'market_manager_creation.manager_name')
            ->where(function ($query) {
                $query->where('sosm.delete_status', 0)
                      ->orWhereNull('sosm.delete_status');
            });

        if ($from_date) {
            $datt->whereDate('soss.entry_date', '>=', $from_date);
        }

        if ($to_date) {
            $datt->whereDate('soss.entry_date', '<=', $to_date);
        }

        if ($rep_id) {
            $datt->where('srf.id', $rep_id);
        }

        if ($dea_id) {
            $datt->where('dc.id', $dea_id);
        }

        if ($manager_na) {
            $datt->where('market_manager_creation.id', $manager_na);
        }
        if ($group_id) {
            $datt->where('ic.group_id', $group_id);
        }
        if ($item_id) {
            $datt->where('soss.item_creation_id', $item_id);
        }

        $result = $datt->get();

            $open = DB::table('sales_order_stock_main as sosm')
                ->leftJoin('dealer_creation as dc', 'dc.id', '=', 'sosm.dealer_creation_id')
                ->leftJoin('sales_ref_creation as srf', 'srf.id', '=', 'sosm.sales_exec')
                ->leftJoin('sales_order_stock_sublist as soss', 'soss.sales_order_main_id', '=', 'sosm.id')
                ->leftJoin('item_creation as ic', 'ic.id', '=', 'soss.item_creation_id')
                ->select('soss.entry_date as open_ent', DB::raw('SUM(soss.opening_stock) as total_opening_stock'))
                ->groupBy('soss.entry_date')
                ->where(function ($query) {
                    $query->where('sosm.delete_status', 0)
                          ->orWhereNull('sosm.delete_status');
                });


                if ($from_date) {
                    $open->whereDate('soss.entry_date', '>=', $from_date);
                }

                if ($to_date) {
                    $open->whereDate('soss.entry_date', '<=', $to_date);
                }

                if ($rep_id) {
                    $open->where('srf.id', $rep_id);
                }

                if ($dea_id) {
                    $open->where('dc.id', $dea_id);
                }
                if ($group_id) {
                    $open->where('ic.group_id', $group_id);
                }
                if ($item_id) {
                    $open->where('soss.item_creation_id', $item_id);
                }

                $open1 = $open->get();
                    $count = $open->count();

            $order = DB::table('sales_order_d2s_main as sodm')
                ->leftJoin('dealer_creation as dc', 'dc.id', '=', 'sodm.dealer_creation_id')
                ->leftJoin('sales_ref_creation as srf', 'srf.id', '=', 'sodm.sales_exec')
                ->leftJoin('sales_order_d2s_sublist as sods', 'sods.sales_order_main_id', '=', 'sodm.id')
                ->leftJoin('item_creation as ic', 'ic.id', '=', 'sods.item_creation_id')
                ->select('sods.entry_date', DB::raw('SUM(sods.order_quantity) as total_order_quantity'))
                ->groupBy('entry_date')
                ->where(function ($query) {
                    $query->where('sodm.delete_status', 0)
                          ->orWhereNull('sodm.delete_status');
                });

                if ($from_date) {
                    $order->whereDate('sods.entry_date', '>=', $from_date);
                }

                if ($to_date) {
                    $order->whereDate('sods.entry_date', '<=', $to_date);
                }

                if ($rep_id) {
                    $order->where('srf.id', $rep_id);
                }

                if ($dea_id) {
                    $order->where('dc.id', $dea_id);
                }
                if ($group_id) {
                    $order->where('ic.group_id', $group_id);
                }
                if ($item_id) {
                    $order->where('sods.item_creation_id', $item_id);
                }

                $order1 = $order->get();





            $order_finnal_tat = DB::table('sales_order_d2s_main as sodm')
                ->leftJoin('dealer_creation as dc', 'dc.id', '=', 'sodm.dealer_creation_id')
                ->leftJoin('sales_ref_creation as srf', 'srf.id', '=', 'sodm.sales_exec')
                ->leftJoin('sales_order_d2s_sublist as sods', 'sods.sales_order_main_id', '=', 'sodm.id')
                ->select( DB::raw('SUM(sods.order_quantity) as total_order_quantity'))
                ->where(function ($query) {
                    $query->where('sodm.delete_status', 0)
                          ->orWhereNull('sodm.delete_status');
                });

                if ($from_date) {
                    $order_finnal_tat->whereDate('sods.entry_date', '>=', $from_date);
                }

                if ($to_date) {
                    $order_finnal_tat->whereDate('sods.entry_date', '<=', $to_date);
                }

                if ($rep_id) {
                    $order_finnal_tat->where('srf.id', $rep_id);
                }

                if ($dea_id) {
                    $order_finnal_tat->where('dc.id', $dea_id);
                }

                $order_finnal_tatal = $order_finnal_tat->get();

                foreach($open1 as $open){
                    $open_value = $open->total_opening_stock;

                }

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


//    return $dispatch;
            return view('Reports.dealer_sales_report.list', [
                'datt'=>$result,
                'open'=>$open1,
                'order'=>$order1,
                'from_date' => $from_date,
                'to_date' => $to_date,
                'dea_id' => $dea_id,
                'dispatch'=>$dispatch,
                'order_finnal_tatal'=>$order_finnal_tatal,
                'name_deal'=>$name_deal,
                'adress'=>$adress,
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

            $dealer_namef = DealerCreation::select('id', 'dealer_name')
            ->where('sales_rep_id', $sales_exec)
            ->get();

            // return $dealer_namef;
            return response()->json($dealer_namef);
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
