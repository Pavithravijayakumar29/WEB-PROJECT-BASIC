<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\UserScreenMain;
use Carbon\Carbon;
class UserScreenMainController extends Controller
{
    public function retrieve($id)
    {
        if($id=='')
        {return UserScreenMain::select('id','screen_name','description','status')->where(function($query){$query->where('delete_status', '0')->orWhereNull('delete_status');})->orderBy('screen_name')->get();}
        else
        {return UserScreenMain::select('id','screen_name','description','status')->where('id','=',$id)->get()->first();}
    }
    public function db_cmd(Request $request)
    {
        $action=$request->input('action');
        if($action=='insert')
        {
            $cnt=UserScreenMain::where('screen_name','=',$request->input('screen_name'))->where(function($query){$query->where('delete_status', '0')->orWhereNull('delete_status');})->count();
            if($cnt>0){return $cnt;}
            else
            {
                $tb = new UserScreenMain();
                $tb->entry_date  = Carbon::now();
                $tb->screen_name = $request->input('screen_name');
                $tb->description = $request->input('description');
                $tb->status = $request->input('status');
                $tb->save();
            }
        }
        else if($action=='update')
        {
            $cnt=UserScreenMain::where('screen_name','=',$request->input('screen_name'))->where('id','!=',$request->input('id'))->where(function($query){$query->where('delete_status', '0')->orWhereNull('delete_status');})->count();
            if($cnt>0){return $cnt;}
            else
            {
                $tb = UserScreenMain::find($request->input('id'));
                $tb->screen_name = $request->input('screen_name');
                $tb->description = $request->input('description');
                $tb->status = $request->input('status');
                $tb->save();
            }
        }
        else if($action=='delete')
        {
            $tb = UserScreenMain::find($request->input('id'));
            $tb->delete_status = "1";
            $tb->save();
        }
        else if($action=='retrieve')
        {
            $user_screen_main = $this->retrieve('');
            return view('Admin.user_screen_main.list',['user_screen_main'=>$user_screen_main,'user_rights_edit_1'=>$request->input('user_rights_edit_1'),'user_rights_delete_1'=>$request->input('user_rights_delete_1')]);
        }
        else if($action=='create_form')
        {
            return view('Admin.user_screen_main.create');
        }
        else if($action=='update_form')
        {
            $user_screen_main=$this->retrieve($request->input('id'));
            return view('Admin.user_screen_main.update',['user_screen_main'=>$user_screen_main]);
        }
        else if($action=='statusinfo')
        {
            $stat = $request->input('status')==1 ? "0" : "1";

            $tb = UserScreenMain::find($request->input('id'));
            $tb->status = $stat;
            $tb->save();

        }
    }
}
