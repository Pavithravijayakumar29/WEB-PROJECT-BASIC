<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CompanyCreation;

class CompanyCreationController extends Controller
{
    public function retrieve($id)
    {
        if($id=='')
        {return CompanyCreation::select('id','company_name','address','mobile_no','gst_no','status1')->orderBy('company_name')->get();}
        else
        {return CompanyCreation::select('id','company_name','address','mobile_no','phone_no','gst_no','tin_no','email_id','status1')->orderBy('company_name')->where('id','=',$id)->get();}
    }
    public function db_cmd(Request $request)
    {
        $action = $request->input('action');
        if ($action == 'insert') {
            $tb = new CompanyCreation();
            $tb->company_name = $request->input('company_name');
            $tb->address = $request->input('address');
            $tb->mobile_no = $request->input('mobile_no');
            $tb->phone_no = $request->input('phone_no');
            $tb->gst_no = $request->input('gst_no');
            $tb->tin_no = $request->input('tin_no');
            $tb->email_id = $request->input('email_id');
            $tb->status1 = $request->input('status1');

            $tb->save();
        }

        else if($action=='update')
        {
            $tb = CompanyCreation::find($request->input('id'));
            $tb->company_name = $request->input('company_name');
            $tb->address = $request->input('address');
            $tb->mobile_no = $request->input('mobile_no');
            $tb->phone_no = $request->input('phone_no');
            $tb->gst_no = $request->input('gst_no');
            $tb->tin_no = $request->input('tin_no');
            $tb->email_id = $request->input('email_id');
            $tb->status1 = $request->input('status1');
            $tb->save();
        }
        else if($action=='delete')
        {
            $tb = CompanyCreation::where('id','=',$request->input('id'));
            $tb->delete();
        }
        else if($action=='retrieve')
        {
            $company_creation = $this->retrieve('');
            return view('Masters.company_creation.list',['company_creation'=>$company_creation,'user_rights_edit_1'=>$request->input('user_rights_edit_1'),'user_rights_delete_1'=>$request->input('user_rights_delete_1')]);
        }
        else if($action=='count')
        {
            $cnt=0;
            $id=$request->input('id');$company_creation=$request->input('company_creation');
            if($id!="0"){$cnt=CompanyCreation::where('company_creation','=',$company_creation)->where('id','!=',$id)->count();}
            else{$cnt=CompanyCreation::where('company_creation','=',$company_creation)->count();}
            return $cnt;
        }
        else if($action=='create_form')
        {
            return view('Masters.company_creation.create');
        }
        else if($action=='update_form')
        {

            $company_creation=$this->retrieve($request->input('id'));
            return view('Masters.company_creation.update',['company_creation'=>$company_creation[0]]);
        }
        else if($action=='statusinfo')
        {
            $stat = $request->input('status1')==1 ? "0" : "1";

            $tb = CompanyCreation::find($request->input('id'));
            $tb->status1 = $stat;
            $tb->save();

        }
    }
}
