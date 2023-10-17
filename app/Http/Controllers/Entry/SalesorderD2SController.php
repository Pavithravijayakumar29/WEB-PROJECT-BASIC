<?php

namespace App\Http\Controllers\Entry;

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

class SalesorderD2SController extends Controller
{
    public function sales_order_d2s()
    {
        $order_no_list = SalesOrderD2SMain::select('order_no')->where(function ($query) {
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

        return view('Entry.sales_entry_d2s.admin', ['order_no_list' => $order_no_list, 'market_creation' => $market_creation, 'dealer_creation' => $dealer_creation, 'shop_creation' => $shop_creation, "sales_name" => $sales_name]);
    }
    public function retrieve($from_date_1, $to_date_1, $order_no_1, $market_creation_id_1, $dealer_creation_id_1, $status_1)
    {
        $cond = "";
        if ($from_date_1 != "") {
            $cond .= " and order_date>='" . $from_date_1 . "'";
        }
        if ($to_date_1 != "") {
            $cond .= " and order_date<='" . $to_date_1 . "'";
        }
        if ($order_no_1 != "") {
            $cond .= " and order_no='" . $order_no_1 . "'";
        }
        if ($market_creation_id_1 != "") {
            $cond .= " and market_creation_id=" . $market_creation_id_1;
        }
        if ($dealer_creation_id_1 != "") {
            $cond .= " and dealer_creation_id=" . $dealer_creation_id_1;
        }
        if ($status_1 != "") {
            $cond .= " and status=" . $status_1;
        }

        $main_tb = (new SalesOrderD2SMain)->getTable();
        $sub_tb = (new SalesOrderD2Ssub)->getTable();
        $MarketCreation_tb = (new MarketCreation)->getTable();
        $DealerCreation_tb = (new DealerCreation)->getTable();
        $ShopCreation_tb = (new ShopsType)->getTable();
        $tb1 = DB::select('select id,order_no,order_date,(select area_name FROM ' . $MarketCreation_tb . ' where id=' . $main_tb . '.market_creation_id) as area_name,(select dealer_name from ' . $DealerCreation_tb . ' where id=' . $main_tb . '.dealer_creation_id) as dealer_name,(select shops_type from ' . $ShopCreation_tb . ' where id=' . $main_tb . '.shop_creation_id) as shops_type,status,(select IF(count(*)>0,CONCAT(sum(order_quantity),";",sum(item_weights),";",sum(total_amount)),"0;0;0") from ' . $sub_tb . ' where sales_order_main_id=' . $main_tb . '.id and (delete_status=0 or delete_status is null)) as total_sublist from ' . $main_tb . ' where (delete_status=0 or delete_status is null)' . $cond);

        return json_decode(json_encode($tb1), true);
    }
    public function retrieve_main($id)
    {
        $sales = SalesOrderD2SMain::select('id', 'order_no', 'order_date', 'market_creation_id','address', 'dealer_creation_id', 'status', "shop_creation_id",  "orderStatus", 'sales_exec','radio_visit', 'description',"arrivingTime",'closingTime1')->where('id', $id)->get()->first();
        return $sales;
    }
    public function retrieve_sub($main_id, $sub_id)
    {

        if ($sub_id == '') {
            $sub_tb = (new SalesOrderD2Ssub)->getTable();
            $ItemCreation_tb = (new ItemCreation)->getTable();
            $ItemPropertiesType_tb = (new ItemPropertiesType)->getTable();
            $ItemLitersType_tb = (new ItemLitersType)->getTable();
            $ShopCreation_tb = (new ShopCreation)->getTable();
            $tb1 = DB::select('select id,status_check,order_date_sub,arriving_time_sub,closing_time_sub,(select item_name from ' . $ItemCreation_tb . ' where id=' . $sub_tb . '.item_creation_id) as item_creation_id,
            (select short_code from ' . $ItemCreation_tb . ' where id=' . $sub_tb . '.short_code_id) as short_code_id,
            (select shop_name from ' . $ShopCreation_tb . ' where id=' . $sub_tb . '.shop_creation_id) as shop_creation_id,(select item_properties_type from ' . $ItemPropertiesType_tb . ' where id=' . $sub_tb . '.item_property) as item_property,(select item_liters_type from ' . $ItemLitersType_tb . ' where id=' . $sub_tb . '.item_weights) as item_weights,current_stock,order_quantity,pieces_quantity,item_price,total_amount from ' . $sub_tb . ' where sales_order_main_id=' . $main_id . ' and (delete_status=0 or delete_status is null)');

            return json_decode(json_encode($tb1), true);
        }
        else {
            return SalesOrderD2Ssub::where('id', $sub_id)->where(function ($query) {
                $query->where('delete_status', '0')->orWhereNull('delete_status');
            })->get(['id','status_check','order_date_sub','arriving_time_sub','closing_time_sub','shop_creation_id', 'item_creation_id','short_code_id','current_stock','order_quantity','pieces_quantity', 'item_property', 'item_weights', 'item_price', 'total_amount'])->first();
        }
    }
    public function visitors_retrieve($id)
    {
        if($id=='')
        {return VisitorCreation::select('id','d2s_id','order_date','order_no','visitor_name','sales_exec','mobile_no','description','address','image_name')->orderBy('id')->get();}
        else
        {return VisitorCreation::select('id','d2s_id','order_date','order_no','visitor_name','sales_exec','mobile_no','description','address','image_name')->where('id','=',$id)->get();}
    }
    public function visitors_sublist_retrieve($d2s_id,$order_date,$order_no,$sales_exec)
    {
        if($order_date=='' && $order_no=='' && $sales_exec=='')
        {return VisitorCreation::select('id','d2s_id','order_date','order_no','visitor_name','sales_exec','mobile_no','description','address','image_name')->orderBy('id')->get();}
        else
        {return VisitorCreation::select('id','d2s_id','order_date','order_no','visitor_name','sales_exec','mobile_no','description','address','image_name')->orderBy('id')->where('order_date','=',$order_date)->where('order_no','=',$order_no)->where('sales_exec','=',$sales_exec)->get();}
    }
    public function db_cmd(Request $request)
    {
        $action = $request->input('action');
        if ($action == 'insert') {
            $main_id = SalesOrderD2SMain::insertGetId([
                'entry_date'  => Carbon::now(),
                'order_no' => $request->input('order_no'),
                'order_date' => $request->input('order_date'),
                'market_creation_id' => $request->input('market_creation_id'),
                'dealer_creation_id' => $request->input('dealer_creation_id'),
                'address' => $request->input('dealer_address'),
                'status' => $request->input('status'),
                'description' => $request->input('description'),
                'sales_exec' => $request->input('sales_exec'),
                'radio_visit' => $request->input('radio_visit'),

            ]);
            return $main_id;


        } else if ($action == 'update') {
            $tb = SalesOrderD2SMain::find($request->input('id'));

            $tb->entry_date  = Carbon::now();
            $tb->order_date = $request->input('order_date');
            $tb->market_creation_id = $request->input('market_creation_id');
            $tb->dealer_creation_id = $request->input('dealer_creation_id');
            $tb->address = $request->input('dealer_address');
            $tb->order_no = $request->input('order_no');
            $tb->status = $request->input('status');
            $tb->description = $request->input('description');
            $tb->sales_exec = $request->input('sales_exec');
            $tb->radio_visit = $request->input('radio_visit');
            $tb->save();
        } else if ($action == 'delete') {
            if ($request->input('id')) {
                $sales_order_main_id = $request->input('id');

                $sales_order_d2s_sub = SalesOrderD2Ssub::where('sales_order_main_id', $sales_order_main_id)->where(function ($query) {
                    $query->where('delete_status', '0')->orWhereNull('delete_status');
                })->get();

                foreach ($sales_order_d2s_sub as $sub) {
                    $sales_order_d2s_main = SalesOrderD2SMain::find($sales_order_main_id);

                    $item_creation_id = $sub->item_creation_id;
                    $item_property = $sub->item_property;
                    $item_weights = $sub->item_weights;
                    $order_quantity = $sub->order_quantity;

                    $dealer_creation_id = $sales_order_d2s_main->dealer_creation_id;

                    $SalesOrderStockMain_tb = (new SalesOrderStockMain)->getTable();
                    $SalesOrderStockSub_tb = (new SalesOrderStockSub)->getTable();

                    $current_stock = SalesOrderStockMain::select($SalesOrderStockSub_tb . '.current_stock')
                    ->join($SalesOrderStockSub_tb, $SalesOrderStockSub_tb . '.sales_order_main_id', '=', $SalesOrderStockMain_tb . '.id')
                    ->where($SalesOrderStockMain_tb . '.dealer_creation_id', '=', $dealer_creation_id)
                    ->where(function ($query) use ($SalesOrderStockMain_tb) {
                        $query->where($SalesOrderStockMain_tb . '.delete_status', '0')
                            ->orWhereNull($SalesOrderStockMain_tb . '.delete_status');
                    })
                    ->where(function ($query) use ($SalesOrderStockSub_tb) {
                        $query->where($SalesOrderStockSub_tb . '.delete_status', '0')
                            ->orWhereNull($SalesOrderStockSub_tb . '.delete_status');
                    })
                    ->where($SalesOrderStockMain_tb . '.status', '=', '1')
                    ->where($SalesOrderStockSub_tb . '.item_creation_id', '=', $item_creation_id)
                    ->where($SalesOrderStockSub_tb . '.item_property', '=', $item_property)
                    ->where($SalesOrderStockSub_tb . '.item_weights', '=', $item_weights)
                    ->orderBy($SalesOrderStockSub_tb . '.id', 'desc')
                    ->orderBy($SalesOrderStockMain_tb . '.id', 'desc')
                    ->first();

                    $total_current_stock = $current_stock ? $current_stock->current_stock + $order_quantity : $order_quantity;

                    $sales_order_stock_main_max_id = SalesOrderStockMain::where('dealer_creation_id', $dealer_creation_id)
                    ->where(function ($query) {
                        $query->where('delete_status', '0')
                            ->orWhereNull('delete_status');
                    })
                    ->orderByDesc('id')
                    ->value('id');

                    $sales_order_stock_sub_max_id = SalesOrderStockSub::where('item_creation_id', $item_creation_id)
                    ->where('item_property', $item_property)
                    ->where('item_weights', $item_weights)
                    ->where(function ($query) {
                        $query->where('delete_status', '0')
                            ->orWhereNull('delete_status');
                    })
                    ->orderByDesc('id')
                    ->value('id');

                    SalesOrderStockSub::join('sales_order_stock_main as sm', 'sales_order_stock_sublist.sales_order_main_id', '=', 'sm.id')
                    ->where('sm.dealer_creation_id', $dealer_creation_id)
                    ->where('sales_order_stock_sublist.item_creation_id', $item_creation_id)
                    ->where('sales_order_stock_sublist.item_property', $item_property)
                    ->where('sales_order_stock_sublist.item_weights', $item_weights)
                    ->where('sm.id', $sales_order_stock_main_max_id)
                    ->where('sales_order_stock_sublist.id', $sales_order_stock_sub_max_id)
                    ->update(['sales_order_stock_sublist.current_stock' => $total_current_stock]);
                }
            }

            $tb = SalesOrderD2SMain::find($request->input('id'));
            $tb->delete_status = "1";
            $tb->save();
        } else if ($action == 'insert_sub') {
            $main_id = $request->input('main_id');
            if ($main_id == '') {
                if($request->input('radio_visit')){
                    $radio_visit = $request->input('radio_visit');
                }else{
                    $radio_visit = 0;
                }
                $main_id = SalesOrderD2SMain::insertGetId([
                    'entry_date'  => Carbon::now(),
                    'order_no' => $request->input('order_no'),
                    'order_date' => $request->input('order_date'),
                    'market_creation_id' => $request->input('market_creation_id'),
                    'dealer_creation_id' => $request->input('dealer_creation_id'),
                    'address' => $request->input('dealer_address'),
                    'status' => $request->input('status'),
                    'description' => $request->input('description'),
                    'sales_exec' => $request->input('sales_exec'),
                    'radio_visit' => $radio_visit,

                ]);
            }
            $tb = new SalesOrderD2Ssub();
            $tb->entry_date  = Carbon::now();
            $tb->sales_order_main_id = $main_id;
            $tb->status_check = $request->input('status_check');
            $tb->order_date_sub = $request->input('order_date_sub');
            $tb->arriving_time_sub = $request->input('arriving_time_sub');
            $tb->closing_time_sub = $request->input('closing_time_sub');
            $tb->shop_creation_id = $request->input('shop_creation_id');
            $tb->short_code_id = $request->input('short_code_id');
            if($request->input('item_creation_id')){
                $tb->item_creation_id = $request->input('item_creation_id');
            }else{
                $tb->item_creation_id = 0;
            }
            if($request->input('current_stock')){
                $tb->current_stock = $request->input('current_stock');
            }else{
                $tb->current_stock = 0;
            }
            if($request->input('order_quantity')){
                $tb->order_quantity = $request->input('order_quantity');
            }else{
                $tb->order_quantity = 0;
            }
            if($request->input('pieces_quantity')){
                $tb->pieces_quantity = $request->input('pieces_quantity');
            }else{
                $tb->pieces_quantity = 0;
            }
            if($request->input('item_property')){
                $tb->item_property = $request->input('item_property');
            }else{
                $tb->item_property = 0;
            }
            if($request->input('item_weights')){
                $tb->item_weights = $request->input('item_weights');
            }else{
                $tb->item_weights = 0;
            }
            if($request->input('item_price')){
                $tb->item_price = $request->input('item_price');
            }else{
                $tb->item_price = 0;
            }
            if($request->input('total_amount')){
                $tb->total_amount = $request->input('total_amount');
            }else{
                $tb->total_amount = 0;
            }
            $tb->save();

            $order_date_sub = $request->input('order_date_sub');

            if($request->input('dealer_creation_id')){
                $dealer_creation_id = $request->input('dealer_creation_id');
            }else{
                $sales_order_d2s_main = SalesOrderD2SMain::find($main_id);
                $dealer_creation_id = $sales_order_d2s_main->dealer_creation_id;
            }
            $item_creation_id = $request->input('item_creation_id');
            $short_code_id = $request->input('short_code_id');
            $item_property = $request->input('item_property');
            $item_weights = $request->input('item_weights');

            $current_stock = $request->input('current_stock');
            $order_quantity = $request->input('order_quantity');

            if($current_stock && $order_quantity){
                $total_current_stock = $current_stock - $order_quantity;
            }else{
                $total_current_stock = 0;
            }

            $sales_order_stock_main_max_id = SalesOrderStockMain::where('dealer_creation_id', $dealer_creation_id)
            ->where(function ($query) {
                $query->where('delete_status', '0')
                    ->orWhereNull('delete_status');
            })
            ->orderByDesc('id')
            ->value('id');

            $sales_order_stock_sub_max_id = SalesOrderStockSub::where('item_creation_id', $item_creation_id)
            ->where('item_property', $item_property)
            ->where('item_weights', $item_weights)
            ->where(function ($query) {
                $query->where('delete_status', '0')
                    ->orWhereNull('delete_status');
            })
            ->orderByDesc('id')
            ->value('id');

            SalesOrderStockSub::join('sales_order_stock_main as sm', 'sales_order_stock_sublist.sales_order_main_id', '=', 'sm.id')
            ->where('sm.dealer_creation_id', $dealer_creation_id)
            ->where('sales_order_stock_sublist.item_creation_id', $item_creation_id)
            ->where('sales_order_stock_sublist.item_property', $item_property)
            ->where('sales_order_stock_sublist.item_weights', $item_weights)
            ->where('sm.id', $sales_order_stock_main_max_id)
            ->where('sales_order_stock_sublist.id', $sales_order_stock_sub_max_id)
            ->update(['sales_order_stock_sublist.current_stock' => $total_current_stock]);

            return $main_id;
        } else if ($action == 'update_sub') {

            if($request->input('id')){
                $sales_order_d2s_sub = SalesOrderD2Ssub::find($request->input('id'));
                $main_id = $sales_order_d2s_sub->sales_order_main_id;
                $order_quantity_sub = $sales_order_d2s_sub->order_quantity;
                $sales_order_d2s_main = SalesOrderD2SMain::find($main_id);
                $dealer_creation_id = $sales_order_d2s_main->dealer_creation_id;
            }

            $item_creation_id = $request->input('item_creation_id');
            $item_property = $request->input('item_property');
            $item_weights = $request->input('item_weights');

            $SalesOrderStockMain_tb = (new SalesOrderStockMain)->getTable();
            $SalesOrderStockSub_tb = (new SalesOrderStockSub)->getTable();

            $SalesOrderStockMain_tb = (new SalesOrderStockMain)->getTable();
            $SalesOrderStockSub_tb = (new SalesOrderStockSub)->getTable();

            $current_stock = SalesOrderStockMain::select($SalesOrderStockSub_tb . '.current_stock')
            ->join($SalesOrderStockSub_tb, $SalesOrderStockSub_tb . '.sales_order_main_id', '=', $SalesOrderStockMain_tb . '.id')
            ->where($SalesOrderStockMain_tb . '.dealer_creation_id', '=', $dealer_creation_id)
            ->where(function ($query) use ($SalesOrderStockMain_tb) {
                $query->where($SalesOrderStockMain_tb . '.delete_status', '0')
                    ->orWhereNull($SalesOrderStockMain_tb . '.delete_status');
            })
            ->where(function ($query) use ($SalesOrderStockSub_tb) {
                $query->where($SalesOrderStockSub_tb . '.delete_status', '0')
                    ->orWhereNull($SalesOrderStockSub_tb . '.delete_status');
            })
            ->where($SalesOrderStockMain_tb . '.status', '=', '1')
            ->where($SalesOrderStockSub_tb . '.item_creation_id', '=', $item_creation_id)
            ->where($SalesOrderStockSub_tb . '.item_property', '=', $item_property)
            ->where($SalesOrderStockSub_tb . '.item_weights', '=', $item_weights)
            ->orderBy($SalesOrderStockSub_tb . '.id', 'desc')
            ->orderBy($SalesOrderStockMain_tb . '.id', 'desc')
            ->first();

            if ($current_stock) {
                $current_stock = $current_stock->current_stock;
                $total_current_stock = $current_stock + $order_quantity_sub;
            }else{
                $total_current_stock = $current_stock->current_stock;
            }

            $sales_order_stock_main_max_id = SalesOrderStockMain::where('dealer_creation_id', $dealer_creation_id)
            ->where(function ($query) {
                $query->where('delete_status', '0')
                    ->orWhereNull('delete_status');
            })
            ->orderByDesc('id')
            ->value('id');

            $sales_order_stock_sub_max_id = SalesOrderStockSub::where('item_creation_id', $item_creation_id)
            ->where('item_property', $item_property)
            ->where('item_weights', $item_weights)
            ->where(function ($query) {
                $query->where('delete_status', '0')
                    ->orWhereNull('delete_status');
            })
            ->orderByDesc('id')
            ->value('id');

            SalesOrderStockSub::join('sales_order_stock_main as sm', 'sales_order_stock_sublist.sales_order_main_id', '=', 'sm.id')
            ->where('sm.dealer_creation_id', $dealer_creation_id)
            ->where('sales_order_stock_sublist.item_creation_id', $item_creation_id)
            ->where('sales_order_stock_sublist.item_property', $item_property)
            ->where('sales_order_stock_sublist.item_weights', $item_weights)
            ->where('sm.id', $sales_order_stock_main_max_id)
            ->where('sales_order_stock_sublist.id', $sales_order_stock_sub_max_id)
            ->update(['sales_order_stock_sublist.current_stock' => $total_current_stock]);

            $tb = SalesOrderD2Ssub::find($request->input('id'));
            $tb->status_check = $request->input('status_check');
            $tb->order_date_sub = $request->input('order_date_sub');
            $tb->arriving_time_sub = $request->input('arriving_time_sub');
            $tb->closing_time_sub = $request->input('closing_time_sub');
            $tb->shop_creation_id = $request->input('shop_creation_id');
            $tb->short_code_id = $request->input('short_code_id');
            if($request->input('item_creation_id')){
                $tb->item_creation_id = $request->input('item_creation_id');
            }else{
                $tb->item_creation_id = 0;
            }
            if($request->input('current_stock')){
                $tb->current_stock = $request->input('current_stock');
            }else{
                $tb->current_stock = 0;
            }
            if($request->input('order_quantity')){
                $tb->order_quantity = $request->input('order_quantity');
            }else{
                $tb->order_quantity = 0;
            }
            if($request->input('pieces_quantity')){
                $tb->pieces_quantity = $request->input('pieces_quantity');
            }else{
                $tb->pieces_quantity = 0;
            }
            if($request->input('item_property')){
                $tb->item_property = $request->input('item_property');
            }else{
                $tb->item_property = 0;
            }
            if($request->input('item_weights')){
                $tb->item_weights = $request->input('item_weights');
            }else{
                $tb->item_weights = 0;
            }
            if($request->input('item_price')){
                $tb->item_price = $request->input('item_price');
            }else{
                $tb->item_price = 0;
            }
            if($request->input('total_amount')){
                $tb->total_amount = $request->input('total_amount');
            }else{
                $tb->total_amount = 0;
            }

            $item_creation_id = $request->input('item_creation_id');
            $item_property = $request->input('item_property');
            $item_weights = $request->input('item_weights');

            $current_stock = $request->input('current_stock');
            $order_quantity = $request->input('order_quantity');

            if($current_stock && $order_quantity){
                $total_current_stock = $current_stock - $order_quantity;
            }else{
                $total_current_stock = 0;
            }

            $sales_order_stock_main_max_id = SalesOrderStockMain::where('dealer_creation_id', $dealer_creation_id)
            ->where(function ($query) {
                $query->where('delete_status', '0')
                    ->orWhereNull('delete_status');
            })
            ->orderByDesc('id')
            ->value('id');

            $sales_order_stock_sub_max_id = SalesOrderStockSub::where('item_creation_id', $item_creation_id)
            ->where('item_property', $item_property)
            ->where('item_weights', $item_weights)
            ->where(function ($query) {
                $query->where('delete_status', '0')
                    ->orWhereNull('delete_status');
            })
            ->orderByDesc('id')
            ->value('id');

            SalesOrderStockSub::join('sales_order_stock_main as sm', 'sales_order_stock_sublist.sales_order_main_id', '=', 'sm.id')
            ->where('sm.dealer_creation_id', $dealer_creation_id)
            ->where('sales_order_stock_sublist.item_creation_id', $item_creation_id)
            ->where('sales_order_stock_sublist.item_property', $item_property)
            ->where('sales_order_stock_sublist.item_weights', $item_weights)
            ->where('sm.id', $sales_order_stock_main_max_id)
            ->where('sales_order_stock_sublist.id', $sales_order_stock_sub_max_id)
            ->update(['sales_order_stock_sublist.current_stock' => $total_current_stock]);

            $tb->save();
        } else if ($action == 'delete_sub') {

            if($request->input('id')){
                $sales_order_d2s_sub = SalesOrderD2Ssub::find($request->input('id'));
                $main_id = $sales_order_d2s_sub->sales_order_main_id;
                $order_quantity = $sales_order_d2s_sub->order_quantity;
                $item_creation_id = $sales_order_d2s_sub->item_creation_id;
                $item_property = $sales_order_d2s_sub->item_property;
                $item_weights = $sales_order_d2s_sub->item_weights;
                $sales_order_d2s_main = SalesOrderD2SMain::find($main_id);
                $dealer_creation_id = $sales_order_d2s_main->dealer_creation_id;
            }
            $SalesOrderStockMain_tb = (new SalesOrderStockMain)->getTable();
            $SalesOrderStockSub_tb = (new SalesOrderStockSub)->getTable();

            $current_stock = SalesOrderStockMain::select($SalesOrderStockSub_tb . '.current_stock')
                ->join($SalesOrderStockSub_tb, $SalesOrderStockSub_tb . '.sales_order_main_id', '=', $SalesOrderStockMain_tb . '.id')
                ->where($SalesOrderStockMain_tb . '.dealer_creation_id', '=', $dealer_creation_id)
                ->where(function ($query) use ($SalesOrderStockMain_tb) {
                    $query->where($SalesOrderStockMain_tb . '.delete_status', '0')
                        ->orWhereNull($SalesOrderStockMain_tb . '.delete_status');
                })
                ->where(function ($query) use ($SalesOrderStockSub_tb) {
                    $query->where($SalesOrderStockSub_tb . '.delete_status', '0')
                        ->orWhereNull($SalesOrderStockSub_tb . '.delete_status');
                })
                ->where($SalesOrderStockMain_tb . '.status', '=', '1')
                ->where($SalesOrderStockSub_tb . '.item_creation_id', '=', $item_creation_id)
                ->where($SalesOrderStockSub_tb . '.item_property', '=', $item_property)
                ->where($SalesOrderStockSub_tb . '.item_weights', '=', $item_weights)
                ->orderBy($SalesOrderStockSub_tb . '.id', 'desc')
                ->orderBy($SalesOrderStockMain_tb . '.id', 'desc')
                ->first();

            if ($current_stock) {
                $current_stock = $current_stock->current_stock;
                $total_current_stock = $current_stock + $order_quantity;
            }else{
                $total_current_stock = $current_stock->current_stock;
            }

            $sales_order_stock_main_max_id = SalesOrderStockMain::where('dealer_creation_id', $dealer_creation_id)
            ->where(function ($query) {
                $query->where('delete_status', '0')
                    ->orWhereNull('delete_status');
            })
            ->orderByDesc('id')
            ->value('id');

            $sales_order_stock_sub_max_id = SalesOrderStockSub::where('item_creation_id', $item_creation_id)
            ->where('item_property', $item_property)
            ->where('item_weights', $item_weights)
            ->where(function ($query) {
                $query->where('delete_status', '0')
                    ->orWhereNull('delete_status');
            })
            ->orderByDesc('id')
            ->value('id');

            SalesOrderStockSub::join('sales_order_stock_main as sm', 'sales_order_stock_sublist.sales_order_main_id', '=', 'sm.id')
            ->where('sm.dealer_creation_id', $dealer_creation_id)
            ->where('sales_order_stock_sublist.item_creation_id', $item_creation_id)
            ->where('sales_order_stock_sublist.item_property', $item_property)
            ->where('sales_order_stock_sublist.item_weights', $item_weights)
            ->where('sm.id', $sales_order_stock_main_max_id)
            ->where('sales_order_stock_sublist.id', $sales_order_stock_sub_max_id)
            ->update(['sales_order_stock_sublist.current_stock' => $total_current_stock]);

            $tb = SalesOrderD2Ssub::find($request->input('id'));
            $tb->delete_status = "1";
            $tb->save();
        } else if ($action == 'retrieve') {
            $sales_order_d2s_main = $this->retrieve(
                $request->input('from_date_1'),
                $request->input('to_date_1'),
                $request->input('order_no_1'),
                $request->input('market_creation_id_1'),
                $request->input('dealer_creation_id_1'),
                $request->input('orderStatus'),
            );

            return view('Entry.sales_entry_d2s.list', [
                'sales_order_d2s_main' => $sales_order_d2s_main,
                'user_rights_edit_1' => $request->input('user_rights_edit_1'),
                'user_rights_delete_1' => $request->input('user_rights_delete_1')
            ]);
        }
        else if ($action == 'getshortcode') {

            $item_creation_id = $request->input('item_creation_id');

            $short_code = ItemCreation::select('id', 'short_code')
            ->where('id', $item_creation_id)
            ->get();

            return response()->json($short_code);
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
            $main_tb = (new SalesOrderD2SMain)->getTable();
            $next_id = DB::select("SHOW TABLE STATUS LIKE '" . $main_tb . "'");
            $order_no = "SALDS_" . date("ym") . "_" . $next_id[0]->Auto_increment;
            $market_creation = MarketCreation::select('id', 'area_name')->where(function ($query) {
                $query->where('delete_status', '0')->orWhereNull('delete_status');
            })->orderBy('area_name')->get();
            $dealer_creation = DealerCreation::select('id', 'dealer_name')->where(function ($query) {
                $query->where('delete_status', '0')->orWhereNull('delete_status');
            })->orderBy('dealer_name')->get();

            $shop_creation = ShopCreation::select('id', 'shop_name')->where(function ($query) {
                $query->where('delete_status', '0')->orWhereNull('delete_status');
            })->orderBy('shop_name')->get();

            $sales_name = SalesRepCreation::select('id', 'sales_ref_name')->where(function ($query) {
                $query->where('delete_status', '0')->orWhereNull('delete_status');
            })->orderBy('sales_ref_name')->get();

            return view('Entry.sales_entry_d2s.create', ['order_no' => $order_no, 'market_creation' => $market_creation, 'dealer_creation' => $dealer_creation, 'shop_creation' => $shop_creation, "sales_name" => $sales_name]);

        } else if ($action == 'update_form') {
            $sales_order_d2s_main = $this->retrieve_main($request->input('id'));

            $market_creation = MarketCreation::select('id', 'area_name')->where(function ($query) {
                $query->where('delete_status', '0')->orWhereNull('delete_status');
            })->orderBy('area_name')->get();

            $main_id_dealer = $request->input('id');

            $sales_exec = SalesOrderD2SMain::select('id', 'sales_exec')->where('id', $main_id_dealer)->get()->first();

            if($sales_exec){
                $sales_exec_value = $sales_exec->sales_exec;
            }else{
                $sales_exec_value = 0;
            }


            $dealer_creation = DealerCreation::select('id', 'dealer_name')->where(function ($query) {
                $query->where('delete_status', '0')->orWhereNull('delete_status');
            })->where('sales_rep_id', '=', $sales_exec_value)->orderBy('dealer_name')->get();

            $shop_creation = ShopCreation::select('id', 'shop_name')->where(function ($query) {
                $query->where('delete_status', '0')->orWhereNull('delete_status');
            })->orderBy('shop_name')->get();

            $sales_name = SalesRepCreation::select('id', 'sales_ref_name')->where(function ($query) {
                $query->where('delete_status', '0')->orWhereNull('delete_status');
            })->orderBy('sales_ref_name')->get();

            return view('Entry.sales_entry_d2s.update', ['sales_order_d2s_main' => $sales_order_d2s_main, 'market_creation' => $market_creation, 'dealer_creation' => $dealer_creation, 'shop_creation' => $shop_creation, "sales_name" => $sales_name]);

        } else if ($action == 'form_sublist') {
            $main_id = $request->input('main_id');
            $sub_id = $request->input('sub_id');
            $sales_order_d2s_sub = null;
            if ($sub_id != "") {
                $sales_order_d2s_sub = $this->retrieve_sub($main_id, $sub_id);
            }
            $sales_order_d2s_sub_list = [];
            if ($main_id != "") {
                $sales_order_d2s_sub_list = $this->retrieve_sub($main_id, '');
            }
            $item_creation = ItemCreation::select('id', 'item_name','short_code', 'distributor_rate','piece')->where(function ($query) {
                $query->where('delete_status', '0')->orWhereNull('delete_status');
            })->orderBy('item_name')->get();


            $item_properties_type = ItemPropertiesType::select('id', 'item_properties_type')->where('status1', '1')->where(function ($query) {
                $query->where('delete_status', '0')->orWhereNull('delete_status');
            })->orderBy('item_properties_type')->get();

            $item_liters_type = ItemLitersType::select('id', 'item_liters_type')->where('status1', '1')->where(function ($query) {
                $query->where('delete_status', '0')->orWhereNull('delete_status');
            })->orderBy('item_liters_type')->get();

            $shop_creation = ShopCreation::select('id', 'shop_name')->where(function ($query) {
                $query->where('delete_status', '0')->orWhereNull('delete_status');
            })->orderBy('shop_name')->get();

            $lastShopCreationId = SalesOrderD2Ssub::orderBy('id', 'desc')
            ->select('shop_creation_id')
            ->first();

        $last_id_shop = $lastShopCreationId ? $lastShopCreationId->shop_creation_id : null;

            return view('Entry.sales_entry_d2s.sublist', ['sales_order_d2s_sub' => $sales_order_d2s_sub, 'sales_order_d2s_sub_list' => $sales_order_d2s_sub_list, 'main_id' => $main_id, 'sub_id' => $sub_id, 'item_creation' => $item_creation, 'item_properties_type' => $item_properties_type, 'shop_creation'=>$shop_creation,'item_liters_type' => $item_liters_type,'last_id_shop'=>$last_id_shop, 'user_rights_edit_1' => $request->input('user_rights_edit_1'), 'user_rights_delete_1' => $request->input('user_rights_delete_1')]);
        }
        else if ($action == 'getmarket') {

            $dealer_creation_id = $request->input('dealer_creation_id');

            $dealer_address = DealerCreation::select('id', 'address')
            ->where('id', $dealer_creation_id)
            ->get();

            $dealer_creation = DealerCreation::find($dealer_creation_id);
            $market_id = $dealer_creation->area_id;
            $market_ids = explode(",", $market_id);
            $area_names = [];
            $marketId_s = [];

            foreach ($market_ids as $marketId) {
                $area_name = MarketCreation::find($marketId);
                if ($area_name) {
                    $area_names[] = $area_name;
                    $marketId_s[] = $marketId;
                }
            }
            $data = [
                'dealer_address' => $dealer_address,
                'area_names' => $area_names,
            ];
            return response()->json($data);
        }
        else if ($action == 'getshop') {

            $market_creation_id = $request->input('market_creation_id');

            $shop_name = ShopCreation::select('id', 'shop_name')
            ->where('beats_id', $market_creation_id)
            ->get();

            return response()->json($shop_name);
        }
        else if ($action == 'getshortcode') {

            $item_creation_id = $request->input('item_creation_id');

            $short_code = ItemCreation::select('id', 'short_code')
            ->where('id', $item_creation_id)
            ->get();

            return response()->json($short_code);
        }
        else if ($action == 'getdearlername') {

            $sales_exec = $request->input('sales_exec');

            $dealer_name = DealerCreation::select('id', 'dealer_name')
            ->where('sales_rep_id', $sales_exec)
            ->get();

            return response()->json($dealer_name);
        }
        else if ($action == 'getopeningstock') {

            $dealer_creation_id = $request->input('dealer_creation_id');
            $item_creation_id = $request->input('item_creation_id');
            $order_date_sub = $request->input('order_date_sub');
            $item_property = $request->input('item_property');
            $item_weights = $request->input('item_weights');

            $SalesOrderStockMain_tb = (new SalesOrderStockMain)->getTable();
            $SalesOrderStockSub_tb = (new SalesOrderStockSub)->getTable();

            $current_stock = SalesOrderStockMain::select($SalesOrderStockSub_tb . '.current_stock')
                ->join($SalesOrderStockSub_tb, $SalesOrderStockSub_tb . '.sales_order_main_id', '=', $SalesOrderStockMain_tb . '.id')
                ->where($SalesOrderStockMain_tb . '.dealer_creation_id', '=', $dealer_creation_id)
                ->where(function ($query) use ($SalesOrderStockMain_tb) {
                    $query->where($SalesOrderStockMain_tb . '.delete_status', '0')
                        ->orWhereNull($SalesOrderStockMain_tb . '.delete_status');
                })
                ->where(function ($query) use ($SalesOrderStockSub_tb) {
                    $query->where($SalesOrderStockSub_tb . '.delete_status', '0')
                        ->orWhereNull($SalesOrderStockSub_tb . '.delete_status');
                })
                ->where($SalesOrderStockMain_tb . '.status', '=', '1')
                ->where($SalesOrderStockSub_tb . '.item_creation_id', '=', $item_creation_id)
                ->where($SalesOrderStockSub_tb . '.item_property', '=', $item_property)
                ->where($SalesOrderStockSub_tb . '.item_weights', '=', $item_weights)
                ->orderBy($SalesOrderStockSub_tb . '.id', 'desc')
                ->orderBy($SalesOrderStockMain_tb . '.id', 'desc')
                ->first();

            if ($current_stock) {
                $current_stock_value = $current_stock->current_stock;
            } else {
                $current_stock_value = "0";
            }

            return response()->json($current_stock_value);
        }
        else if ($action == 'visitors_form')
        {
            $d2s_id = $request->input('d2s_id');
            $order_date = $request->input('order_date');
            $order_no = $request->input('order_no');
            $sales_exec = $request->input('sales_exec');

            return view('Entry.sales_entry_d2s.visitors', ['d2s_id' => $d2s_id,'order_date' => $order_date, 'order_no' => $order_no, 'sales_exec' => $sales_exec, 'user_rights_edit_1' => $request->input('user_rights_edit_1'), 'user_rights_delete_1' => $request->input('user_rights_delete_1')]);
        }
        else if ($action == 'visitors_insert')
        {
            $tb = new VisitorCreation();
            $tb->d2s_id = $request->input('d2s_id');
            $tb->order_date = $request->input('order_date');
            $tb->order_no = $request->input('order_no');
            $tb->visitor_name = $request->input('visitor_name');
            $tb->sales_exec = $request->input('sales_exec');
            $tb->mobile_no = $request->input('mobile_no');
            $tb->description = $request->input('description');
            $tb->address = $request->input('address');

            if ($request->hasFile('image_name')) {
                $image = $request->file('image_name');
                $imgName = $image->getClientOriginalName();
                $image->storeAs('public/visitors_img', $imgName);

                $tb->image_name = $imgName;
            }
            $tb->save();
        }
        else if ($action == 'visitors_update_1')
        {
            $tb = VisitorCreation::find($request->input('id'));
            $tb->d2s_id = $request->input('d2s_id');
            $tb->order_date = $request->input('order_date');
            $tb->order_no = $request->input('order_no');
            $tb->visitor_name = $request->input('visitor_name');
            $tb->sales_exec = $request->input('sales_exec');
            $tb->mobile_no = $request->input('mobile_no');
            $tb->description = $request->input('description');
            $tb->address = $request->input('address');

            if ($request->hasFile('image_name')) {
                $image = $request->file('image_name');
                $imgName = $image->getClientOriginalName();
                $image->storeAs('public/visitors_img', $imgName);

                $tb->image_name = $imgName;
            }
            $tb->save();
        }

        else if($action=='visitor_delete')
        {
            $tb = VisitorCreation::find($request->input('id'));
            $tb->delete();
        }
        else if($action=='visitor_sublist')
        {
            $d2s_id = $request->input('d2s_id');
            $order_date = $request->input('order_date');
            $order_no = $request->input('order_no');
            $sales_exec = $request->input('sales_exec');
            $visitor_sublist = $this->visitors_sublist_retrieve($d2s_id,$order_date,$order_no,$sales_exec);
            return view('Entry.sales_entry_d2s.visitors_sublist', ['visitor_sublist' => $visitor_sublist, 'd2s_id' => $d2s_id, 'order_date' => $order_date, 'order_no' => $order_no, 'sales_exec' => $sales_exec, 'user_rights_edit_1' => $request->input('user_rights_edit_1'), 'user_rights_delete_1' => $request->input('user_rights_delete_1')]);
        }
        else if ($action == 'visitors_update')
        {
            $d2s_id = $request->input('d2s_id');
            $order_date = $request->input('order_date');
            $order_no = $request->input('order_no');
            $sales_exec = $request->input('sales_exec');
            $visitor_creation = $this->visitors_retrieve($request->input('id'));
            return view('Entry.sales_entry_d2s.visitors_update', ['visitor_creation' => $visitor_creation[0], 'd2s_id' => $d2s_id, 'order_date' => $order_date, 'order_no' => $order_no, 'sales_exec' => $sales_exec, 'user_rights_edit_1' => $request->input('user_rights_edit_1'), 'user_rights_delete_1' => $request->input('user_rights_delete_1')]);
        }
    }
}
