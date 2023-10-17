<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoryCreation;
use App\Models\GroupCreation;


class GroupCreationController extends Controller
{
    public function retrieve($id)
    {
        $CategoryCreation_tb = (new CategoryCreation)->getTable();
        $GroupCreation_tb = (new GroupCreation)->getTable();
        if($id=='')
        {return GroupCreation::join($CategoryCreation_tb, $CategoryCreation_tb.'.id', '=', $GroupCreation_tb.'.category_id')->where(function($query) use ($GroupCreation_tb){$query->where($GroupCreation_tb.'.delete_status', '0')->orWhereNull($GroupCreation_tb.'.delete_status');})->orderBy($GroupCreation_tb.'.group_name')->get([$GroupCreation_tb.'.id',$GroupCreation_tb.'.category_id',$CategoryCreation_tb.'.category_name',$GroupCreation_tb.'.group_name',$GroupCreation_tb.'.hsn_code',$GroupCreation_tb.'.description',$GroupCreation_tb.'.status']);
        }
        else
        {
            $del = 0;
            return GroupCreation::join($CategoryCreation_tb, $CategoryCreation_tb.'.id', '=', $GroupCreation_tb.'.category_id')->orderBy($GroupCreation_tb.'.group_name')->where($GroupCreation_tb.'.id','=',$id)->get([$GroupCreation_tb.'.id',$GroupCreation_tb.'.category_id',$CategoryCreation_tb.'.category_name',$GroupCreation_tb.'.group_name',$GroupCreation_tb.'.hsn_code',$GroupCreation_tb.'.description'])->first();}
    }
    public function db_cmd(Request $request)
    {
        $action=$request->input('action');
        if($action=='insert')
        {
            $cnt=GroupCreation::where('group_name','=',$request->input('group_name'))->where('hsn_code', $request->input('hsn_code'))->where('category_id', $request->input('category_id'))->where(function($query){$query->where('delete_status', '0')->orWhereNull('delete_status');})->count();
            if($cnt>0){return $cnt;}
            else{
            $tb = new GroupCreation();
            $tb->category_id = $request->input('category_id');
            $tb->group_name = $request->input('group_name');
            $tb->hsn_code = $request->input('hsn_code');
            $tb->status='1';
            $tb->description = $request->input('description');
            $tb->save();
            }
        }
        else if($action=='update')
        {
            $cnt=GroupCreation::where('group_name','=',$request->input('group_name'))->where('hsn_code', $request->input('hsn_code'))->where('category_id', $request->input('category_id'))->where(function($query){$query->where('delete_status', '0')->orWhereNull('delete_status');})->count();

            $tb = GroupCreation::find($request->input('id'));
            $tb->category_id = $request->input('category_id');
            $tb->group_name = $request->input('group_name');
            $tb->hsn_code = $request->input('hsn_code');
            $tb->description = $request->input('description');
            $tb->save();

        }
        else if($action=='delete')
        {
            $tb = GroupCreation::find($request->input('id'));
            $tb->delete_status = "1";
            $tb->save();
        }
        else if($action=='retrieve')
        {
            $group_creation = $this->retrieve('');
            return view('Masters.group_creation.list',['group_creation'=>$group_creation,'user_rights_edit_1'=>$request->input('user_rights_edit_1'),'user_rights_delete_1'=>$request->input('user_rights_delete_1')]);
        }

        else if($action=='create_form')
        {
            $category_creation=CategoryCreation::select('id','category_name')->where('delete_status','!=','1')->orderBy('category_name')->get();
            return view('Masters.group_creation.create',['categoryCreation'=>$category_creation]);
        }
        else if($action=='update_form')
        {
            $category_creation=CategoryCreation::select('id','category_name')->get();
            $group_creation=$this->retrieve($request->input('id'));
            return view('Masters.group_creation.update',['category_creation'=>$category_creation,'group_creation'=>$group_creation]);
        }
        else if($action=='statusinfo')
        {
            $stat = $request->input('status')==1 ? "0" : "1";

            $tb = GroupCreation::find($request->input('id'));
            $tb->status = $stat;
            $tb->save();

        }
    }
}
