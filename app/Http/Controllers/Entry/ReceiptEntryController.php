<?php

namespace App\Http\Controllers\Entry;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Entry\ReceiptEntry;
use App\Models\Entry\ReceiptEntryTallySublist;
use App\Models\Entry\ReceiptEntrySub;
use App\Models\Entry\SalesOrderDeliveryMain;
use App\Models\Entry\SalesOrderDeliverySub;
use App\Models\Entry\SalesOrderC2DMain;
use App\Models\Entry\SalesOrderC2DSub;
use App\Models\AccountLedger;
use App\Models\MarketCreation;
use App\Models\MarketManagerCreation;
use App\Models\DealerCreation;
use App\Models\ItemCreation;
use App\Models\ItemLitersType;
use App\Models\ItemPropertiesType;
use App\Models\SalesRepCreation;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReceiptEntryController extends Controller
{
    public function receipt_entry_admin()
    {
        $ledger_name = AccountLedger::select('id', 'ledger_name')->where(function ($query) {
            $query->where('delete_status', '0')->orWhereNull('delete_status');
        })->orderBy('ledger_name')->get();
        return view('Entry.receipt_entry.admin', ['ledger_name' => $ledger_name]);
    }
    public function retrieve($from_date_1, $to_date_1, $ledger_name_1)
    {
        $cond = "";
        $bindings = [];

        if ($from_date_1 != "") {
            $cond .= " and order_date >= :from_date";
            $bindings['from_date'] = $from_date_1;
        }
        if ($to_date_1 != "") {
            $cond .= " and order_date <= :to_date";
            $bindings['to_date'] = $to_date_1;
        }
        if ($ledger_name_1 != "") {
            $cond .= " and ledger_dr=" . $ledger_name_1;
        }

        $main_tb = (new ReceiptEntry)->getTable();
        $accountledgers_tb = (new AccountLedger)->getTable();

        $query = "SELECT id, order_date, order_no,tally_no,
              (SELECT ledger_name FROM $accountledgers_tb WHERE id = $main_tb.ledger_dr) as ledger_dr
              FROM $main_tb
              WHERE (delete_status=0 or delete_status is null) $cond";

        $results = DB::select($query, $bindings);

        return json_decode(json_encode($results), true);
    }

    public function retrieve_main($id)
    {
        return ReceiptEntry::select('id', 'order_date', 'order_no', 'ledger_dr', 'comment', 'tally_no', 'manager_id','sales_exec', 'dealer_creation_id')->where('id', $id)->get()->first();
    }
    public function retrieve_sub($main_id, $sub_id)
    {
        if ($sub_id == '') {
            $sub_tb = (new ReceiptEntrySub)->getTable();
            $accountledgers_tb = (new AccountLedger)->getTable();
            $tb1 = DB::select('select id,(select ledger_name from ' . $accountledgers_tb . ' where id=' . $sub_tb . '.ledger_cr) as ledger_cr,description1,amount from ' . $sub_tb . ' where receipt_entry_main_id=' . $main_id . ' and (delete_status=0 or delete_status is null)');
            return json_decode(json_encode($tb1), true);
        } else {
            return ReceiptEntrySub::where('id', '=', $sub_id)->where(function ($query) {
                $query->where('delete_status', '0')->orWhereNull('delete_status');
            })->get(['id', 'ledger_cr', 'description1', 'amount'])->first();
        }
    }

    public function retrieve_sub_1($main_id, $sub_id)
    {
        if ($sub_id == '') {
            $sub_tb = (new ReceiptEntry)->getTable();
            $ItemCreation_tb = (new ItemCreation)->getTable();
            $ItemPropertiesType_tb = (new ItemPropertiesType)->getTable();
            $ItemLitersType_tb = (new ItemLitersType)->getTable();

            $tb1 = DB::select("SELECT id, tally_no AS sub_id, item_creation_id, total_amount, total_amount_1, paid_amount,'pay_amount' FROM {$sub_tb} WHERE delete_status = 0 OR delete_status IS NULL");


            return json_decode(json_encode($tb1), true);
        } else {
            return ReceiptEntry::where('id', $sub_id)->where(function ($query) {
                $query->where('delete_status', '0')->orWhereNull('delete_status');
            })->get(['id', 'item_creation_id', 'total_amount', 'total_amount_1', 'paid_amount','pay_amount', 'check_amount'])->first();
        }
    }

    public function db_cmd(Request $request)
    {
        $action = $request->input('action');
        if ($action == 'insert') {

            $main_id = $request->input('main_id');
            if (empty($main_id)) {
                $main_id = ReceiptEntry::insertGetId([
                    'order_date' => $request->input('order_date'),
                    'order_no' => $request->input('order_no'),
                    'ledger_dr' => $request->input('ledger_dr'),
                    'comment' => $request->input('comment'),
                    'tally_no' => $request->input('tally_no'),
                    'manager_id' => $request->input('manager_id'),
                    'sales_exec' => $request->input('sales_exec'),
                    'dealer_creation_id' => $request->input('dealer_creation_id'),
                ]);
            }

            $orderDateSubArray = explode(',', $request->input('order_date_sub'));
            $itemCreationIdArray = explode(',', $request->input('item_creation_id'));
            $totalAmountArray = explode(',', $request->input('total_amount'));
            $paidAmountArray = explode(',', $request->input('paid_amount'));
            $balAmountArray = explode(',', $request->input('bal_amount'));
            $payAmountArray = explode(',', $request->input('pay_amount'));
            $checkAmountArray = explode(',', $request->input('check_amount'));

            foreach ($orderDateSubArray as $index => $orderDateSub) {
                ReceiptEntryTallySublist::create([
                    'entry_date' => Carbon::now(),
                    'receipt_entry_main_id' => $main_id,
                    'order_date_sub' => $orderDateSub,
                    'item_creation_id' => $itemCreationIdArray[$index],
                    'total_amount' => $totalAmountArray[$index],
                    $paid_amount = intval($paidAmountArray[$index]) + intval($payAmountArray[$index]),
                    'paid_amount' => $paid_amount,
                    $bal_amount = intval($balAmountArray[$index]) - intval($payAmountArray[$index]),
                    'bal_amount' => $bal_amount,
                    'pay_amount' => $payAmountArray[$index],
                    'check_amount' => $checkAmountArray[$index],
                ]);

            }
            $sales_delivery_tally = $request->input('tally_no');

            $subRecords = SalesOrderDeliverySub::where('sales_order_main_id', $sales_delivery_tally)->get();

            foreach ($totalAmountArray as $index => $totalAmount) {
                if ($index < count($subRecords)) {
                    $subRecord = $subRecords[$index];
                    $subRecord->update([
                        $paid_amount = intval($paidAmountArray[$index]) + intval($payAmountArray[$index]),
                        'paid_amount' => $paid_amount,
                        $bal_amount = intval($balAmountArray[$index]) - intval($payAmountArray[$index]),
                        'bal_amount' => $bal_amount,
                    ]);
                }
            }

        } else if ($action == 'update') {

            if ($request->input('id')) {
                $receipt_entry_main_id_12 = $request->input('id');
            
                $receipt_entry_tally_sublist_456 = ReceiptEntryTallySublist::where('receipt_entry_main_id', $receipt_entry_main_id_12)->get();
            
                $itemCreationIdArray_12 = [];
                $totalAmountArray_12 = [];
                $paidAmountArray_12 = [];
                $balAmountArray_12 = [];
                $payAmountArray_12 = [];
            
                foreach ($receipt_entry_tally_sublist_456 as $sub_12) {
                    $receipt_entry_main = ReceiptEntry::find($receipt_entry_main_id_12);
        
                    $itemCreationIdArray_12 = array_merge($itemCreationIdArray_12, explode(',', $sub_12->item_creation_id));
                    $totalAmountArray_12 = array_merge($totalAmountArray_12, explode(',', $sub_12->total_amount));
                    $paidAmountArray_12 = array_merge($paidAmountArray_12, explode(',', $sub_12->paid_amount));
                    $balAmountArray_12 = array_merge($balAmountArray_12, explode(',', $sub_12->bal_amount));
                    $payAmountArray_12 = array_merge($payAmountArray_12, explode(',', $sub_12->pay_amount));
                }
            
                $subRecords_12 = ReceiptEntryTallySublist::where('receipt_entry_main_id', $receipt_entry_main_id_12)->get();
            
                foreach ($itemCreationIdArray_12 as $index => $itemCreationId_12) {

                    if ($index < count($subRecords_12)) {
                        $subRecord_12 = $subRecords_12[$index];
                        $paid_amount_12 = intval($paidAmountArray_12[$index]) - intval($payAmountArray_12[$index]);
                        $bal_amount_12 = intval($balAmountArray_12[$index]) + intval($payAmountArray_12[$index]);
            
                        $subRecord_12->update([
                            'item_creation_id' => $itemCreationId_12,
                            'total_amount' => $totalAmountArray_12[$index],
                            'paid_amount' => $paid_amount_12,
                            'bal_amount' => $bal_amount_12,
                            'pay_amount' => $payAmountArray_12[$index],
                        ]);
                    }
                }
            
                $sales_delivery_tally_12 = $request->input('tally_no');
            
                $subRecords_12 = SalesOrderDeliverySub::where('sales_order_main_id', $sales_delivery_tally_12)->get();
            
                foreach ($totalAmountArray_12 as $index => $totalAmount_12) {
                    if ($index < count($subRecords_12)) {
                        $subRecord_12 = $subRecords_12[$index];
                        $paid_amount_12 = intval($paidAmountArray_12[$index]) - intval($payAmountArray_12[$index]);
                        $bal_amount_12 = intval($balAmountArray_12[$index]) + intval($payAmountArray_12[$index]);
            
                        $subRecord_12->update([
                            'paid_amount' => $paid_amount_12,
                            'bal_amount' => $bal_amount_12,
                        ]);
                    }
                }

                $main_id = $request->input('id');
                $mainRecord = ReceiptEntry::find($main_id);

                $mainRecord->update([
                    'order_date' => $request->input('order_date'),
                    'order_no' => $request->input('order_no'),
                    'ledger_dr' => $request->input('ledger_dr'),
                    'comment' => $request->input('comment'),
                    'tally_no' => $request->input('tally_no'),
                    'manager_id' => $request->input('manager_id'),
                    'sales_exec' => $request->input('sales_exec'),
                    'dealer_creation_id' => $request->input('dealer_creation_id'),
                ]);

                $receipt_entry_tally_sublist_45 = ReceiptEntryTallySublist::where('receipt_entry_main_id', $main_id)->get();

                $totalAmountArray = [];
                $paidAmountArray = [];
                $balAmountArray = [];

                foreach ($receipt_entry_tally_sublist_45 as $sub_123) {
                    $receipt_entry_main = ReceiptEntry::find($main_id);
        
                    $totalAmountArray = array_merge($totalAmountArray, explode(',', $sub_123->total_amount));
                    $paidAmountArray = array_merge($paidAmountArray, explode(',', $sub_123->paid_amount));
                    $balAmountArray = array_merge($balAmountArray, explode(',', $sub_123->bal_amount));
                }
            
                $orderDateSubArray = explode(',', $request->input('order_date_sub'));
                $itemCreationIdArray = explode(',', $request->input('item_creation_id'));
                $payAmountArray = explode(',', $request->input('pay_amount'));
                $checkAmountArray = explode(',', $request->input('check_amount'));
            
                $subRecords = ReceiptEntryTallySublist::where('receipt_entry_main_id', $main_id)->get();
            
                foreach ($orderDateSubArray as $index => $orderDateSub) {
                    if ($index < count($subRecords)) {
                        $subRecord = $subRecords[$index];
                        $paid_amount = intval($paidAmountArray[$index]) + intval($payAmountArray[$index]);
                        $bal_amount = intval($balAmountArray[$index]) - intval($payAmountArray[$index]);
            
                        $subRecord->update([
                            'entry_date' => Carbon::now(),
                            'order_date_sub' => $orderDateSub,
                            'item_creation_id' => $itemCreationIdArray[$index],
                            'total_amount' => $totalAmountArray[$index],
                            'paid_amount' => $paid_amount,
                            'bal_amount' => $bal_amount,
                            'pay_amount' => $payAmountArray[$index],
                            'check_amount' => $checkAmountArray[$index],
                        ]);
                    }
                } 

                $sales_delivery_tally = $request->input('tally_no');

                $subRecords = SalesOrderDeliverySub::where('sales_order_main_id', $sales_delivery_tally)->get();

                foreach ($totalAmountArray as $index => $totalAmount) {
                    if ($index < count($subRecords)) {
                        $subRecord = $subRecords[$index];
                        $subRecord->update([
                            $paid_amount = intval($paidAmountArray[$index]) + intval($payAmountArray[$index]),
                            'paid_amount' => $paid_amount,
                            $bal_amount = intval($balAmountArray[$index]) - intval($payAmountArray[$index]),
                            'bal_amount' => $bal_amount,
                        ]);
                    }
                }
            }

        } else if ($action == 'delete') {

            $receipt_entry = ReceiptEntry::find($request->input('id'));
            $tally_no = $receipt_entry->tally_no;

            if ($tally_no) {

                $receipt_entry_main_id = $request->input('id');
            
                $receipt_entry_tally_sublist = ReceiptEntryTallySublist::where('receipt_entry_main_id', $receipt_entry_main_id)->get();
            
                $itemCreationIdArray = [];
                $totalAmountArray = [];
                $paidAmountArray = [];
                $balAmountArray = [];
                $payAmountArray = [];
            
                foreach ($receipt_entry_tally_sublist as $sub) {
                    $receipt_entry_main = ReceiptEntry::find($receipt_entry_main_id);
        
                    $itemCreationIdArray = array_merge($itemCreationIdArray, explode(',', $sub->item_creation_id));
                    $totalAmountArray = array_merge($totalAmountArray, explode(',', $sub->total_amount));
                    $paidAmountArray = array_merge($paidAmountArray, explode(',', $sub->paid_amount));
                    $balAmountArray = array_merge($balAmountArray, explode(',', $sub->bal_amount));
                    $payAmountArray = array_merge($payAmountArray, explode(',', $sub->pay_amount));
                }
            
                $subRecords = ReceiptEntryTallySublist::where('receipt_entry_main_id', $receipt_entry_main_id)->get();
            
                foreach ($itemCreationIdArray as $index => $itemCreationId) {

                    if ($index < count($subRecords)) {
                        $subRecord = $subRecords[$index];
                        $paid_amount = intval($paidAmountArray[$index]) - intval($payAmountArray[$index]);
                        $bal_amount = intval($balAmountArray[$index]) + intval($payAmountArray[$index]);
            
                        $subRecord->update([
                            'item_creation_id' => $itemCreationId,
                            'total_amount' => $totalAmountArray[$index],
                            'paid_amount' => $paid_amount,
                            'bal_amount' => $bal_amount,
                            'pay_amount' => $payAmountArray[$index],
                        ]);
                    }
                }
            
                $subRecords = SalesOrderDeliverySub::where('sales_order_main_id', $tally_no)->get();
            
                foreach ($totalAmountArray as $index => $totalAmount) {
                    if ($index < count($subRecords)) {
                        $subRecord = $subRecords[$index];
                        $paid_amount = intval($paidAmountArray[$index]) - intval($payAmountArray[$index]);
                        $bal_amount = intval($balAmountArray[$index]) + intval($payAmountArray[$index]);
            
                        $subRecord->update([
                            'paid_amount' => $paid_amount,
                            'bal_amount' => $bal_amount,
                        ]);
                    }
                }
                $tb = ReceiptEntry::find($request->input('id'));
                $tb->delete_status = "1";
                $tb->save();
            }else{
                $tb = ReceiptEntry::find($request->input('id'));
                $tb->delete_status = "1";
                $tb->save();
            }

        } else if ($action == 'insert_sub') {
            $main_id = $request->input('main_id');
            if ($main_id == '') {
                $main_id = ReceiptEntry::insertGetId([
                    'order_date' => $request->input('order_date'),
                    'ledger_dr' => $request->input('ledger_dr'),
                    'order_no' => $request->input('order_no'),
                    'comment' => $request->input('comment'),
                    'tally_no' => $request->input('tally_no'),
                    'manager_id' => $request->input('manager_id'),
                    'sales_exec' => $request->input('sales_exec'),
                    'dealer_creation_id' => $request->input('dealer_creation_id')

                ]);
            }
            $tb = new ReceiptEntrySub();
            $tb->receipt_entry_main_id = $main_id;
            $tb->ledger_cr = $request->input('ledger_cr');
            $tb->description1 = $request->input('description1');
            $tb->amount = $request->input('amount');
            $tb->save();
            return $main_id;
        } else if ($action == 'update_sub') {
            $tb = ReceiptEntrySub::find($request->input('id'));
            $tb->ledger_cr = $request->input('ledger_cr');
            $tb->description1 = $request->input('description1');
            $tb->amount = $request->input('amount');
            $tb->save();
        } else if ($action == 'delete_sub') {
            $tb = ReceiptEntrySub::find($request->input('id'));
            $tb->delete_status = "1";
            $tb->save();
        } else if ($action == 'retrieve') {
            $receipt_entry_main = $this->retrieve($request->input('from_date_1'), $request->input('to_date_1'), $request->input('ledger_name_1'), $request->input('tally_no'));

            $ledger_name = AccountLedger::select('id', 'ledger_name')->where(function ($query) {
                $query->where('delete_status', '0')->orWhereNull('delete_status');
            })->orderBy('ledger_name')->get();

            return view('Entry.receipt_entry.list', ['receipt_entry_main' => $receipt_entry_main, 'ledger_name' => $ledger_name, 'user_rights_edit_1' => $request->input('user_rights_edit_1'), 'user_rights_delete_1' => $request->input('user_rights_delete_1')]);
        } else if ($action == 'create_form') {
            $main_tb = (new ReceiptEntry)->getTable();
            $next_id = DB::select("SHOW TABLE STATUS LIKE '" . $main_tb . "'");
            $order_no = "REC_" . date("ym") . "_" . $next_id[0]->Auto_increment;

            $ledger_name = AccountLedger::select('id', 'ledger_name')->where(function ($query) {
                $query->where('delete_status', '0')->orWhereNull('delete_status');
            })->orderBy('ledger_name')->get();

            $taally_no = SalesOrderDeliveryMain::select('id', 'tally_no')->where(function ($query) {
                $query->where('delete_status', '0')->orWhereNull('delete_status');
            })->orderBy('tally_no')->get();

            $manager_creation=MarketManagerCreation::select('id','manager_name')->where('delete_status', '0')->orWhereNull('delete_status')->orderBy('manager_no')->get();

            $sales_name = SalesRepCreation::select('id', 'sales_ref_name')->where(function ($query) {
                $query->where('delete_status', '0')->orWhereNull('delete_status');
            })->orderBy('sales_ref_name')->get();

            $dealer_creation = DealerCreation::select('id', 'dealer_name')->orderBy('dealer_name')->get();

            // return  $dealer_creation;
            return view('Entry.receipt_entry.create', ['order_no' => $order_no, 'ledger_name' => $ledger_name, 'taally_no' => $taally_no, 'manager_creation' => $manager_creation, "sales_name" => $sales_name, 'dealer_creation' => $dealer_creation]);
        } else if ($action == 'update_form') {
            $receipt_entry_main = $this->retrieve_main($request->input('id'), $request->input('tally_no'));

            $ledger_name = AccountLedger::select('id', 'ledger_name')->where(function ($query) {
                $query->where('delete_status', '0')->orWhereNull('delete_status');
            })->orderBy('ledger_name')->get();

            $taally_no = SalesOrderDeliveryMain::select('id', 'tally_no')->where(function ($query) {
                $query->where('delete_status', '0')->orWhereNull('delete_status');
            })->orderBy('tally_no')->get();

            $manager_creation=MarketManagerCreation::select('id','manager_name')->where('delete_status', '0')->orWhereNull('delete_status')->orderBy('manager_no')->get();

            $sales_name = SalesRepCreation::select('id', 'sales_ref_name')->where(function ($query) {
                $query->where('delete_status', '0')->orWhereNull('delete_status');
            })->orderBy('sales_ref_name')->get();

            $dealer_creation = DealerCreation::select('id', 'dealer_name')->orderBy('dealer_name')->get();

            return view('Entry.receipt_entry.update', ['receipt_entry_main' => $receipt_entry_main, 'ledger_name' => $ledger_name, 'taally_no' => $taally_no, 'manager_creation' => $manager_creation,"sales_name" => $sales_name, 'dealer_creation' => $dealer_creation]);
        } else if ($action == 'form_sublist') {
            $main_id = $request->input('main_id');
            $sub_id = $request->input('sub_id');
            $receipt_entry_sub = null;
            if ($sub_id != "") {
                $receipt_entry_sub = $this->retrieve_sub($main_id, $sub_id);
            }
            $receipt_entry_sub_list = [];
            if ($main_id != "") {
                $receipt_entry_sub_list = $this->retrieve_sub($main_id, '');
            }

            $ledger_name = AccountLedger::select('id', 'ledger_name')->where(function ($query) {
                $query->where('delete_status', '0')->orWhereNull('delete_status');
            })->orderBy('ledger_name')->get();

            return view('Entry.receipt_entry.sublist', ['receipt_entry_sub' => $receipt_entry_sub, 'receipt_entry_sub_list' => $receipt_entry_sub_list, 'ledger_name' => $ledger_name, 'main_id' => $main_id, 'sub_id' => $sub_id, 'user_rights_edit_1' => $request->input('user_rights_edit_1'), 'user_rights_delete_1' => $request->input('user_rights_delete_1')]);
        } else if ($action == 'form_sublist_rep') {
            $main_id = $request->input('id');
            $tally = $request->input('tally_no');
            $main_id = $request->input('main_id');
            $sub_id = $request->input('sub_id');


            $item_creation = ItemCreation::select('id', 'item_name', 'distributor_rate')->where(function ($query) {
                $query->where('delete_status', '0')->orWhereNull('delete_status');
            })->orderBy('item_name')->get();



            $item_properties_type = ItemPropertiesType::select('id', 'item_properties_type')->where('status1', '1')->where(function ($query) {
                $query->where('delete_status', '0')->orWhereNull('delete_status');
            })->orderBy('item_properties_type')->get();

            $item_liters_type = ItemLitersType::select('id', 'item_liters_type')->where('status1', '1')->where(function ($query) {
                $query->where('delete_status', '0')->orWhereNull('delete_status');
            })->orderBy('item_liters_type')->get();

            $mani_val_get = ReceiptEntry::where('id', $main_id)->where(function ($query) {
                $query->where('delete_status', '0')->orWhereNull('delete_status');
            })->get(['id', 'item_creation_id', 'total_amount', 'total_amount_1', 'order_date'])->first();
            // return $mani_val_get;
            return view('Entry.receipt_entry.c2d_rep_update_sub', [
                'main_id' => $main_id,
                'mani_val_get' => $mani_val_get,
                'item_creation' => $item_creation, 'tally' => $tally,
                'item_properties_type' => $item_properties_type,
                'item_liters_type' => $item_liters_type,
                'user_rights_edit_1' => $request->input('user_rights_edit_1'), 'user_rights_delete_1' => $request->input('user_rights_delete_1')
            ]);
        } else if ($action == 'getorderrecipt') {
            $tally_no = $request->input('tally_no');

            $sales_order_delivery_sub_list = [];

            $sales_order_delivery_sub_list = SalesOrderDeliverySub::select('id as sub_id', 'item_creation_id', 'order_quantity', 'balance_quantity', 'item_property', 'item_weights', 'item_price', 'total_amount')
                ->where('sales_order_main_id', $tally_no)
                ->where(function ($query) {
                    $query->where('delete_status', '0')->orWhereNull('delete_status');
                })
                ->orderBy('id')
                ->get();
            $receiptEntry = ReceiptEntry::select('id', 'total_amount_1')->where(function ($query) {
                $query->where('delete_status', '0')->orWhereNull('delete_status');
            })->orderBy('total_amount_1')->get();

            $balance_amt = SalesOrderDeliverySub::select('id', 'total_amount')->orderBy('total_amount')->get();

            $item_creation = ItemCreation::select('id', 'item_name', 'distributor_rate')->where(function ($query) {
                $query->where('delete_status', '0')->orWhereNull('delete_status');
            })->orderBy('item_name')->get();

            // return $sales_order_delivery_sub_list;
            return view('Entry.receipt_entry.c2d_rep_sublist', ['sales_order_delivery_sub_list' => $sales_order_delivery_sub_list, 'item_creation' => $item_creation, 'receiptEntry' => $receiptEntry, 'balance_amt'  => $balance_amt]);
        }

        else if ($action == 'gettally') {

            $tally_no = $request->input('tally_no');

            $sales_order_delivery_sub_list = [];

            $SalesOrderDeliveryMain_tb = (new SalesOrderDeliveryMain)->getTable();
            $SalesOrderDeliverySub_tb = (new SalesOrderDeliverySub)->getTable();

            $sales_order_delivery_sub_list = SalesOrderDeliverySub::select($SalesOrderDeliveryMain_tb . '.tally_no',$SalesOrderDeliverySub_tb . '.id as sub_id',$SalesOrderDeliverySub_tb . '.order_date_sub',$SalesOrderDeliverySub_tb . '.item_creation_id',$SalesOrderDeliverySub_tb . '.total_amount',$SalesOrderDeliverySub_tb . '.paid_amount',$SalesOrderDeliverySub_tb . '.bal_amount')
            ->join($SalesOrderDeliveryMain_tb, $SalesOrderDeliveryMain_tb . '.id', '=', $SalesOrderDeliverySub_tb . '.sales_order_main_id')
            ->where($SalesOrderDeliveryMain_tb . '.id', '=', $tally_no)
            ->where(function ($query) use ($SalesOrderDeliveryMain_tb) {
                $query->where($SalesOrderDeliveryMain_tb . '.delete_status', '0')
                    ->orWhereNull($SalesOrderDeliveryMain_tb . '.delete_status');
            })
            ->where(function ($query) use ($SalesOrderDeliverySub_tb) {
                $query->where($SalesOrderDeliverySub_tb . '.delete_status', '0')
                    ->orWhereNull($SalesOrderDeliverySub_tb . '.delete_status');
            })
            ->get();

            $item_creation=ItemCreation::select('id','item_name','distributor_rate')->where(function($query){$query->where('delete_status', '0')->orWhereNull('delete_status');})->orderBy('item_name')->get();

            $balance_amt = SalesOrderDeliverySub::select('id','total_amount')->orderBy('total_amount')->get();

            return view('Entry.receipt_entry.c2d_rep_sublist',['sales_order_delivery_sub_list'=>$sales_order_delivery_sub_list,'item_creation'=>$item_creation,'balance_amt'  => $balance_amt]);

        } else if ($action == 'getorderrecipt1') {
            $tally_no = $request->input('tally_no');
            $order_no = $request->input('order_no');

            $sales_order_delivery_sub_list = [];

            $receipt_entry = (new ReceiptEntry)->getTable();
            $receipt_entry_tally_sublist = (new ReceiptEntryTallySublist)->getTable();

            $sales_order_delivery_sub_list = ReceiptEntry::select(
                'receipt_entry.id',
                'receipt_entry_tally_sublist.item_creation_id',
                'receipt_entry_tally_sublist.total_amount',
                'receipt_entry_tally_sublist.total_amount_1',
                'receipt_entry_tally_sublist.bal_amount',
                'receipt_entry_tally_sublist.pay_amount',
                'receipt_entry_tally_sublist.check_amount'
            )
            ->join(
                'receipt_entry_tally_sublist',
                'receipt_entry_tally_sublist.receipt_entry_main_id',
                '=',
                'receipt_entry.id'
            )
            ->where('receipt_entry.tally_no', $tally_no)
            ->where('receipt_entry.order_no', $order_no)
            ->where(function ($query) use ($receipt_entry) {
                $query->where('receipt_entry.delete_status', '0')
                    ->orWhereNull('receipt_entry.delete_status');
            })
            ->orderBy('receipt_entry.id')
            ->get();


            $item_creation = ItemCreation::select('id', 'item_name', 'distributor_rate')->where(function ($query) {
                $query->where('delete_status', '0')->orWhereNull('delete_status');
            })->orderBy('item_name')->get();

            $balance_amt = SalesOrderDeliverySub::select('id', 'total_amount')->orderBy('total_amount')->get();


            // return($sales_order_delivery_sub_list);
            return view('Entry.receipt_entry.c2d_rep_sublist', [
                'sales_order_delivery_sub_list' => $sales_order_delivery_sub_list,
                'item_creation' => $item_creation,
                'balance_amt'  => $balance_amt,

            ]);
        }



        else if ($action == 'getorderrecipt3') {
            $main_id = $request->input('id');
            $tally_no = $request->input('tally_no');
            $order_no = $request->input('order_no');

            $sales_order_delivery_sub_list = [];

            $receipt_entry = (new ReceiptEntry)->getTable();
            $receipt_entry_tally_sublist = (new ReceiptEntryTallySublist)->getTable();

            $sales_order_delivery_sub_list = ReceiptEntry::select(
                'receipt_entry.id',
                'receipt_entry_tally_sublist.item_creation_id',
                'receipt_entry_tally_sublist.total_amount',
                'receipt_entry_tally_sublist.total_amount_1',
                'receipt_entry_tally_sublist.paid_amount',
                'receipt_entry_tally_sublist.bal_amount',
                'receipt_entry_tally_sublist.pay_amount',
                'receipt_entry_tally_sublist.check_amount'
            )
            ->join(
                'receipt_entry_tally_sublist',
                'receipt_entry_tally_sublist.receipt_entry_main_id',
                '=',
                'receipt_entry.id'
            )
            ->where('receipt_entry.id', $main_id)
            ->where('receipt_entry.tally_no', $tally_no)
            ->where('receipt_entry.order_no', $order_no)
            ->where(function ($query) use ($receipt_entry) {
                $query->where('receipt_entry.delete_status', '0')
                    ->orWhereNull('receipt_entry.delete_status');
            })
            ->orderBy('receipt_entry.id')
            ->get();


            $item_creation = ItemCreation::select('id', 'item_name', 'distributor_rate')->where(function ($query) {
                $query->where('delete_status', '0')->orWhereNull('delete_status');
            })->orderBy('item_name')->get();

            $balance_amt = SalesOrderDeliverySub::select('id', 'total_amount')->orderBy('total_amount')->get();

            return view('Entry.receipt_entry.c2d_rep_update_sub', [
                'sales_order_delivery_sub_list' => $sales_order_delivery_sub_list,
                'item_creation' => $item_creation,
                'balance_amt'  => $balance_amt,

            ]);
        }
                else if ($action == 'getorderrecipt2') {
                    $tally_no = $request->input('tally_no');
                    $order_no = $request->input('order_no');

                    $sales_order_delivery_sub_list = [];

                    $sales_order_delivery_sub_list = ReceiptEntry::select('id', 'item_creation_id', 'total_amount', 'total_amount_1', 'bal_amount','pay_amount','check_amount')
                        ->where('tally_no', $tally_no)
                        ->where('order_no', $order_no) // Add this condition to filter by order_no
                        ->where(function ($query) {
                            $query->where('delete_status', '0')->orWhereNull('delete_status');
                        })
                        ->orderBy('id')
                        ->get();

                    $item_creation = ItemCreation::select('id', 'item_name', 'distributor_rate')->where(function ($query) {
                        $query->where('delete_status', '0')->orWhereNull('delete_status');
                    })->orderBy('item_name')->get();

                    $balance_amt = SalesOrderDeliverySub::select('id','total_amount')->orderBy('total_amount')->get();


                    return($sales_order_delivery_sub_list);
                    return view('Entry.receipt_entry.c2d_rep_sublist_tally', [
                        'sales_order_delivery_sub_list' => $sales_order_delivery_sub_list,
                        'item_creation' => $item_creation,
                        'balance_amt'  => $balance_amt,

                    ]);
                }

        else if ($action == 'getdearlername') {

            $tally_no = $request->input('tally_no');

            if (!empty($tally_no)) {

                $dealer_name = DB::table('sales_order_delivery_main_c as sodmc')
                    ->leftJoin('dealer_creation as dc', 'dc.id', '=', 'sodmc.dealer_creation_id')
                    ->leftJoin('sales_ref_creation as src', 'src.id', '=', 'sodmc.sales_exec')
                    ->select('sodmc.dealer_creation_id', 'sodmc.sales_exec', 'src.sales_ref_name', 'dc.dealer_name')
                    ->where('sodmc.id', $tally_no)
                    ->get();
            } else {

                $dealer_name = DB::table('sales_order_delivery_main_c as sodmc')
                    ->leftJoin('dealer_creation as dc', 'dc.id', '=', 'sodmc.dealer_creation_id')
                    ->leftJoin('sales_ref_creation as src', 'src.id', '=', 'sodmc.sales_exec')
                    ->select('sodmc.dealer_creation_id', 'sodmc.sales_exec', 'src.sales_ref_name', 'dc.dealer_name')

                    ->get();
            }


            return response()->json($dealer_name);
        } else if ($action == 'get_selectsalesrepname') {

            $sales_name = SalesRepCreation::select('id', 'sales_ref_name')->where(function ($query) {
                $query->where('delete_status', '0')->orWhereNull('delete_status');
            })->orderBy('sales_ref_name')->get();

            return response()->json($sales_name);

        } else if ($action == 'get_selectdealername') {

            $dealer_creation = DealerCreation::select('id', 'dealer_name')->orderBy('dealer_name')->get();

            return response()->json($dealer_creation);

        }   else if ($action == 'getSalesRef') {


            $manager_id= $request->input('manager_id');

            $sales_ref_name = SalesRepCreation::select('id', 'sales_ref_name')->where('manager_id', $manager_id)->where(function ($query) {
                $query->where('delete_status', '0')->orWhereNull('delete_status');
            })->orderBy('sales_ref_name')->get();
            
            return response()->json($sales_ref_name);

        } else if ($action == 'getsalesrep_dealername') {

            $sales_exec = $request->input('sales_exec');

            $dealer_name = DealerCreation::select('id', 'dealer_name')
                ->where('sales_rep_id', $sales_exec)
                ->get();

            return response()->json($dealer_name);

        } else if ($action == 'gettallynumber') {


            $SalesOrderDeliveryMain_tb = (new SalesOrderDeliveryMain)->getTable();
            $SalesOrderDeliverySub_tb = (new SalesOrderDeliverySub)->getTable();

            $dealer_creation_id = $request->input('dealer_creation_id');

            $tally_no = SalesOrderDeliveryMain::select($SalesOrderDeliveryMain_tb . '.id', $SalesOrderDeliveryMain_tb . '.tally_no')
            ->join($SalesOrderDeliverySub_tb, $SalesOrderDeliverySub_tb . '.sales_order_main_id', '=', $SalesOrderDeliveryMain_tb . '.id')
            ->where($SalesOrderDeliveryMain_tb . '.dealer_creation_id', $dealer_creation_id)
            ->where($SalesOrderDeliverySub_tb . '.bal_amount', '!=', 0)
            ->where(function ($query) use ($SalesOrderDeliveryMain_tb) {
                $query->where($SalesOrderDeliveryMain_tb . '.delete_status', '0')
                    ->orWhereNull($SalesOrderDeliveryMain_tb . '.delete_status');
            })
            ->where(function ($query) use ($SalesOrderDeliverySub_tb) {
                $query->where($SalesOrderDeliverySub_tb . '.delete_status', '0')
                    ->orWhereNull($SalesOrderDeliverySub_tb . '.delete_status');
            })
            ->groupBy($SalesOrderDeliveryMain_tb . '.id', $SalesOrderDeliveryMain_tb . '.tally_no') // Include tally_no in GROUP BY
            ->get();


            return response()->json($tally_no);
        }
    }
}
