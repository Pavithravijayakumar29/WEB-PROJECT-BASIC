<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ReturnCreation;

class ReturnCreationController extends Controller
{
    public function retrieve($id)
    {
        if($id=='')
        {return ReturnCreation::select('id','return_type','status','description')->where(function($query){$query->where('delete_status', '0')->orWhereNull('delete_status');})->orderBy('return_type')->get();}
        else
        {return ReturnCreation::select('id','return_type','description')->orderBy('return_type')->where('id','=',$id)->get();}
    }
    public function db_cmd(Request $request)
    {
        $action=$request->input('action');
        if($action=='insert')
        {
            $tb = new ReturnCreation();
            $tb->return_type = $request->input('return_type');
            $tb->description = $request->input('description');
            $tb->status='1';
            $tb->save();
        }
        else if($action=='update')
        {
            $tb = ReturnCreation::find($request->input('id'));
            $tb->return_type = $request->input('return_type');
            $tb->description = $request->input('description');
            $tb->save();
        }
        else if($action=='delete')
        {
            $tb = ReturnCreation::find($request->input('id'));
            $tb->delete_status = '1';
            $tb->save();

        }
        else if($action=='retrieve')
        {
            $return_type = $this->retrieve('');
            return view('Masters.return_creation.list',['return_type'=>$return_type,'user_rights_edit_1'=>$request->input('user_rights_edit_1'),'user_rights_delete_1'=>$request->input('user_rights_delete_1')]);
        }
        else if($action=='count')
        {
            $cnt=0;
            $id=$request->input('id');$return_type=$request->input('return_type');
            if($id!="0"){$cnt=ReturnCreation::where('return_type','=',$return_type)->where('id','!=',$id)->count();}
            else{$cnt=ReturnCreation::where('return_type','=',$return_type)->count();}
            return $cnt;
        }
        else if($action=='create_form')
        {
            return view('Masters.return_creation.create');
        }
        else if($action=='update_form')
        {
            $return_type=$this->retrieve($request->input('id'));
            return view('Masters.return_creation.update',['return_type'=>$return_type[0]]);
        }
        else if($action=='statusinfo')
        {
            $stat = $request->input('status')==1 ? "0" : "1";

            $tb = ReturnCreation::find($request->input('id'));
            $tb->status = $stat;
            $tb->save();

        }
    }
}
