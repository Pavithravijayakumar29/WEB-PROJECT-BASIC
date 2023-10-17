<?php

namespace App\Http\Controllers\Entry;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Entry\SalesOrderStockMain;
use App\Models\Entry\SalesOrderStockSub;
use App\Models\Entry\SalesOrderD2SMain;
use App\Models\Entry\SalesOrderD2Ssub;
use App\Models\MarketCreation;
use App\Models\DealerCreation;
use App\Models\ItemCreation;
use App\Models\ItemLitersType;
use App\Models\ItemPropertiesType;
use App\Models\ShopsType;
use App\Models\ShopCreation;
use App\Models\SalesRepCreation;
use Carbon\Carbon;

class SalesOrderStockController extends Controller
{
    public function sales_order_stock()
    {
        $order_no_list = SalesOrderStockMain::select('order_no')->where(function ($query) {
            $query->where('delete_status', '0')->orWhereNull('delete_status');
        })->get();
        $market_creation = MarketCreation::select('id', 'area_name')->where(function ($query) {
            $query->where('delete_status', '0')->orWhereNull('delete_status');
        })->orderBy('area_name')->get();
        $dealer_creation = DealerCreation::select('id', 'dealer_name')->where(function ($query) {
            $query->where('delete_status', '0')->orWhereNull('delete_status');
        })->orderBy('dealer_name')->get();

        $sales_name = SalesRepCreation::select('id', 'sales_ref_name')->where(function ($query) {
            $query->where('delete_status', '0')->orWhereNull('delete_status');
        })->orderBy('sales_ref_name')->get();

        return view('Entry.sales_entry_stock.admin', ['order_no_list' => $order_no_list, 'market_creation' => $market_creation, 'dealer_creation' => $dealer_creation, "sales_name" => $sales_name]);
    }
    public function retrieve($from_date_1, $to_date_1, $order_no_1, $dealer_creation_id_1, $status_1)
    {
        $cond = "";
        if ($from_date_1 != "") {
            $cond .= " and entry_date>='" . $from_date_1 . "'";
        }
        if ($to_date_1 != "") {
            $cond .= " and entry_date<='" . $to_date_1 . "'";
        }
        if ($order_no_1 != "") {
            $cond .= " and order_no='" . $order_no_1 . "'";
        }
        if ($dealer_creation_id_1 != "") {
            $cond .= " and dealer_creation_id=" . $dealer_creation_id_1;
        }
        if ($status_1 != "") {
            $cond .= " and status=" . $status_1;
        }

        $main_tb = (new SalesOrderStockMain)->getTable();
        $sub_tb = (new SalesOrderStockSub)->getTable();
        $MarketCreation_tb = (new MarketCreation)->getTable();
        $DealerCreation_tb = (new DealerCreation)->getTable();

        $tb1 = DB::select('SELECT id,order_no,entry_date,stock_entry_date,(SELECT dealer_name FROM ' . $DealerCreation_tb . ' WHERE id=' . $main_tb . '.dealer_creation_id) AS dealer_name,status FROM ' . $main_tb . ' WHERE (delete_status=0 OR delete_status IS NULL)' . $cond);


        return json_decode(json_encode($tb1), true);
    }
    public function retrieve_main($id)
    {
        $sales = SalesOrderStockMain::select('id', 'order_no', 'entry_date','stock_entry_date',  'dealer_creation_id','dealer_address', 'status', 'sales_exec', 'description')->where('id', $id)->get()->first();
        return $sales;
    }
    public function retrieve_sub($main_id, $sub_id)
    {

        if ($sub_id == '') {
            $sub_tb = (new SalesOrderStockSub)->getTable();
            $ItemCreation_tb = (new ItemCreation)->getTable();
            $ItemPropertiesType_tb = (new ItemPropertiesType)->getTable();
            $ItemLitersType_tb = (new ItemLitersType)->getTable();
            $ShopCreation_tb = (new ShopCreation)->getTable();
            $tb1 = DB::select('select id,(select item_name from ' . $ItemCreation_tb . ' where id=' . $sub_tb . '.item_creation_id) as item_creation_id,
            (select short_code from ' . $ItemCreation_tb . ' where id=' . $sub_tb . '.short_code_id) as short_code_id, (select item_properties_type from ' . $ItemPropertiesType_tb . ' where id=' . $sub_tb . '.item_property) as item_property,(select item_liters_type from ' . $ItemLitersType_tb . ' where id=' . $sub_tb . '.item_weights) as item_weights,opening_stock,current_stock,pieces_quantity from ' . $sub_tb . ' where sales_order_main_id=' . $main_id . ' and (delete_status=0 or delete_status is null)');

            return json_decode(json_encode($tb1), true);
        }
        else {
            return SalesOrderStockSub::where('id', $sub_id)->where(function ($query) {
                $query->where('delete_status', '0')->orWhereNull('delete_status');
            })->get(['id', 'item_creation_id','short_code_id', 'item_property', 'item_weights', 'opening_stock','current_stock', 'pieces_quantity'])->first();
        }
    }
    public function db_cmd(Request $request)
    {
        $action = $request->input('action');
        if ($action == 'insert') {
            $tb = new SalesOrderStockMain();
            $tb->entry_date  = Carbon::now();
            $tb->stock_entry_date = $request->input('stock_entry_date');
            $tb->dealer_creation_id = $request->input('dealer_creation_id');
            $tb->dealer_address = $request->input('dealer_address');
            $tb->order_no = $request->input('order_no');
            $tb->status = $request->input('status');
            $tb->description = $request->input('description');
            $tb->sales_exec = $request->input('sales_exec');
            $tb->save();
        } else if ($action == 'update') {
            $tb = SalesOrderStockMain::find($request->input('id'));

            $tb->entry_date  = Carbon::now();
            $tb->stock_entry_date = $request->input('stock_entry_date');
            $tb->dealer_creation_id = $request->input('dealer_creation_id');
            $tb->dealer_address = $request->input('dealer_address');
            $tb->order_no = $request->input('order_no');
            $tb->status = $request->input('status');
            $tb->description = $request->input('description');
            $tb->sales_exec = $request->input('sales_exec');
            $tb->save();
        } else if ($action == 'delete') {
            $tb = SalesOrderStockMain::find($request->input('id'));
            $tb->delete_status = "1";
            $tb->save();
        } else if ($action == 'insert_sub') {
            $main_id = $request->input('main_id');
            if ($main_id == '') {
                $main_id = SalesOrderStockMain::insertGetId([
                    'entry_date'  => Carbon::now(),
                    'order_no' => $request->input('order_no'),
                    'stock_entry_date' => $request->input('stock_entry_date'),
                    'dealer_creation_id' => $request->input('dealer_creation_id'),
                    'dealer_address' => $request->input('dealer_address'),
                    'status' => $request->input('status'),
                    'description' => $request->input('description'),
                    'sales_exec' => $request->input('sales_exec')
                ]);
            }
            $tb = new SalesOrderStockSub();
            $tb->entry_date  = Carbon::now();
            $tb->sales_order_main_id = $main_id;
            $tb->item_creation_id = $request->input('item_creation_id');
            $tb->short_code_id = $request->input('short_code_id');
            $tb->item_property = $request->input('item_property');
            $tb->item_weights = $request->input('item_weights');
            $tb->opening_stock = $request->input('opening_stock');
            $opening_stock_sub = $request->input('opening_stock');
            $current_stock_sub = $request->input('current_stock');
            $total_current_stock = $opening_stock_sub + $current_stock_sub;
            $tb->current_stock = $total_current_stock;
            if($request->input('pieces_quantity')){
                $item_creation_id = $request->input('item_creation_id');
                $item_creation = ItemCreation::select('piece')
                ->where('id', $item_creation_id)
                ->where(function ($query) {
                    $query->where('delete_status', '0')->orWhereNull('delete_status');
                })->orderBy('item_name')->first();
                if ($item_creation) {
                    $piece = $item_creation->piece;
                    $total_pieces = $total_current_stock * $piece;
                } else {
                    $total_pieces = "0";
                }
                $tb->pieces_quantity = $total_pieces;
            }else{
                $tb->pieces_quantity = 0;
            }
            $tb->save();
            return $main_id;
        } else if ($action == 'update_sub') {

            if($request->input('id')){
                $sales_order_stock_sub = SalesOrderStockSub::find($request->input('id'));
                $main_id = $sales_order_stock_sub->sales_order_main_id;
                $opening_stock_sub = $sales_order_stock_sub->opening_stock;
                $current_stock = $sales_order_stock_sub->current_stock;
                if ($current_stock) {
                    $total_current_stock = $current_stock - $opening_stock_sub;
                }else{
                    $total_current_stock = $current_stock->current_stock;
                }
                $sales_order_stock_main = SalesOrderStockMain::find($main_id);
                $dealer_creation_id = $sales_order_stock_main->dealer_creation_id;
            }
            $item_creation_id = $request->input('item_creation_id');
            $short_code_id = $request->input('short_code_id');
            $item_property = $request->input('item_property');
            $item_weights = $request->input('item_weights');

            SalesOrderStockSub::join('sales_order_stock_main as sm', 'sales_order_stock_sublist.sales_order_main_id', '=', 'sm.id')
            ->where('sm.dealer_creation_id', $dealer_creation_id)
            ->where('sales_order_stock_sublist.item_creation_id', $item_creation_id)
            ->where('sales_order_stock_sublist.item_property', $item_property)
            ->where('sales_order_stock_sublist.item_weights', $item_weights)
            ->update(['sales_order_stock_sublist.current_stock' => $total_current_stock]);

            $tb = SalesOrderStockSub::find($request->input('id'));
            $tb->item_creation_id = $request->input('item_creation_id');
            $tb->short_code_id = $request->input('short_code_id');
            $tb->item_property = $request->input('item_property');
            $tb->item_weights = $request->input('item_weights');
            $tb->opening_stock = $request->input('opening_stock');
            $opening_stock_sublist = $request->input('opening_stock');
            $total_current_stock_sublist = $opening_stock_sublist + $total_current_stock;
            $tb->current_stock = $total_current_stock_sublist;
            $tb->pieces_quantity = $request->input('pieces_quantity');
            $tb->save();
        } else if ($action == 'delete_sub') {
            if($request->input('id')){
                $sales_order_stock_sub = SalesOrderStockSub::find($request->input('id'));
                $main_id = $sales_order_stock_sub->sales_order_main_id;
                $opening_stock_sub = $sales_order_stock_sub->opening_stock;
                $current_stock = $sales_order_stock_sub->current_stock;
                $item_creation_id = $sales_order_stock_sub->item_creation_id;
                $item_property = $sales_order_stock_sub->item_property;
                $item_weights = $sales_order_stock_sub->item_weights;
                if ($current_stock) {
                    $total_current_stock = $current_stock - $opening_stock_sub;
                }else{
                    $total_current_stock = $current_stock->current_stock;
                }
                $sales_order_stock_main = SalesOrderStockMain::find($main_id);
                $dealer_creation_id = $sales_order_stock_main->dealer_creation_id;
            }

            SalesOrderStockSub::join('sales_order_stock_main as sm', 'sales_order_stock_sublist.sales_order_main_id', '=', 'sm.id')
            ->where('sm.dealer_creation_id', $dealer_creation_id)
            ->where('sales_order_stock_sublist.item_creation_id', $item_creation_id)
            ->where('sales_order_stock_sublist.item_property', $item_property)
            ->where('sales_order_stock_sublist.item_weights', $item_weights)
            ->update(['sales_order_stock_sublist.current_stock' => $total_current_stock]);
            $tb = SalesOrderStockSub::find($request->input('id'));
            $tb->delete_status = "1";
            $tb->save();
        } else if ($action == 'retrieve') {
            $sales_order_stock_main = $this->retrieve(
                $request->input('from_date_1'),
                $request->input('to_date_1'),
                $request->input('order_no_1'),
                $request->input('dealer_creation_id_1'),
                $request->input('sales_exec'),
            );

            return view('Entry.sales_entry_stock.list', [
                'sales_order_stock_main' => $sales_order_stock_main,
                'user_rights_edit_1' => $request->input('user_rights_edit_1'),
                'user_rights_delete_1' => $request->input('user_rights_delete_1')
            ]);
        }
         else if ($action == 'dealer_dropdown') {

            $dealer_creation_id = $request->input('dealer_creation_id');

            $ShopCreation_tb = (new ShopCreation)->getTable();
            $DealerController_tb = (new DealerCreation)->getTable();

            $dealer_creation_id = $request->input('dealer_creation_id');


            $dealer_dropdown = ShopCreation::select('id', 'shop_name')
            ->where('id', $dealer_creation_id)
            ->get();

            return response()->json($dealer_dropdown);

        } else if ($action == 'create_form') {
            $main_tb = (new SalesOrderStockMain)->getTable();
            $next_id = DB::select("SHOW TABLE STATUS LIKE '" . $main_tb . "'");
            $order_no = "STOCK_" . date("ym") . "_" . $next_id[0]->Auto_increment;
            $market_creation = MarketCreation::select('id', 'area_name')->where(function ($query) {
                $query->where('delete_status', '0')->orWhereNull('delete_status');
            })->orderBy('area_name')->get();
            $dealer_creation = DealerCreation::select('id', 'dealer_name')->where(function ($query) {
                $query->where('delete_status', '0')->orWhereNull('delete_status');
            })->orderBy('dealer_name')->get();

            $sales_name = SalesRepCreation::select('id', 'sales_ref_name')->where(function ($query) {
                $query->where('delete_status', '0')->orWhereNull('delete_status');
            })->orderBy('sales_ref_name')->get();

            return view('Entry.sales_entry_stock.create', ['order_no' => $order_no, 'market_creation' => $market_creation, 'dealer_creation' => $dealer_creation, "sales_name" => $sales_name]);

        } else if ($action == 'update_form') {
            $sales_order_stock_main = $this->retrieve_main($request->input('id'));
            $market_creation = MarketCreation::select('id', 'area_name')->where(function ($query) {
                $query->where('delete_status', '0')->orWhereNull('delete_status');
            })->orderBy('area_name')->get();

            $dealer_creation = DealerCreation::select('id', 'dealer_name')->where(function ($query) {
                $query->where('delete_status', '0')->orWhereNull('delete_status');
            })->orderBy('dealer_name')->get();

            $sales_name = SalesRepCreation::select('id', 'sales_ref_name')->where(function ($query) {
                $query->where('delete_status', '0')->orWhereNull('delete_status');
            })->orderBy('sales_ref_name')->get();

            return view('Entry.sales_entry_stock.update', ['sales_order_stock_main' => $sales_order_stock_main, 'market_creation' => $market_creation, 'dealer_creation' => $dealer_creation, "sales_name" => $sales_name]);

        } else if ($action == 'form_sublist') {
            $main_id = $request->input('main_id');
            $sub_id = $request->input('sub_id');
            $sales_order_stock_sub = null;
            if ($sub_id != "") {
                $sales_order_stock_sub = $this->retrieve_sub($main_id, $sub_id);
            }
            $sales_order_stock_sub_list = [];
            if ($main_id != "") {
                $sales_order_stock_sub_list = $this->retrieve_sub($main_id, '');
            }
            $item_creation = ItemCreation::select('id', 'item_name', 'short_code','distributor_rate')->where(function ($query) {
                $query->where('delete_status', '0')->orWhereNull('delete_status');
            })->orderBy('item_name')->get();

            $item_properties_type = ItemPropertiesType::select('id', 'item_properties_type')->where('status1', '1')->where(function ($query) {
                $query->where('delete_status', '0')->orWhereNull('delete_status');
            })->orderBy('item_properties_type')->get();

            $item_liters_type = ItemLitersType::select('id', 'item_liters_type')->where('status1', '1')->where(function ($query) {
                $query->where('delete_status', '0')->orWhereNull('delete_status');
            })->orderBy('item_liters_type')->get();

            return view('Entry.sales_entry_stock.sublist', ['sales_order_stock_sub' => $sales_order_stock_sub, 'sales_order_stock_sub_list' => $sales_order_stock_sub_list, 'main_id' => $main_id, 'sub_id' => $sub_id, 'item_creation' => $item_creation, 'item_properties_type' => $item_properties_type,'item_liters_type' => $item_liters_type, 'user_rights_edit_1' => $request->input('user_rights_edit_1'), 'user_rights_delete_1' => $request->input('user_rights_delete_1')]);
        }
        else if ($action == 'getaddress') {

            $dealer_creation_id = $request->input('dealer_creation_id');
            $dealer_address = DealerCreation::select('id', 'address')
            ->where('id', $dealer_creation_id)
            ->get();
            return response()->json($dealer_address);
        }
        else if ($action == 'getopeningstock') {

            $stock_entry_date = $request->input('stock_entry_date');
            $dealer_creation_id = $request->input('dealer_creation_id');
            $item_creation_id = $request->input('item_creation_id');
            $item_property = $request->input('item_property');
            $item_weights = $request->input('item_weights');

            $SalesOrderStockMain_tb = (new SalesOrderStockMain)->getTable();
            $SalesOrderStockSub_tb = (new SalesOrderStockSub)->getTable();

            $current_stock = SalesOrderStockMain::orderBy($SalesOrderStockSub_tb . '.id', 'desc')
            ->select($SalesOrderStockSub_tb . '.current_stock')
            ->join($SalesOrderStockSub_tb, $SalesOrderStockSub_tb . '.sales_order_main_id', '=', $SalesOrderStockMain_tb . '.id')
            ->where($SalesOrderStockMain_tb . '.dealer_creation_id', '=', $dealer_creation_id)
            ->where(function ($query) use ($SalesOrderStockMain_tb) {
                $query->where($SalesOrderStockMain_tb . '.delete_status', '0')
                      ->orWhereNull($SalesOrderStockMain_tb . '.delete_status');
            })
            ->where($SalesOrderStockMain_tb . '.status', '=', '1')
            ->where($SalesOrderStockSub_tb . '.item_creation_id', '=', $item_creation_id)
            ->where($SalesOrderStockSub_tb . '.item_property', '=', $item_property)
            ->where($SalesOrderStockSub_tb . '.item_weights', '=', $item_weights)
            ->orderBy($SalesOrderStockSub_tb . '.id', 'desc')
            ->orderBy($SalesOrderStockMain_tb . '.id', 'desc')
            ->first();

            if ($current_stock) {
                $total_opening_stock = $current_stock->current_stock;
            } else {
                $total_opening_stock = "0";
            }

            return response()->json($total_opening_stock);
        }

        else if ($action == 'getitempieces') {
            $item_creation_id = $request->input('item_creation_id');
            $stock_count = $request->input('stock_count');

            $item_creation = ItemCreation::select('piece')
            ->where('id', $item_creation_id)
            ->where(function ($query) {
                $query->where('delete_status', '0')->orWhereNull('delete_status');
            })->orderBy('item_name')->first();

            if ($item_creation) {
                $piece = $item_creation->piece;
                $total_pieces = $stock_count * $piece;
            } else {
                $total_pieces = "0";
            }

            return response()->json($total_pieces);
        }


        else if ($action == 'getdearlername') {

            $sales_exec = $request->input('sales_exec');

            $dealer_name = DealerCreation::select('id', 'dealer_name')
            ->where('sales_rep_id', $sales_exec)
            ->get();

            return response()->json($dealer_name);
        }

        else if ($action == 'getshortcode') {

            $item_creation_id = $request->input('item_creation_id');

            $short_code = ItemCreation::select('id', 'short_code')
            ->where('id', $item_creation_id)
            ->get();

            return response()->json($short_code);
        }
    }
}
