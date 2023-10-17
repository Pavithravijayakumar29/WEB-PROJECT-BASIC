<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdvanceCreation;
use App\Models\SalesRepCreation;
class AdvanceCreationController extends Controller
{

    public function retrieve($id)
    {
        $UserCreation_tb = (new SalesRepCreation)->getTable();
        $advancecreation_tb = (new AdvanceCreation)->getTable();
        if($id=='')
        {
            return AdvanceCreation::join($UserCreation_tb, $UserCreation_tb.'.id', '=', $advancecreation_tb.'.staff_id')->where(function($query) use ($advancecreation_tb){$query->where($advancecreation_tb.'.delete_status', '0')->orWhereNull($advancecreation_tb.'.delete_status');})
            ->orderBy($advancecreation_tb.'.staff_id')->get([$advancecreation_tb.'.id',$UserCreation_tb.'.sales_ref_name',$advancecreation_tb.'.entry_date',$advancecreation_tb.'.advance_no',$advancecreation_tb.'.amount',$advancecreation_tb.'.description',$advancecreation_tb.'.status']);
        }
        else
        {
            return AdvanceCreation::join($UserCreation_tb, $UserCreation_tb.'.id', '=', $advancecreation_tb.'.staff_id')->orderBy($advancecreation_tb.'.staff_id')->where($advancecreation_tb.'.id','=',$id)->get([$advancecreation_tb.'.id',$advancecreation_tb.'.staff_id',$advancecreation_tb.'.entry_date',$advancecreation_tb.'.advance_no',$advancecreation_tb.'.amount',$advancecreation_tb.'.description',$advancecreation_tb.'.cash_type']);
        }
    }
    public function db_cmd(Request $request)
    {
        $action=$request->input('action');
        if($action=='insert')
        {
            $current_yr=date('Y');
            $tb = new AdvanceCreation();
            $tb->entry_date = $request->input('date');
            $tb->advance_no = $request->input('adv_no');
            $tb->staff_id = $request->input('staff_id');
            $tb->amount = $request->input('amount');
            $tb->status='1';
            $tb->cash_type = $request->input('payment');
            $tb->description = $request->input('description');
            $tb->account_year = $current_yr;
            $tb->save();
        }
        else if($action=='update')
        {
            $tb = AdvanceCreation::find($request->input('id'));
            $tb->entry_date = $request->input('date');
            $tb->advance_no = $request->input('adv_no');
            $tb->staff_id = $request->input('staff_id');
            $tb->amount = $request->input('amount');
            $tb->cash_type = $request->input('payment');
            $tb->description = $request->input('description');
            $tb->save();
        }
        else if($action=='delete')
        {
            $tb = AdvanceCreation::find($request->input('id'));
            $tb->delete_status = '1';
            $tb->save();
        }
        else if($action=='retrieve')
        {
            $advance_creation = $this->retrieve('');
            $emp_name=SalesRepCreation::select('id','sales_ref_name')->orderBy('id')->get();
            return view('Masters.advance_creation.list',['advance_creation'=>$advance_creation,'emp_name'=>$emp_name,'user_rights_edit_1'=>$request->input('user_rights_edit_1'),'user_rights_delete_1'=>$request->input('user_rights_delete_1')]);

        }
        else if($action=='count')
        {
            $cnt=0;
            $id=$request->input('id');$user_type=$request->input('user_type');
            if($id!="0"){$cnt=AdvanceCreation::where('user_type','=',$user_type)->where('id','!=',$id)->count();}
            else{$cnt=AdvanceCreation::where('user_type','=',$user_type)->count();}
            return $cnt;
        }
        else if($action=='create_form')
        {
            $lastInvoice = AdvanceCreation::select('advance_no')->orderBy('id', 'desc')->first();
            $lastNumber = $lastInvoice ? (int)substr($lastInvoice->advance_no,-4) : 0;
            $currentYear = date('y');
            $currentMonth = date('m');

            $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
            $newInvoiceNumber = 'ADV-' . $currentYear . $currentMonth . '-' . $newNumber;


            $sales=SalesRepCreation::select('id','sales_ref_name')->orderBy('sales_ref_name')->get();

            return view('Masters.advance_creation.create',['sales'=>$sales,'newInvoiceNumber'=>$newInvoiceNumber]);
        }
        else if($action=='update_form')
        {
            $sales=SalesRepCreation::select('id','sales_ref_name')->orderBy('sales_ref_name')->get();
            $advance_creation=$this->retrieve($request->input('id'));
            return view('Masters.advance_creation.update',['state_name'=>$sales,'advance_creation'=>$advance_creation[0]]);
        }
        else if($action=='statusinfo')
        {
            $stat = $request->input('status')==1 ? "0" : "1";

            $tb = AdvanceCreation::find($request->input('id'));
            $tb->status = $stat;
            $tb->save();

        }

    }
}
