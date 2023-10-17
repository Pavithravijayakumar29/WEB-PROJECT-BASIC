<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ItemPropertiesType;
class ItemPropertiesTypeController extends Controller
{
    public function retrieve($id)
    {
        if($id=='')
        {return ItemPropertiesType::select('id','item_properties_type','status1')->orderBy('item_properties_type')->get();}
        else
        {return ItemPropertiesType::select('id','item_properties_type','status1','description')->orderBy('item_properties_type')->where('id','=',$id)->get();}
    }
    public function db_cmd(Request $request)
    {
        $action=$request->input('action');
        if($action=='insert')
        {
            $tb = new ItemPropertiesType();
            $tb->item_properties_type = $request->input('item_properties_type');
            $tb->description = $request->input('description');
            $tb->status1 = $request->input('status1');
            $tb->save();
        }
        else if($action=='update')
        {
            $tb = ItemPropertiesType::find($request->input('id'));
            $tb->item_properties_type = $request->input('item_properties_type');
            $tb->description = $request->input('description');
            $tb->status1 = $request->input('status1');
            $tb->save();
        }
        else if($action=='delete')
        {
            $tb = ItemPropertiesType::where('id','=',$request->input('id'));
            $tb->delete();
        }
        else if($action=='retrieve')
        {
            $item_properties_type = $this->retrieve('');
            return view('Masters.item_properties_type.list',['item_properties_type'=>$item_properties_type,'user_rights_edit_1'=>$request->input('user_rights_edit_1'),'user_rights_delete_1'=>$request->input('user_rights_delete_1')]);
        }
        else if($action=='count')
        {
            $cnt=0;
            $id=$request->input('id');$item_properties_type=$request->input('item_properties_type');
            if($id!="0"){$cnt=ItemPropertiesType::where('item_properties_type','=',$item_properties_type)->where('id','!=',$id)->count();}
            else{$cnt=ItemPropertiesType::where('item_properties_type','=',$item_properties_type)->count();}
            return $cnt;
        }
        else if($action=='create_form')
        {
            return view('Masters.item_properties_type.create');
        }
        else if($action=='update_form')
        {
            $item_properties_type=$this->retrieve($request->input('id'));
            return view('Masters.item_properties_type.update',['item_properties_type'=>$item_properties_type[0]]);
        }
        else if($action=='statusinfo')
        {
            $stat = $request->input('status1')==1 ? "0" : "1";

            $tb = ItemPropertiesType::find($request->input('id'));
            $tb->status1 = $stat;
            $tb->save();

        }
    }
}
