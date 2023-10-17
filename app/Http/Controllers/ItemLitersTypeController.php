<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ItemLitersType;
class ItemLitersTypeController extends Controller
{
    public function retrieve($id)
    {
        if($id=='')
        {return ItemLitersType::select('id','item_liters_type','status1')->orderBy('item_liters_type')->get();}
        else
        {return ItemLitersType::select('id','item_liters_type','status1','description')->orderBy('item_liters_type')->where('id','=',$id)->get();}
    }
    public function db_cmd(Request $request)
    {
        $action=$request->input('action');
        if($action=='insert')
        {
            $tb = new ItemLitersType();
            $tb->item_liters_type = $request->input('item_liters_type');
            $tb->description = $request->input('description');
            $tb->status1 = $request->input('status1');
            $tb->save();
        }
        else if($action=='update')
        {
            $tb = ItemLitersType::find($request->input('id'));
            $tb->item_liters_type = $request->input('item_liters_type');
            $tb->description = $request->input('description');
            $tb->status1 = $request->input('status1');
            $tb->save();
        }
        else if($action=='delete')
        {
            $tb = ItemLitersType::where('id','=',$request->input('id'));
            $tb->delete();
        }
        else if($action=='retrieve')
        {
            $item_liters_type = $this->retrieve('');
            return view('Masters.item_liters_type.list',['item_liters_type'=>$item_liters_type,'user_rights_edit_1'=>$request->input('user_rights_edit_1'),'user_rights_delete_1'=>$request->input('user_rights_delete_1')]);
        }
        else if($action=='count')
        {
            $cnt=0;
            $id=$request->input('id');$item_liters_type=$request->input('item_liters_type');
            if($id!="0"){$cnt=ItemLitersType::where('item_liters_type','=',$item_liters_type)->where('id','!=',$id)->count();}
            else{$cnt=ItemLitersType::where('item_liters_type','=',$item_liters_type)->count();}
            return $cnt;
        }
        else if($action=='create_form')
        {
            return view('Masters.item_liters_type.create');
        }
        else if($action=='update_form')
        {
            $item_liters_type=$this->retrieve($request->input('id'));
            return view('Masters.item_liters_type.update',['item_liters_type'=>$item_liters_type[0]]);
        }
        else if($action=='statusinfo')
        {
            $stat = $request->input('status1')==1 ? "0" : "1";

            $tb = ItemLitersType::find($request->input('id'));
            $tb->status1 = $stat;
            $tb->save();

        }
    }
}
