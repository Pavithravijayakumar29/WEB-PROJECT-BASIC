<?php

namespace App\Http\Controllers\Entry;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Entry\SalesOrderDeliveryMain;
use App\Models\Entry\SalesOrderDeliverySub;
use App\Models\Entry\SalesOrderC2DMain;
use App\Models\Entry\SalesOrderC2DSub;
use App\Models\Entry\SalesOrderD2SMain;
use App\Models\Entry\SalesOrderD2Ssub;
use App\Models\Entry\SalesOrderStockMain;
use App\Models\Entry\SalesOrderStockSub;
use App\Models\MarketCreation;
use App\Models\DealerCreation;
use App\Models\ItemCreation;
use App\Models\ItemLitersType;
use App\Models\ItemPropertiesType;
use App\Models\StateCreation;
use App\Models\DistrictCreation;
use App\Models\SalesRepCreation;
use App\Models\ShopCreation;
use Carbon\Carbon;
class SalesOrderDeliveryController extends Controller
{
    public function sales_order_delivery()
    {
        $delivery_no_list=SalesOrderDeliveryMain::select('delivery_no')->where(function($query){$query->where('delete_status', '0')->orWhereNull('delete_status');})->get();
        $market_creation=MarketCreation::select('id','area_name')->where(function($query){$query->where('delete_status', '0')->orWhereNull('delete_status');})->orderBy('area_name')->get();
        $dealer_creation=DealerCreation::select('id','dealer_name')->where(function($query){$query->where('delete_status', '0')->orWhereNull('delete_status');})->orderBy('dealer_name')->get();
        return view('Entry.sales_order_delivery.admin',['delivery_no_list'=>$delivery_no_list,'market_creation'=>$market_creation,'dealer_creation'=>$dealer_creation]);
    }
    public function retrieve($from_date_1,$to_date_1,$delivery_no_1,$dealer_creation_id_1,$status_1)
    {
        $cond="";
        if($from_date_1!=""){$cond.=" and dispatch_date>='".$from_date_1."'";}
        if($to_date_1!=""){$cond.=" and dispatch_date<='".$to_date_1."'";}
        if($delivery_no_1!=""){$cond.=" and delivery_no='".$delivery_no_1."'";}
        if($dealer_creation_id_1!=""){$cond.=" and dealer_creation_id=".$dealer_creation_id_1;}
        if($status_1!=""){$cond.=" and status=".$status_1;}
        $main_tb = (new SalesOrderDeliveryMain)->getTable();
        $sub_tb = (new SalesOrderDeliverySub)->getTable();
        $MarketCreation_tb = (new MarketCreation)->getTable();
        $DealerCreation_tb = (new DealerCreation)->getTable();
        $tb1=DB::select('select id,delivery_no,dispatch_date,(select dealer_name from '.$DealerCreation_tb.' where id='.$main_tb.'.dealer_creation_id) as dealer_name,status,(select IF(count(*)>0,CONCAT(sum(return_quantity),";",sum(item_weights),";",sum(total_amount)),"0;0;0") from '.$sub_tb.' where sales_order_main_id='.$main_tb.'.id and (delete_status=0 or delete_status is null)) as total_sublist from '.$main_tb.' where (delete_status=0 or delete_status is null)'.$cond);
        return json_decode(json_encode($tb1), true);
    }
    public function retrieve_main($id)
    {
        return SalesOrderDeliveryMain::select('id','delivery_no','dispatch_date','order_recipt_no','sales_exec','dealer_creation_id','status','description','vehile_name','driver_name','driver_number','tally_no')->where('id',$id)->get()->first();
    }
    public function retrieve_sub($main_id,$sub_id)
    {
        if($sub_id=='')
        {
            $sub_tb = (new SalesOrderDeliverySub)->getTable();
            $ItemCreation_tb = (new ItemCreation)->getTable();
            $ItemPropertiesType_tb = (new ItemPropertiesType)->getTable();
            $ItemLitersType_tb = (new ItemLitersType)->getTable();

            $tb1=DB::select('select id,order_recipt_sub_id as sub_id,order_date_sub,time_sub,item_creation_id,item_property,item_weights,order_quantity,balance_quantity,return_quantity,item_price,total_amount,dispatch_status from '.$sub_tb.' where sales_order_main_id='.$main_id.' and (delete_status=0 or delete_status is null)');

            return json_decode(json_encode($tb1), true);
        }
        else
        {return SalesOrderDeliverySub::where('id',$sub_id)->where(function($query){$query->where('delete_status', '0')->orWhereNull('delete_status');})->get(['id','order_date_sub','item_creation_id','item_property','item_weights','order_quantity','balance_quantity','return_quantity','item_price','total_amount','dispatch_status'])->first();}
    }
    public function db_cmd(Request $request)
    {
        $action=$request->input('action');

        if ($action == 'insert') {
            $main_id = $request->input('main_id');
            if (empty($main_id)) {
                $main_id = SalesOrderDeliveryMain::insertGetId([
                    'entry_date' => Carbon::now(),
                    'dispatch_date' => $request->input('dispatch_date'),
                    'delivery_no' => $request->input('delivery_no'),
                    'order_recipt_no' => $request->input('order_recipt_no'),
                    'sales_exec' => $request->input('sales_exec'),
                    'dealer_creation_id' => $request->input('dealer_creation_id'),
                    'status' => $request->input('status1'),
                    'driver_name' => $request->input('driver_name'),
                    'vehile_name' => $request->input('vehile_name'),
                    'driver_number' => $request->input('driver_number'),
                    'tally_no' => $request->input('tally_no'),
                    'description' => $request->input('description'),
                    'checkbox' => $request->input('checkbox'),
                ]);
            }

            $orderReciptSubIdArray = explode(',', $request->input('order_recipt_sub_id'));
            $orderDateSubArray = explode(',', $request->input('order_date_sub'));
            $itemCreationIdArray = explode(',', $request->input('item_creation_id'));
            $itemPropertyArray = explode(',', $request->input('item_property'));
            $itemWeightsArray = explode(',', $request->input('item_weights'));
            $orderQuantityArray = explode(',', $request->input('order_quantity'));
            $balanceQuantityArray = explode(',', $request->input('balance_quantity'));
            $returnQuantityArray = explode(',', $request->input('return_quantity'));
            $itemPriceArray = explode(',', $request->input('item_price'));
            $totalAmountArray = explode(',', $request->input('total_amount'));
            $balAmountArray = explode(',', $request->input('total_amount'));
            $dispatchStatusArray = explode(',', $request->input('dispatch_status'));

            foreach ($orderDateSubArray as $index => $orderDateSub) {
                SalesOrderDeliverySub::create([
                    'entry_date' => Carbon::now(),
                    'sales_order_main_id' => $main_id,
                    'order_date_sub' => $orderDateSub,
                    'order_recipt_sub_id' => $orderReciptSubIdArray[$index],
                    'item_creation_id' => $itemCreationIdArray[$index],
                    'item_property' => $itemPropertyArray[$index],
                    'item_weights' => $itemWeightsArray[$index],
                    'order_quantity' => $orderQuantityArray[$index],
                    $balance_quantity_sublist = $balanceQuantityArray[$index] - $returnQuantityArray[$index],
                    'balance_quantity' => $balance_quantity_sublist,
                    'return_quantity' => $returnQuantityArray[$index],
                    'item_price' => $itemPriceArray[$index],
                    'total_amount' => $totalAmountArray[$index],
                    $paid_amount = 0,
                    'paid_amount' => $paid_amount,
                    'bal_amount' => $balAmountArray[$index],
                    'dispatch_status' => $dispatchStatusArray[$index],
                ]);

                if($dispatchStatusArray[$index] == 1){

                    if($request->input('dealer_creation_id')){
                        $dealer_creation_id = $request->input('dealer_creation_id');
                    }else{
                        $sales_order_delivery_main = SalesOrderDeliveryMain::find($main_id);
                        $dealer_creation_id = $sales_order_delivery_main->dealer_creation_id;
                    }

                    $balance_quantity = $balanceQuantityArray[$index];
                    $return_quantity = $returnQuantityArray[$index];
                    $item_creation_id = $itemCreationIdArray[$index];
                    $item_property = $itemPropertyArray[$index];
                    $item_weights = $itemWeightsArray[$index];

                    if($balance_quantity && $return_quantity){

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
                            $dispatch_stock = $balance_quantity - $return_quantity;
                            $total_current_stock = $current_stock_value + $return_quantity;
                        }
                        else{
                            $dispatch_stock = 0;
                            $total_current_stock = 0;
                        }
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

                    $order_recipt_sub_id = $orderReciptSubIdArray[$index];

                    SalesOrderC2DSub::where('id', $order_recipt_sub_id)
                    ->update(['balance_quantity' => $dispatch_stock]);
                }
            }
        }

        else if ($action == 'update') {

            if ($request->input('id')) {
                $sales_order_main_id = $request->input('id');

                $sales_order_delivery_sub = SalesOrderDeliverySub::where('sales_order_main_id', $sales_order_main_id)->get();

                foreach ($sales_order_delivery_sub as $sub) {
                    $sales_order_delivery_main = SalesOrderDeliveryMain::find($sales_order_main_id);

                    $order_recipt_sub_id = $sub->order_recipt_sub_id;
                    $item_creation_id = $sub->item_creation_id;
                    $item_property = $sub->item_property;
                    $item_weights = $sub->item_weights;
                    $order_quantity = $sub->return_quantity;

                    $dealer_creation_id = $sales_order_delivery_main->dealer_creation_id;

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

                    $total_current_stock = $current_stock ? $current_stock->current_stock - $order_quantity : $order_quantity;

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

                    $sales_order_c2d_sub = SalesOrderC2DSub::find($order_recipt_sub_id);
                    $balance_quantity = $sales_order_c2d_sub->balance_quantity;

                    if ($sales_order_c2d_sub) {
                        $dispatch_stock = $balance_quantity + $order_quantity;
                    }
                    else{
                        $dispatch_stock = 0;
                    }

                    SalesOrderC2DSub::where('id', $order_recipt_sub_id)
                    ->update(['balance_quantity' => $dispatch_stock]);
                }
            }

            $main_id = $request->input('id');
            $mainRecord = SalesOrderDeliveryMain::find($main_id);

            if ($mainRecord) {
                $mainRecord->update([
                    'dispatch_date' => $request->input('dispatch_date'),
                    'delivery_no' => $request->input('delivery_no'),
                    'order_recipt_no' => $request->input('order_recipt_no'),
                    'sales_exec' => $request->input('sales_exec'),
                    'dealer_creation_id' => $request->input('dealer_creation_id'),
                    'status' => $request->input('status1'),
                    'driver_name' => $request->input('driver_name'),
                    'driver_number' => $request->input('driver_number'),
                    'vehile_name' => $request->input('vehile_name'),
                    'tally_no' => $request->input('tally_no'),
                    'description' => $request->input('description'),
                    'checkbox' => $request->input('checkbox'),
                ]);

                $orderReciptSubIdArray = explode(',', $request->input('order_recipt_sub_id'));
                $orderDateSubArray = explode(',', $request->input('order_date_sub'));
                $itemCreationIdArray = explode(',', $request->input('item_creation_id'));
                $itemPropertyArray = explode(',', $request->input('item_property'));
                $itemWeightsArray = explode(',', $request->input('item_weights'));
                $orderQuantityArray = explode(',', $request->input('order_quantity'));
                $balanceQuantityArray = explode(',', $request->input('balance_quantity'));
                $returnQuantityArray = explode(',', $request->input('return_quantity'));
                $itemPriceArray = explode(',', $request->input('item_price'));
                $totalAmountArray = explode(',', $request->input('total_amount'));
                $dispatchStatusArray = explode(',', $request->input('dispatch_status'));

                $subRecords = SalesOrderDeliverySub::where('sales_order_main_id', $main_id)->get();

                foreach ($orderDateSubArray as $index => $orderDateSub) {
                    if ($index < count($subRecords)) {
                        $subRecord = $subRecords[$index];
                        $subRecord->update([
                            'order_date_sub' => $orderDateSub,
                            'item_creation_id' => $itemCreationIdArray[$index],
                            'item_property' => $itemPropertyArray[$index],
                            'item_weights' => $itemWeightsArray[$index],
                            'order_quantity' => $orderQuantityArray[$index],
                            'balance_quantity' => $balanceQuantityArray[$index],
                            'return_quantity' => $returnQuantityArray[$index],
                            'item_price' => $itemPriceArray[$index],
                            'total_amount' => $totalAmountArray[$index],
                            'paid_amount' => 0,
                            'bal_amount' => $totalAmountArray[$index],
                            'dispatch_status' => $dispatchStatusArray[$index],
                        ]);
                        if($dispatchStatusArray[$index] == 1){

                            if($request->input('dealer_creation_id')){
                                $dealer_creation_id = $request->input('dealer_creation_id');
                            }else{
                                $sales_order_delivery_main = SalesOrderDeliveryMain::find($main_id);
                                $dealer_creation_id = $sales_order_delivery_main->dealer_creation_id;
                            }
                            $sales_order_c2d_sub = SalesOrderC2DSub::find($orderReciptSubIdArray[$index]);
                            $balance_quantity = $sales_order_c2d_sub->balance_quantity;
                            $return_quantity = $returnQuantityArray[$index];
                            $item_creation_id = $itemCreationIdArray[$index];
                            $item_property = $itemPropertyArray[$index];
                            $item_weights = $itemWeightsArray[$index];

                            if($balance_quantity && $return_quantity){

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
                                    $dispatch_stock = $balance_quantity - $return_quantity;
                                    $total_current_stock = $current_stock_value + $return_quantity;
                                }
                                }else{
                                    $dispatch_stock = 0;
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

                            $order_recipt_sub_id = $orderReciptSubIdArray[$index];

                            SalesOrderC2DSub::where('id', $order_recipt_sub_id)
                            ->update(['balance_quantity' => $dispatch_stock]);
                        }
                    }
                }
            }
        }
        else if($action=='delete')
        {
            if ($request->input('id')) {
                $sales_order_main_id = $request->input('id');

                $sales_order_delivery_sub = SalesOrderDeliverySub::where('sales_order_main_id', $sales_order_main_id)->get();

                foreach ($sales_order_delivery_sub as $sub) {
                    $sales_order_delivery_main = SalesOrderDeliveryMain::find($sales_order_main_id);

                    $order_recipt_sub_id = $sub->order_recipt_sub_id;
                    $item_creation_id = $sub->item_creation_id;
                    $item_property = $sub->item_property;
                    $item_weights = $sub->item_weights;
                    $order_quantity = $sub->return_quantity;

                    $dealer_creation_id = $sales_order_delivery_main->dealer_creation_id;

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

                    $total_current_stock = $current_stock ? $current_stock->current_stock - $order_quantity : $order_quantity;

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

                    $sales_order_c2d_sub = SalesOrderC2DSub::find($order_recipt_sub_id);
                    $balance_quantity = $sales_order_c2d_sub->balance_quantity;

                    if ($sales_order_c2d_sub) {
                        $dispatch_stock = $balance_quantity + $order_quantity;
                    }
                    else{
                        $dispatch_stock = 0;
                    }

                    SalesOrderC2DSub::where('id', $order_recipt_sub_id)
                    ->update(['balance_quantity' => $dispatch_stock]);
                }
            }

            $tb = SalesOrderDeliveryMain::find($request->input('id'));
            $tb->delete_status = "1";
            $tb->save();
        }
        else if($action=='retrieve')
        {
            $sales_order_delivery_main = $this->retrieve($request->input('from_date_1'),$request->input('to_date_1'),$request->input('delivery_no_1'),$request->input('dealer_creation_id_1'),$request->input('status_1'));
            return view('Entry.sales_order_delivery.list',['sales_order_delivery_main'=>$sales_order_delivery_main,'user_rights_edit_1'=>$request->input('user_rights_edit_1'),'user_rights_delete_1'=>$request->input('user_rights_delete_1')]);
        }
        else if($action=='create_form')
        {
            $order_no = SalesOrderC2DMain::select('id', 'order_no','order_date')
            ->where(function ($query) {
                $query->where('delete_status', '0')->orWhereNull('delete_status');
            })
            ->orderBy('id')
            ->get();
            $sales_name = SalesRepCreation::select('id', 'sales_ref_name')->where(function ($query) {
                $query->where('delete_status', '0')->orWhereNull('delete_status');
            })->orderBy('sales_ref_name')->get();
            $main_tb = (new SalesOrderDeliveryMain)->getTable();
            $next_id = DB::select("SHOW TABLE STATUS LIKE '".$main_tb."'");
            $delivery_no="DISPATCH_".date("ym")."_".$next_id[0]->Auto_increment;
            $market_creation=MarketCreation::select('id','area_name')->where(function($query){$query->where('delete_status', '0')->orWhereNull('delete_status');})->orderBy('area_name')->get();
            $shop_creation = ShopCreation::select('id', 'shop_name')->where(function ($query) {
                $query->where('delete_status', '0')->orWhereNull('delete_status');
            })->orderBy('shop_name')->get();
            $dealer_creation=DealerCreation::select('id','dealer_name')->where(function($query){$query->where('delete_status', '0')->orWhereNull('delete_status');})->orderBy('dealer_name')->get();
            return view('Entry.sales_order_delivery.create',['delivery_no'=>$delivery_no,"sales_name" => $sales_name,'market_creation'=>$market_creation,'order_no'=>$order_no,'dealer_creation'=>$dealer_creation,'shop_creation' =>$shop_creation]);
        }
        else if($action=='update_form')
        {
            $sales_order_delivery_main=$this->retrieve_main($request->input('id'));
            $order_no = SalesOrderC2DMain::select('id', 'order_no','order_date')
            ->where(function ($query) {
                $query->where('delete_status', '0')->orWhereNull('delete_status');
            })
            ->orderBy('id')
            ->get();
            $sales_name = SalesRepCreation::select('id', 'sales_ref_name')->where(function ($query) {
                $query->where('delete_status', '0')->orWhereNull('delete_status');
            })->orderBy('sales_ref_name')->get();
            $dealer_creation=DealerCreation::select('id','dealer_name')->where(function($query){$query->where('delete_status', '0')->orWhereNull('delete_status');})->orderBy('dealer_name')->get();
            return view('Entry.sales_order_delivery.update',['sales_order_delivery_main'=>$sales_order_delivery_main,'order_no'=>$order_no,"sales_name" => $sales_name,'dealer_creation'=>$dealer_creation]);
        }

        else if($action=='form_sublist')
        {
            $main_id=$request->input('main_id');$sub_id=$request->input('sub_id');
            $sales_order_delivery_sub=null;if($sub_id!=""){$sales_order_delivery_sub = $this->retrieve_sub($main_id,$sub_id);}
            $sales_order_delivery_sub_list=[];if($main_id!=""){$sales_order_delivery_sub_list = $this->retrieve_sub($main_id,'');}

            $checkbox = SalesOrderDeliveryMain::find($main_id)
            ->where(function ($query) {
                $query->where('delete_status', '0')->orWhereNull('delete_status');
            })
            ->orderBy('id')
            ->get();
            foreach($checkbox as $checkbox1){
                $check_box = $checkbox1->checkbox;
            }

            $item_creation=ItemCreation::select('id','item_name','distributor_rate')->where(function($query){$query->where('delete_status', '0')->orWhereNull('delete_status');})->orderBy('item_name')->get();

            $item_properties_type=ItemPropertiesType::select('id','item_properties_type')->where('status1', '1')->where(function($query){$query->where('delete_status', '0')->orWhereNull('delete_status');})->orderBy('item_properties_type')->get();

            $item_liters_type=ItemLitersType::select('id','item_liters_type')->where('status1', '1')->where(function($query){$query->where('delete_status', '0')->orWhereNull('delete_status');})->orderBy('item_liters_type')->get();

            return view('Entry.sales_order_delivery.sublist',['sales_order_delivery_sub'=>$sales_order_delivery_sub,'sales_order_delivery_sub_list'=>$sales_order_delivery_sub_list,'main_id'=>$main_id,'sub_id'=>$sub_id,'checkbox'=>$check_box,'item_creation'=>$item_creation,'item_properties_type'=>$item_properties_type,'item_liters_type'=>$item_liters_type,'user_rights_edit_1'=>$request->input('user_rights_edit_1'),'user_rights_delete_1'=>$request->input('user_rights_delete_1')]);
        }
        else if($action=='getorderrecipt')
        {
            $order_recipt_no = $request->input('order_recipt_no');

            $sales_order_delivery_sub_list = [];

            $sales_order_delivery_sub_list = SalesOrderC2DSub::select('id as sub_id','item_creation_id','order_quantity','balance_quantity','item_property','item_weights','item_price','total_amount')
            ->where('sales_order_main_id', $order_recipt_no)
            ->where(function ($query) {
                $query->where('delete_status', '0')->orWhereNull('delete_status');
            })
            ->orderBy('id')
            ->get();

            $item_creation=ItemCreation::select('id','item_name','distributor_rate')->where(function($query){$query->where('delete_status', '0')->orWhereNull('delete_status');})->orderBy('item_name')->get();

            $item_properties_type=ItemPropertiesType::select('id','item_properties_type')->where('status1', '1')->where(function($query){$query->where('delete_status', '0')->orWhereNull('delete_status');})->orderBy('item_properties_type')->get();

            $item_liters_type=ItemLitersType::select('id','item_liters_type')->where('status1', '1')->where(function($query){$query->where('delete_status', '0')->orWhereNull('delete_status');})->orderBy('item_liters_type')->get();

            $check_box=0;
            // return $sales_order_delivery_sub_list;
            return view('Entry.sales_order_delivery.sublist',['sales_order_delivery_sub_list'=>$sales_order_delivery_sub_list,'item_creation'=>$item_creation,'checkbox'=>$check_box,'item_properties_type'=>$item_properties_type,'item_liters_type'=>$item_liters_type]);
        }

        else if ($action == 'getmarket') {

            $dealer_creation_id = $request->input('dealer_creation_id');

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

            return response()->json($area_names);
        }
        else if ($action == 'getshop') {

            $market_creation_id = $request->input('market_creation_id');

            $shop_name = ShopCreation::select('id', 'shop_name')
            ->where('beats_id', $market_creation_id)
            ->get();

            return response()->json($shop_name);
        }
        else if ($action == 'getdearlername') {

            $sales_exec = $request->input('sales_exec');

            $dealer_name = DealerCreation::select('id', 'dealer_name')
            ->where('sales_rep_id', $sales_exec)
            ->get();

            return response()->json($dealer_name);
        }
        else if ($action == 'getreciptno') {

            $sales_exec = $request->input('sales_exec');
            $dealer_creation_id = $request->input('dealer_creation_id');

            $SalesOrderC2DMain_tb = (new SalesOrderC2DMain)->getTable();
            $SalesOrderC2DSub_tb = (new SalesOrderC2DSub)->getTable();

            $order_no = SalesOrderC2DMain::join($SalesOrderC2DSub_tb, $SalesOrderC2DSub_tb . '.sales_order_main_id', '=', $SalesOrderC2DMain_tb . '.id')
            ->select($SalesOrderC2DMain_tb . '.id', $SalesOrderC2DMain_tb . '.order_no', $SalesOrderC2DMain_tb . '.order_date')
            ->where($SalesOrderC2DMain_tb . '.sales_exec', $sales_exec)
            ->where($SalesOrderC2DMain_tb . '.dealer_creation_id', $dealer_creation_id)
            ->where($SalesOrderC2DSub_tb . '.balance_quantity', '!=', '0')
            ->where(function ($query) use ($SalesOrderC2DMain_tb) {
                $query->where($SalesOrderC2DMain_tb . '.delete_status', '0')
                    ->orWhereNull($SalesOrderC2DMain_tb . '.delete_status');
            })
            ->groupBy(
                $SalesOrderC2DMain_tb . '.id',
                $SalesOrderC2DMain_tb . '.order_no',
                $SalesOrderC2DMain_tb . '.order_date'
            )
            ->orderBy($SalesOrderC2DMain_tb . '.id')
            ->get();

            return response()->json($order_no);
        }
        else if ($action == 'getsalesrepmain') {

            $order_recipt_no = $request->input('order_recipt_no');

            $sales_order_c2d_main = SalesOrderC2DMain::find($order_recipt_no);
            $sales_exec = $sales_order_c2d_main->sales_exec;

            $sales_rep_name = SalesRepCreation::select('id', 'sales_ref_name')
            ->where('id', $sales_exec)
            ->get();

            return response()->json($sales_rep_name);
        }
        else if ($action == 'getdealermain') {

            $order_recipt_no = $request->input('order_recipt_no');

            $sales_order_c2d_main = SalesOrderC2DMain::find($order_recipt_no);
            $dealer_creation_id = $sales_order_c2d_main->dealer_creation_id;

            $dealer_name = DealerCreation::select('id', 'dealer_name')
            ->where('id', $dealer_creation_id)
            ->get();

            return response()->json($dealer_name);
        }
    }
}
