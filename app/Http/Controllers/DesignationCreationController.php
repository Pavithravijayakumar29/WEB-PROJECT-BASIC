<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DesignationCreation;

class DesignationCreationController extends Controller
{
    public function retrieve($id)
    {
        if($id=='')
        {return DesignationCreation::select('id','designation_name','status','description')->where ('delete_status',0)->orWhereNull('delete_status')->orderBy('designation_name')->get();}
        else
        {return DesignationCreation::select('id','designation_name','description')->orderBy('designation_name')->where('id','=',$id)->get();}
    }
    public function db_cmd(Request $request)
    {
        $action=$request->input('action');
        if($action=='insert')
        {
            $cnt=DesignationCreation::where('designation_name','=',$request->input('designation_name'))->where(function($query){$query->where('delete_status', '0')->orWhereNull('delete_status');})->count();
            if($cnt>0){return $cnt;}
            else{
            $tb = new DesignationCreation();
            $tb->designation_name = $request->input('designation_name');
            $tb->status='1';
            $tb->description = $request->input('description');
            $tb->save();
            }
        }
        else if($action=='update')
        {
            $cnt=DesignationCreation::where('designation_name','=',$request->input('designation_name'))->where(function($query){$query->where('delete_status', '0')->orWhereNull('delete_status');})->count();

            $tb = DesignationCreation::find($request->input('id'));
            $tb->designation_name = $request->input('designation_name');
            $tb->description = $request->input('description');
            $tb->save();

        }
        else if($action=='delete')
        {
            $tb = DesignationCreation::find($request->input('id'));
            $tb->delete_status = "1";
            $tb->save();
        }
        else if($action=='retrieve')
        {
            $designation_creation = $this->retrieve('');
            return view('Masters.designation_creation.list',['designation_creation'=>$designation_creation,'user_rights_edit_1'=>$request->input('user_rights_edit_1'),'user_rights_delete_1'=>$request->input('user_rights_delete_1')]);
        }
        else if($action=='create_form')
        {
            return view('Masters.designation_creation.create');
        }
        else if($action=='update_form')
        {
            $designation_creation=$this->retrieve($request->input('id'));
            return view('Masters.designation_creation.update',['designation_creation'=>$designation_creation[0]]);
        }
        else if($action=='statusinfo')
        {
            $stat = $request->input('status')==1 ? "0" : "1";

            $tb = DesignationCreation::find($request->input('id'));
            $tb->status = $stat;
            $tb->save();

        }
    }
}
