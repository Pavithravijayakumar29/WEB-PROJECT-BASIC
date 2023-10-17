<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\SalesRepCreation;
use App\Models\DealerCreation;
use App\Models\ShopCreation;
use App\Models\Entry\SalesOrderC2DMain;
use App\Models\Entry\SalesOrderD2SMain;
use App\Models\Entry\SalesOrderDeliveryMain;
use App\Models\Entry\SalesOrderDeliverySub;
use App\Models\Entry\SalesReturnD2CSub;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserController extends Controller
{
    public function dash()
    {
        $currentYear = Carbon::now()->year;
        $currentWeek = Carbon::now()->week;
        $currentMonth = Carbon::now()->month;

        $sales_count = SalesRepCreation::where(function($query) {
            $query->where('delete_status', '0')->orWhereNull('delete_status');
        })->count();

        $dealers = DealerCreation::where(function($query) {
            $query->where('delete_status', '0')->orWhereNull('delete_status');
        })->count();

        $shop = ShopCreation::where(function($query) {
            $query->where('delete_status', '0')->orWhereNull('delete_status');
        })->count();

        $c_to_d = SalesOrderC2DMain::where(function($query) {
            $query->where('delete_status', '0')->orWhereNull('delete_status');
        })->count();

        $d_to_s = SalesOrderD2SMain::where(function($query) {
            $query->where('delete_status', '0')->orWhereNull('delete_status');
        })->count();

        $delivery = SalesOrderDeliveryMain::where(function($query) {
            $query->where('delete_status', '0')->orWhereNull('delete_status');
        })->count();

        $delivery_sub_total = SalesOrderDeliverySub::where(function($query) use ($currentYear) {
            $query->where('delete_status', '0')
                ->orWhereNull('delete_status')
                ->whereRaw("YEAR(entry_date) = ?", [$currentYear]);
        })->sum('total_amount');

        $delivery_sub_weekly_total = DB::table('sales_order_delivery_sublist_c')
        ->selectRaw('SUM(total_amount) as weekly_total')
        ->where(function ($query) {
            $query->where('delete_status', 0)
                ->orWhereNull('delete_status');
        })
        ->whereYear('entry_date', $currentYear)
        ->whereRaw('WEEK(entry_date) = WEEK(NOW())')
        ->value('weekly_total');

    $delivery_sub_monthly_total = DB::table('sales_order_delivery_sublist_c')
        ->selectRaw('SUM(total_amount) as monthly_total')
        ->where(function ($query) {
            $query->where('delete_status', 0)
                ->orWhereNull('delete_status');
        })
        ->whereYear('entry_date', $currentYear)
        ->whereMonth('entry_date', $currentMonth)
        ->value('monthly_total');

        $dealer_td = (new DealerCreation)->getTable();
        $sales_rep_td = (new SalesRepCreation)->getTable();

       $all_values = DealerCreation::join($sales_rep_td, $sales_rep_td.'.id', '=', $dealer_td.'.sales_rep_id')
        ->where(function($query) use ($dealer_td){$query->where($dealer_td.'.delete_status', '0')->orWhereNull($dealer_td.'.delete_status');})
        ->orderBy($dealer_td.'.id')
        ->get([$dealer_td.'.id',$dealer_td.'.dealer_name',$dealer_td.'.sales_rep_id',$dealer_td.'.image_name',$sales_rep_td.'.sales_ref_name']);

        $return_sub_total = SalesReturnD2CSub::where(function($query) use ($currentYear) {
            $query->where('delete_status', '0')
                ->orWhereNull('delete_status')
                ->whereRaw("YEAR(order_date_sub) = ?", [$currentYear]);
        })->sum('total_amount');

        // Chart Value//
        $delivery_sub_monthly_data = [];
    for ($month = 1; $month <= 12; $month++)
    {
        $monthly_totaly = DB::table('sales_order_delivery_sublist_c')
            ->selectRaw('SUM(total_amount) as monthly_totaly')
            ->where(function ($query) {
                $query->where('delete_status', 0)
                    ->orWhereNull('delete_status');
            })
            ->whereYear('entry_date', $currentYear)
            ->whereMonth('entry_date', $month)
            ->value('monthly_totaly');

        $delivery_sub_monthly_data[] = $monthly_totaly;
    }
    $expense_sub_monthly_data = [];
    for ($m = 1; $m <= 12; $m++)
    {
        $monthly_expense = DB::table('expense_creations_sublist')
            ->selectRaw('SUM(total_amount) as monthly_expense')
            ->where(function ($query) {
                $query->where('delete_status', 0)
                    ->orWhereNull('delete_status');
            })
            ->whereYear('entry_date', $currentYear)
            ->whereMonth('entry_date', $m)
            ->value('monthly_expense');

        $expense_sub_monthly_data[] = $monthly_expense;
    }
    $return_monthly = [];
    for ($d = 1; $d <= 12; $d++)
    {
        $monthly_return = DB::table('sales_return_d2c_sublist')
            ->selectRaw('SUM(total_amount) as monthly_return')
            ->whereYear('order_date_sub', $currentYear)
            ->whereMonth('order_date_sub', $d)
            ->value('monthly_return');

        $return_monthly[] = $monthly_return;
    }
// return $return_monthly;
        return view('dashboard.admin', [
            'sales_count' => $sales_count,
            'dealers' => $dealers,
            'shop' => $shop,
            'c_to_d' => $c_to_d,
            'd_to_s' => $d_to_s,
            'delivery' => $delivery,
            'delivery_sub_total' => $delivery_sub_total,
            'delivery_sub_weekly_total' => $delivery_sub_weekly_total,
            'delivery_sub_monthly_total' => $delivery_sub_monthly_total,
            'all_dealers'=>$all_values,
            'return_sub_total'=>$return_sub_total,
            'delivery_sub_monthly_data_json'=>json_encode($delivery_sub_monthly_data),
            'expense_sub_monthly_data'=>json_encode($expense_sub_monthly_data),
            'return_monthly'=>json_encode($return_monthly),
        ]);
    }
}
