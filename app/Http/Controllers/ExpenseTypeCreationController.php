<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ExpenseTypeCreation;

class ExpenseTypeCreationController extends Controller
{
    public function retrieve($id)
    {
        if($id=='')
        {return ExpenseTypeCreation::select('id','expense_type','status','description')->where(function($query){$query->where('delete_status', '0')->orWhereNull('delete_status');})->orderBy('expense_type')->get();}
        else
        {return ExpenseTypeCreation::select('id','expense_type','description')->orderBy('expense_type')->where('id','=',$id)->get();}
    }
    public function db_cmd(Request $request)
    {
        $action=$request->input('action');
        if($action=='insert')
        {
            $tb = new ExpenseTypeCreation();
            $tb->expense_type = $request->input('expense_type');
            $tb->description = $request->input('description');
            $tb->status='1';
            $tb->save();
        }
        else if($action=='update')
        {
            $tb = ExpenseTypeCreation::find($request->input('id'));
            $tb->expense_type = $request->input('expense_type');
            $tb->description = $request->input('description');
            $tb->save();
        }
        else if($action=='delete')
        {
            $tb = ExpenseTypeCreation::find($request->input('id'));
            $tb->delete_status = '1';
            $tb->save();
            
        }
        else if($action=='retrieve')
        {
            $expense_type = $this->retrieve('');
            return view('Masters.expense_type_creation.list',['expense_type'=>$expense_type,'user_rights_edit_1'=>$request->input('user_rights_edit_1'),'user_rights_delete_1'=>$request->input('user_rights_delete_1')]);
        }
        else if($action=='count')
        {
            $cnt=0;
            $id=$request->input('id');$expense_type=$request->input('expense_type');
            if($id!="0"){$cnt=ExpenseTypeCreation::where('expense_type','=',$expense_type)->where('id','!=',$id)->count();}
            else{$cnt=ExpenseTypeCreation::where('expense_type','=',$expense_type)->count();}
            return $cnt;
        }
        else if($action=='create_form')
        {
            return view('Masters.expense_type_creation.create');
        }
        else if($action=='update_form')
        {
            $expense_type=$this->retrieve($request->input('id'));
            return view('Masters.expense_type_creation.update',['expense_type'=>$expense_type[0]]);
        }
        else if($action=='statusinfo')
        {
            $stat = $request->input('status')==1 ? "0" : "1";

            $tb = ExpenseTypeCreation::find($request->input('id'));
            $tb->status = $stat;
            $tb->save();

        }
    }
}
