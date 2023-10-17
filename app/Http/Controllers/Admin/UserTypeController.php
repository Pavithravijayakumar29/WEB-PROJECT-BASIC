<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\UserType;
use Carbon\Carbon;
class UserTypeController extends Controller
{
    public function retrieve($id)
    {
        if($id=='')
        {return UserType::select('id','user_type','status')->where(function($query){$query->where('delete_status', '0')->orWhereNull('delete_status');})->orderBy('user_type')->get();}
        else
        {return UserType::select('id','user_type','status')->where('id','=',$id)->get()->first();}
    }
    public function db_cmd(Request $request)
    {
        $action=$request->input('action');
        if($action=='insert')
        {
            $cnt=UserType::where('user_type','=',$request->input('user_type'))->where(function($query){$query->where('delete_status', '0')->orWhereNull('delete_status');})->count();
            if($cnt>0){return $cnt;}
            else
            {
                $tb = new UserType();
                $tb->entry_date  = Carbon::now();
                $tb->user_type = $request->input('user_type');
                $tb->status = $request->input('status');
                $tb->save();
            }
        }
        else if($action=='update')
        {
            $cnt=UserType::where('user_type','=',$request->input('user_type'))->where('id','!=',$request->input('id'))->where(function($query){$query->where('delete_status', '0')->orWhereNull('delete_status');})->count();
            if($cnt>0){return $cnt;}
            else
            {
                $tb = UserType::find($request->input('id'));
                $tb->user_type = $request->input('user_type');
                $tb->status = $request->input('status');
                $tb->save();
            }
        }
        else if($action=='delete')
        {
            $tb = UserType::find($request->input('id'));
            $tb->delete_status = "1";
            $tb->save();
        }
        else if($action=='retrieve')
        {
            $user_type = $this->retrieve('');
            return view('Admin.user_type.list',['user_type'=>$user_type,'user_rights_edit_1'=>$request->input('user_rights_edit_1'),'user_rights_delete_1'=>$request->input('user_rights_delete_1')]);
        }
        else if($action=='create_form')
        {
            return view('Admin.user_type.create');
        }
        else if($action=='update_form')
        {
            $user_type=$this->retrieve($request->input('id'));
            return view('Admin.user_type.update',['user_type'=>$user_type]);
        }
        else if($action=='statusinfo')
        {
            $stat = $request->input('status')==1 ? "0" : "1";

            $tb = UserType::find($request->input('id'));
            $tb->status = $stat;
            $tb->save();

        }
    }
}
