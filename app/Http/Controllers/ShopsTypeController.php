<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShopsType;
class ShopsTypeController extends Controller
{
    public function retrieve($id)
    {
        if($id=='')
        {return ShopsType::select('id','shops_type','status1')->orderBy('shops_type')->get();}
        else
        {return ShopsType::select('id','shops_type','status1','description')->orderBy('shops_type')->where('id','=',$id)->get();}
    }
    public function db_cmd(Request $request)
    {
        $action=$request->input('action');
        if($action=='insert')
        {
            $tb = new ShopsType();
            $tb->shops_type = $request->input('shops_type');
            $tb->description = $request->input('description');
            $tb->status1 = $request->input('status1');
            $tb->save();
        }
        else if($action=='update')
        {
            $tb = ShopsType::find($request->input('id'));
            $tb->shops_type = $request->input('shops_type');
            $tb->description = $request->input('description');
            $tb->status1 = $request->input('status1');
            $tb->save();
        }
        else if($action=='delete')
        {
            $tb = ShopsType::where('id','=',$request->input('id'));
            $tb->delete();
        }
        else if($action=='retrieve')
        {
            $shops_type = $this->retrieve('');
            return view('Masters.shops_type.list',['shops_type'=>$shops_type,'user_rights_edit_1'=>$request->input('user_rights_edit_1'),'user_rights_delete_1'=>$request->input('user_rights_delete_1')]);
        }
        else if($action=='count')
        {
            $cnt=0;
            $id=$request->input('id');$shops_type=$request->input('shops_type');
            if($id!="0"){$cnt=ShopsType::where('shops_type','=',$shops_type)->where('id','!=',$id)->count();}
            else{$cnt=ShopsType::where('shops_type','=',$shops_type)->count();}
            return $cnt;
        }
        else if($action=='create_form')
        {
            return view('Masters.shops_type.create');
        }
        else if($action=='update_form')
        {
            $shops_type=$this->retrieve($request->input('id'));
            return view('Masters.shops_type.update',['shops_type'=>$shops_type[0]]);
        }
        else if($action=='statusinfo')
        {
            $stat = $request->input('status1')==1 ? "0" : "1";

            $tb = ShopsType::find($request->input('id'));
            $tb->status1 = $stat;
            $tb->save();

        }
    }
}
