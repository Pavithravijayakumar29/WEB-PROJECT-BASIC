<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Entry\SalesOrderC2DMain;
use App\Models\Entry\SalesOrderC2DSub;
use App\Models\MarketCreation;
use App\Models\DealerCreation;
use App\Models\ItemCreation;
use App\Models\ItemLitersType;
use App\Models\ItemPropertiesType;
use Carbon\Carbon;

class SalesReportController extends Controller
{
    public function sales_order_report_c2d()
    {
        $order_no_list=SalesOrderC2DMain::select('order_no')->where(function($query){$query->where('delete_status', '0')->orWhereNull('delete_status');})->get();
        $market_creation=MarketCreation::select('id','area_name')->where(function($query){$query->where('delete_status', '0')->orWhereNull('delete_status');})->orderBy('area_name')->get();
        $dealer_creation=DealerCreation::select('id','dealer_name')->where(function($query){$query->where('delete_status', '0')->orWhereNull('delete_status');})->orderBy('dealer_name')->get();
        return view('Reports.sales_order_c2d.admin',['order_no_list'=>$order_no_list,'market_creation'=>$market_creation,'dealer_creation'=>$dealer_creation]);
    }
    public function retrieve($from_date_1,$to_date_1,$order_no_1,$market_creation_id_1,$dealer_creation_id_1,$status_1,$description_1)
    {
        $cond="";
        if($from_date_1!=""){$cond.=" and order_date>='".$from_date_1."'";}
        if($to_date_1!=""){$cond.=" and order_date<='".$to_date_1."'";}
        if($order_no_1!=""){$cond.=" and order_no='".$order_no_1."'";}
        if($market_creation_id_1!=""){$cond.=" and market_creation_id=".$market_creation_id_1;}
        if($dealer_creation_id_1!=""){$cond.=" and dealer_creation_id=".$dealer_creation_id_1;}
        if($status_1!=""){$cond.=" and status=".$status_1;}
        if($description_1!=""){$cond.=" and description=".$description_1;}
        $main_tb = (new SalesOrderC2DMain)->getTable();
        $sub_tb = (new SalesOrderC2DSub)->getTable();
        $MarketCreation_tb = (new MarketCreation)->getTable();
        $DealerCreation_tb = (new DealerCreation)->getTable();
        $tb1=DB::select('select id,order_no,order_date,(select area_name FROM '.$MarketCreation_tb.' where id='.$main_tb.'.market_creation_id) as area_name,(select dealer_name from '.$DealerCreation_tb.' where id='.$main_tb.'.dealer_creation_id) as dealer_name,status,(select IF(count(*)>0,CONCAT(sum(order_quantity),";",sum(item_weights),";",sum(total_amount)),"0;0;0") from '.$sub_tb.' where sales_order_main_id='.$main_tb.'.id and (delete_status=0 or delete_status is null)) as total_sublist from '.$main_tb.' where (delete_status=0 or delete_status is null)'.$cond);

        $tb1=DB::select('select id,order_no,order_date,(select area_name FROM '.$MarketCreation_tb.' where id='.$main_tb.'.market_creation_id) as area_name,(select dealer_name from '.$DealerCreation_tb.' where id='.$main_tb.'.dealer_creation_id) as dealer_name,status,(select IF(count(*)>0,CONCAT(sum(order_quantity),";",sum(item_weights),";",sum(total_amount)),"0;0;0") from '.$sub_tb.' where sales_order_main_id='.$main_tb.'.id and (delete_status=0 or delete_status is null)) as total_sublist from '.$main_tb.' where (delete_status=0 or delete_status is null)'.$cond);
        return json_decode(json_encode($tb1), true);
    }
    public function retrieve_main($id)
    {
        return SalesOrderC2DMain::select('id','order_no','order_date','market_creation_id','dealer_creation_id','status','description')->where('id',$id)->get()->first();
    }
    public function retrieve_sub($main_id,$sub_id)
    {
        if($sub_id=='')
        {
            $sub_tb = (new SalesOrderC2DSub)->getTable();
            $ItemCreation_tb = (new ItemCreation)->getTable();
            $ItemPropertiesType_tb = (new ItemPropertiesType)->getTable();
            $ItemLitersType_tb = (new ItemLitersType)->getTable();
            $tb1=DB::select('select id,(select item_name from '.$ItemCreation_tb.' where id='.$sub_tb.'.item_creation_id) as item_creation_id,(select item_properties_type from '.$ItemPropertiesType_tb.' where id='.$sub_tb.'.item_property) as item_property,(select item_liters_type from '.$ItemLitersType_tb.' where id='.$sub_tb.'.item_weights) as item_weights,order_quantity,item_price,total_amount from '.$sub_tb.' where sales_order_main_id='.$main_id.' and (delete_status=0 or delete_status is null)');
            return json_decode(json_encode($tb1), true);
        }
        else
        {return SalesOrderC2DSub::where('id',$sub_id)->where(function($query){$query->where('delete_status', '0')->orWhereNull('delete_status');})->get(['id','item_creation_id','order_quantity','item_property','item_weights','item_price','total_amount'])->first();}
    }
     public function db_cmd(Request $request)
    {
   $action=$request->input('action');

         if($action=='retrieve')
        {
            $sales_order_c2d_main = $this->retrieve($request->input('from_date_1'),$request->input('to_date_1'),$request->input('order_no_1'),$request->input('market_creation_id_1'),$request->input('dealer_creation_id_1'),$request->input('status_1'),$request->input('description'));
            return view('Reports.sales_order_c2d.list',['sales_order_c2d_main'=>$sales_order_c2d_main,'user_rights_edit_1'=>$request->input('user_rights_edit_1'),'user_rights_delete_1'=>$request->input('user_rights_delete_1')]);
        }

    }
}
