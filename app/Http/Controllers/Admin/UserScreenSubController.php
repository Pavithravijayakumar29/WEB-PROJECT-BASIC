<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\UserScreenSub;
use App\Models\Admin\UserScreenMain;
use App\Models\Admin\UserScreenOptions;
use App\Models\Admin\UserPermission;
use App\Models\Admin\UserType;
use Carbon\Carbon;
class UserScreenSubController extends Controller
{
    public function retrieve($id)
    {
        $UserScreenSub_tb = (new UserScreenSub)->getTable();
        $UserScreenMain_tb = (new UserScreenMain)->getTable();
        if($id=='')
        {return UserScreenSub::join($UserScreenMain_tb, $UserScreenMain_tb.'.id', '=', $UserScreenSub_tb.'.user_screen_main_id')->where(function($query) use ($UserScreenSub_tb){$query->where($UserScreenSub_tb.'.delete_status', '0')->orWhereNull($UserScreenSub_tb.'.delete_status');})->orderBy($UserScreenSub_tb.'.user_screen_main_id')->orderBy($UserScreenSub_tb.'.sub_screen_name')->get([$UserScreenSub_tb.'.id',$UserScreenSub_tb.'.user_screen_main_id',$UserScreenMain_tb.'.screen_name',$UserScreenSub_tb.'.sub_screen_name',$UserScreenSub_tb.'.description',$UserScreenSub_tb.'.status']);}
        else
        {return UserScreenSub::join($UserScreenMain_tb, $UserScreenMain_tb.'.id', '=', $UserScreenSub_tb.'.user_screen_main_id')->where($UserScreenSub_tb.'.id','=',$id)->get([$UserScreenSub_tb.'.id',$UserScreenSub_tb.'.sub_screen_name',$UserScreenSub_tb.'.description',$UserScreenSub_tb.'.user_screen_main_id',$UserScreenMain_tb.'.screen_name',$UserScreenSub_tb.'.status'])->first();}
    }
    public function db_cmd(Request $request)
    {
        $action=$request->input('action');
        if($action=='insert')
        {
            $cnt=UserScreenSub::where('sub_screen_name','=',$request->input('sub_screen_name'))->where('user_screen_main_id','=',$request->input('user_screen_main_id'))->where(function($query){$query->where('delete_status', '0')->orWhereNull('delete_status');})->count();
            if($cnt>0){return $cnt;}
            else
            {
                $User_screen_sub_id = UserScreenSub::insertGetId([
                    'entry_date' => Carbon::now(),
                    'user_screen_main_id' => $request->input('user_screen_main_id'),
                    'sub_screen_name' => $request->input('sub_screen_name'),
                    'description' => $request->input('description'),
                    'status' => $request->input('status')
                ]);
            }
        }
        else if($action=='update')
        {
            $cnt=UserScreenSub::where('sub_screen_name','=',$request->input('sub_screen_name'))->where('user_screen_main_id','=',$request->input('user_screen_main_id'))->where(function($query){$query->where('delete_status', '0')->orWhereNull('delete_status');})->where('id','!=',$request->input('id'))->count();
            if($cnt>0){return $cnt;}
            else
            {
                $tb = UserScreenSub::find($request->input('id'));
                $tb->user_screen_main_id = $request->input('user_screen_main_id');
                $tb->sub_screen_name = $request->input('sub_screen_name');
                $tb->description = $request->input('description');
                $tb->status = $request->input('status');
                $tb->save();
            }
        }
        else if($action=='delete')
        {
            $tb = UserScreenSub::find($request->input('id'));
            $tb->delete_status = "1";
            $tb->save();
        }
        else if($action=='retrieve')
        {
            $user_screen_sub = $this->retrieve('');
            return view('Admin.user_screen_sub.list',['user_screen_sub'=>$user_screen_sub,'user_rights_edit_1'=>$request->input('user_rights_edit_1'),'user_rights_delete_1'=>$request->input('user_rights_delete_1')]);
        }
        else if($action=='create_form')
        {
            $user_screen_main=UserScreenMain::select('id','screen_name')->where('status', '1')->where(function($query){$query->where('delete_status', '0')->orWhereNull('delete_status');})->orderBy('screen_name')->get();
            return view('Admin.user_screen_sub.create',['user_screen_main'=>$user_screen_main]);
        }
        else if($action=='update_form')
        {
            $user_screen_main=UserScreenMain::select('id','screen_name')->where('status', '1')->where(function($query){$query->where('delete_status', '0')->orWhereNull('delete_status');})->orderBy('screen_name')->get();
            $user_screen_sub=$this->retrieve($request->input('id'));
            return view('Admin.user_screen_sub.update',['user_screen_main'=>$user_screen_main,'user_screen_sub'=>$user_screen_sub]);
        }
        else if($action=='rights_form')
        {
            $user_screen_options=UserScreenOptions::select('id','option_name','make_default')->where(function($query){$query->where('delete_status', '0')->orWhereNull('delete_status');})->get();
            $user_permission1=UserPermission::select('id','user_type_id','option_ids')->where('user_screen_main_id',$request->input('user_screen_main_id'))->where('user_screen_sub_id',$request->input('user_screen_sub_id'))->where(function($query){$query->where('delete_status', '0')->orWhereNull('delete_status');})->get();
            $user_permission=[];
            foreach($user_permission1 as $user_permission2){
                $user_permission[$user_permission2['user_type_id']]=$user_permission2;
            }
            $user_type=UserType::select('id','user_type')->where('status', '1')->where(function($query){$query->where('delete_status', '0')->orWhereNull('delete_status');})->get();
            return view('Admin.user_screen_sub.rights_list',['user_screen_main_id'=>$request->input('user_screen_main_id'),'user_screen_sub_id'=>$request->input('user_screen_sub_id'),'screen_name'=>$request->input('screen_name'),'sub_screen_name'=>$request->input('sub_screen_name'),'user_screen_options'=>$user_screen_options,'user_permission'=>$user_permission,'user_type'=>$user_type]);
        }
        else if($action=='update_rights')
        {
            $user_screen_main_id=$request->input('user_screen_main_id');
            $user_screen_sub_id=$request->input('user_screen_sub_id');
            $user_type_ids=$request->get('user_type_ids');
            $user_type_option_ids=$request->get('user_type_option_ids');
            $user_type_options=$request->get('user_type_options');
            $entry_date1  = Carbon::now();
            for($i1=0;$i1<count($user_type_ids);$i1++)
            {
                if($user_type_option_ids[$i1]=="0"){
                    $tb = new UserPermission();
                    $tb->entry_date  = $entry_date1;
                    $tb->user_screen_main_id = $user_screen_main_id;
                    $tb->user_screen_sub_id = $user_screen_sub_id;
                    $tb->user_type_id = $user_type_ids[$i1];
                    $tb->option_ids = $user_type_options[$i1];
                    $tb->save();
                }else{
                    $tb = UserPermission::find($user_type_option_ids[$i1]);
                    $tb->option_ids = $user_type_options[$i1];
                    $tb->save();
                }
            }
        }
        else if($action=='statusinfo')
        {
            $stat = $request->input('status')==1 ? "0" : "1";

            $tb = UserScreenSub::find($request->input('id'));
            $tb->status = $stat;
            $tb->save();

        }
    }
}
