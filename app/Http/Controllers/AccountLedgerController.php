<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AccountLedger;

class AccountLedgerController extends Controller
{
    public function retrieve($id)
    {
        if($id=='')
        {return AccountLedger::select('id','ledger_name','status','description')->orderBy('ledger_name')->get();}
        else
        {return AccountLedger::select('id','ledger_name','description')->orderBy('ledger_name')->where('id','=',$id)->get();}
    }

    public function db_cmd(Request $request)
    {
        $action=$request->input('action');

        if ($action == 'insert') {
            $ledger_name = $request->input('ledger_name');
            $description = $request->input('description');
            $count = AccountLedger::where('ledger_name', $ledger_name)->count();

            if ($count > 0) {
                return response()->json(['error' => 'Country name already exists.']);
            }

            $tb = new AccountLedger();
            $tb->ledger_name = $ledger_name;
            $tb->status='1';
            $tb->description = $description;
            $tb->save();

            return response()->json(['message' => 'Record inserted successfully']);
        }


        else if ($action == 'update') {
            $ledger_name = $request->input('ledger_name');
            $description = $request->input('description');
            $id = $request->input('id');

            $count = AccountLedger::where('ledger_name', $ledger_name)
                ->where('id', '!=', $id)
                ->count();

            if ($count > 0) {
                return response()->json(['error' => 'Country name already exists.']);
            }

            $tb = AccountLedger::find($id);
            $tb->ledger_name = $ledger_name;
            $tb->description = $description;
            $tb->save();
            
            return response()->json(['message' => 'Record updated successfully']);
        }

        else if($action=='delete')
        {
            $tb = AccountLedger::where('id','=',$request->input('id'));
            $tb->delete();
        }
        else if($action=='retrieve')
        {
            $ledger_name = $this->retrieve('');
            return view('Masters.account_ledger_creation.list',['ledger_name'=>$ledger_name,'user_rights_edit_1'=>$request->input('user_rights_edit_1'),'user_rights_delete_1'=>$request->input('user_rights_delete_1')]);
        }
        else if($action=='count')
        {
            $cnt=0;
            $id=$request->input('id');$ledger_name=$request->input('ledger_name');
            if($id!="0"){$cnt=AccountLedger::where('ledger_name','=',$ledger_name)->where('id','!=',$id)->count();}
            else{$cnt=AccountLedger::where('ledger_name','=',$ledger_name)->count();}
            return $cnt;
        }
        else if($action=='create_form')
        {
            return view('Masters.account_ledger_creation.create');
        }
        else if($action=='update_form')
        {
            $ledger_name=$this->retrieve($request->input('id'));
            return view('Masters.account_ledger_creation.update',['ledger_name'=>$ledger_name[0]]);
        }
        else if($action=='statusinfo')
        {
            $stat = $request->input('status')==1 ? "0" : "1";

            $tb = AccountLedger::find($request->input('id'));
            $tb->status = $stat;
            $tb->save();

        }
    }
}
