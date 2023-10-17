<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubExpenseTypeCreation;
use App\Models\ExpenseTypeCreation;
class SubExpenseTypeCreationController extends Controller
{
    public function retrieve($id)
    {
        $expensetype = (new ExpenseTypeCreation)->getTable();
        $sub_expensetype = (new SubExpenseTypeCreation)->getTable();
        if($id=='')
        {return SubExpenseTypeCreation::join($expensetype,$expensetype.'.id','=', $sub_expensetype.'.expense_type')
            ->where(function($query) use ($sub_expensetype){$query->where($sub_expensetype.'.delete_status', '0')->orWhereNull($sub_expensetype.'.delete_status');})
            ->get([$sub_expensetype.'.id',$sub_expensetype.'.sub_expense_type',$expensetype.'.expense_type',$sub_expensetype.'.description',$sub_expensetype.'.status']);}
        else
        {
            return SubExpenseTypeCreation::join($expensetype,$expensetype.'.id','=', $sub_expensetype.'.expense_type')->where($sub_expensetype.'.id','=',$id)->get([$sub_expensetype.'.id',$sub_expensetype.'.sub_expense_type',$sub_expensetype.'.expense_type',$sub_expensetype.'.description'])->first();
        }
    }
    public function db_cmd(Request $request)
    {
        $action=$request->input('action');
        if($action=='insert')
        {
            $tb = new SubExpenseTypeCreation();
            $tb->expense_type = $request->input('expense_type');
            $tb->sub_expense_type = $request->input('sub_expense_type');
            $tb->status='0';
            $tb->description = $request->input('description');
            $tb->save();
        }
        else if($action=='update')
        {
            $tb = SubExpenseTypeCreation::find($request->input('id'));
            $tb->expense_type = $request->input('expense_type');
             $tb->expense_type = $request->input('expense_type');
            $tb->description = $request->input('description');
            $tb->save();
        }
        else if($action=='delete')
        {
            $tb = SubExpenseTypeCreation::find($request->input('id'));
            $tb->delete_status = '1';
            $tb->save();
        }
        else if($action=='retrieve')
        {
            $expense_type = $this->retrieve('');
            return view('Masters.sub_expense_type_creation.list',['expense_type'=>$expense_type,'user_rights_edit_1'=>$request->input('user_rights_edit_1'),'user_rights_delete_1'=>$request->input('user_rights_delete_1')]);
        }
        else if($action=='count')
        {
            $cnt=0;
            $id=$request->input('id');$expense_type=$request->input('expense_type');
            if($id!="0"){$cnt=SubExpenseTypeCreation::where('expense_type','=',$expense_type)->where('id','!=',$id)->count();}
            else{$cnt=SubExpenseTypeCreation::where('expense_type','=',$expense_type)->count();}
            return $cnt;
        }
        else if($action=='create_form')
        {
            $expense_type=ExpenseTypeCreation::select('id','expense_type')->where('expense_type','!=','')->orderBy('expense_type')->get();

            return view('Masters.sub_expense_type_creation.create',['expense_type'=>$expense_type]);

        }
        else if($action=='update_form')
        {
            $expense_type_sub=ExpenseTypeCreation::select('id','expense_type')->orderBy('expense_type')->get();
            $expense_type=$this->retrieve($request->input('id'));

            return view('Masters.sub_expense_type_creation.update',['expense_type_sub'=>$expense_type_sub,'expense_type'=>$expense_type]);
        }
        else if($action=='statusinfo')
        {
            $stat = $request->input('status')==1 ? "0" : "1";
            $tb = SubExpenseTypeCreation::find($request->input('id'));
            $tb->status = $stat;
            $tb->save();

        }
    }
}
