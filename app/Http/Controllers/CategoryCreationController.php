<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoryCreation;

class CategoryCreationController extends Controller
{
    public function retrieve($id)
    {
        if($id=='')
        {return CategoryCreation::select('id','category_name','description','status')->where('delete_status', '0')->orWhereNull('delete_status')->orderBy('category_name')->get();}
        else
        {return CategoryCreation::select('id','category_name','description','status')->where('id','=',$id)->get();}
    }
    public function db_cmd(Request $request)
    {
        $action=$request->input('action');
        if($action=='insert')
        {

            $cnt=CategoryCreation::where('category_name','=',$request->input('category_name'))->where(function($query){$query->where('delete_status', '0')->orWhereNull('delete_status');})->count();
            if($cnt>0){return $cnt;}
            else
            {
            $tb = new CategoryCreation();
            $tb->category_name = $request->input('category_name');
            $tb->description = $request->input('description');
            $tb->status = $request->input('status');
            $tb->save();
            }
        }
        else if($action=='update')
        {
            $cnt=CategoryCreation::where('category_name','=',$request->input('category_name'))->where('status', $request->input('status'))->where(function($query){$query->where('delete_status', '0')->orWhereNull('delete_status');})->count();

            $tb = CategoryCreation::find($request->input('id'));
            $tb->category_name = $request->input('category_name');
            $tb->description = $request->input('description');
            $tb->status = $request->input('status');
            $tb->save();


        }
        else if($action=='delete')
        {
            $tb = CategoryCreation::find($request->input('id'));
            $tb->delete_status = "1";
            $tb->save();
        }
        else if($action=='retrieve')
        {
            $Category_creation = $this->retrieve('');
            return view('Masters.category_creation.list',['category_creation'=>$Category_creation,'user_rights_edit_1'=>$request->input('user_rights_edit_1'),'user_rights_delete_1'=>$request->input('user_rights_delete_1')]);
        }
        else if($action=='count')
        {
            $cnt=0;
            $id=$request->input('id');$category_name=$request->input('category_name');
            if($id!="0"){$cnt=CategoryCreation::where('category_name','=',$category_name)->where('id','!=',$id)->count();}
            else{$cnt=CategoryCreation::where('category_name','=',$category_name)->count();}
            return $cnt;
        }
        else if($action=='create_form')
        {
            return view('Masters.category_creation.create');
        }
        else if($action=='update_form')
        {
            $Category_creation=$this->retrieve($request->input('id'));
            return view('Masters.category_creation.update',['category_creation'=>$Category_creation[0]]);
        }
        else if($action=='statusinfo')
        {
            $stat = $request->input('status')==1 ? "0" : "1";

            $tb = CategoryCreation::find($request->input('id'));
            $tb->status = $stat;
            $tb->save();

        }
    }
}
