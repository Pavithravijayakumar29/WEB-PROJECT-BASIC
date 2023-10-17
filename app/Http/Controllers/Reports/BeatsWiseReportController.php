<?php

namespace App\Http\Controllers\Reports;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\MarketCreation;
use App\Models\DealerCreation;
use App\Models\ShopCreation;
use Carbon\Carbon;
class BeatsWiseReportController extends Controller
{
    public function beats_wise_report()
    {
        $dealer_creation = DealerCreation::select('id', 'dealer_name')
                ->where('dealer_name', '!=', '')
                ->orderBy('dealer_name')
                ->get();

            $market_creation = MarketCreation::select('id', 'area_name')
                ->where('area_name', '!=', '')
                ->orderBy('area_name')
                ->get();

            $shop_creation = ShopCreation::select('id', 'shop_name')
                ->where('shop_name', '!=', '')
                ->orderBy('shop_name')
                ->get();
        return view('Reports.beats_wise_report.admin',[
        'dealer_creation'=>$dealer_creation,
        'market_creation'=>$market_creation,
        'shop_creation'=>$shop_creation
        ]);
    }
    public function retrieve($from_date, $to_date, $dealer_id, $beats_id, $shop_id)
    {
        $DealerController_td = (new DealerCreation)->getTable();
        $MarketController_td = (new MarketCreation)->getTable();
        $ShopController_td = (new ShopCreation)->getTable();

        $get_query102 = "";

        if ($from_date != "") {
            $from_date1 = $ShopController_td . '.entry_date >= \'' . $from_date . '\'';
        } else {
            $from_date1 = "";
        }
        if ($to_date != "") {
            $to_date1 = $ShopController_td . '.entry_date <= \'' . $to_date . '\'';
        } else {
            $to_date1 = "";
        }
        if ($dealer_id != "") {
            $dealer_id1 = $ShopController_td . '.dealer_id =' . $dealer_id;
        } else {
            $dealer_id1 = "";
        }
        if ($beats_id != "") {
            $beats_id1 = $ShopController_td . '.beats_id=' . $beats_id;
        } else {
            $beats_id1 = "";
        }
        if ($shop_id != "") {
            $shop_id1 = $ShopController_td . '.id=' . $shop_id;
        } else {
            $shop_id1 = "";
        }

        $all_value10 = $from_date1 . "@" . $to_date1 . "@" . $dealer_id1 . "@" . $beats_id1 . "@" . $shop_id1;
        $all_array10 = explode('@', $all_value10);
        foreach ($all_array10 as $value10) {
            if ($value10 != '') {
                $get_query102 .= $value10 . " AND ";
            }
        }
        if ($get_query102 != "") {
            $beats_wise_report = DB::select('SELECT ' . $ShopController_td . '.entry_date, ' . $DealerController_td . '.dealer_name, ' . $MarketController_td . '.area_name, ' . $ShopController_td . '.shop_name, ' . $ShopController_td . '.whatsapp_no, ' . $ShopController_td . '.address FROM ' . $ShopController_td . ' INNER JOIN ' . $DealerController_td . ' ON ' . $DealerController_td . '.id = ' . $ShopController_td . '.dealer_id' . ' INNER JOIN ' . $MarketController_td . ' ON ' . $MarketController_td . '.id = ' . $ShopController_td . '.beats_id' . ' WHERE ' . $get_query102 . ' (' . $ShopController_td . '.delete_status = 0 OR ' . $ShopController_td . '.delete_status IS NULL) ORDER BY ' . $ShopController_td . '.id');
        }
        else {
            $beats_wise_report = DB::select('SELECT  ' . $ShopController_td . '.entry_date, ' . $DealerController_td . '.dealer_name, ' . $MarketController_td . '.area_name, ' . $ShopController_td . '.shop_name, ' . $ShopController_td . '.whatsapp_no, ' . $ShopController_td . '.address  FROM ' . $ShopController_td . ' INNER JOIN ' . $DealerController_td . ' ON ' . $DealerController_td . '.id = ' . $ShopController_td . '.dealer_id' . ' INNER JOIN ' . $MarketController_td . ' ON ' . $MarketController_td . '.id = ' . $ShopController_td . '.beats_id' . ' WHERE  (' . $ShopController_td . '.delete_status = 0 OR ' . $ShopController_td . '.delete_status IS NULL) ORDER BY ' . $ShopController_td . '.id');
        }
        return $beats_wise_report;
    }
    public function db_cmd(Request $request)
    {
        $action=$request->input('action');
        if($action=='retrieve')
        {
            $beats_wise_report = $this->retrieve($request->input('from_date'),$request->input('to_date'),$request->input('dealer_id'),$request->input('beats_id'),$request->input('shop_id'));
            return view('Reports.beats_wise_report.list',[
            'beats_wise_report'=>$beats_wise_report
            ]);
        }
    }
}
