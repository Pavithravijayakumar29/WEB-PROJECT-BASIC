<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\UserType;
use App\Models\Admin\UserScreenSub;
use App\Models\Admin\UserScreenMain;
use App\Models\Admin\UserScreenOptions;
use App\Models\Admin\UserPermission;
use Carbon\Carbon;
class UserPermissionController extends Controller
{
    public function user_permission()
    {
        $user_type=UserType::select('id','user_type')->where('status', '1')->where(function($query){$query->where('delete_status', '0')->orWhereNull('delete_status');})->orderBy('user_type')->get();

        return view('Admin.user_permission.admin',['user_type'=>$user_type]);
    }
    public function db_cmd(Request $request)
    {
        $action=$request->input('action');
        if($action=='retrieve')
        {
            $user_type_id=$request->input('user_type_id');
            $user_screen_main=UserScreenMain::select('id','screen_name')->where('status', '1')->where(function($query){$query->where('delete_status', '0')->orWhereNull('delete_status');})->get();
            $user_screen_sub=[];
            $user_screen_options1=UserScreenOptions::select('id','option_name','make_default')->where(function($query){$query->where('delete_status', '0')->orWhereNull('delete_status');})->get();
            $user_screen_options=[];$user_screen_options_defaults=[];
            foreach($user_screen_options1 as $user_screen_options1_1)
            {
                $user_screen_options[$user_screen_options1_1['id']]=$user_screen_options1_1;
                if($user_screen_options1_1['make_default']=='1')
                {$user_screen_options_defaults[]=$user_screen_options1_1['id'];}
            }
            $user_permission=[];
            foreach($user_screen_main as $user_screen_main1)
            {
                $id1=$user_screen_main1['id'];
                $user_screen_sub[$id1]=UserScreenSub::where('user_screen_main_id', $id1)->where('status', '1')->where(function($query){$query->where('delete_status', '0')->orWhereNull('delete_status');})->get(['id','sub_screen_name','description','status']);
                foreach($user_screen_sub[$id1] as $user_screen_sub1)
                {
                    $id2=$user_screen_sub1['id'];
                    $user_permission[$id1][$id2]=UserPermission::select('id','option_ids','option_id_selected')->where('user_type_id',$user_type_id)->where('user_screen_main_id',$id1)->where('user_screen_sub_id',$id2)->where(function($query){$query->where('delete_status', '0')->orWhereNull('delete_status');})->get()->first();
                }
            }
            return view('Admin.user_permission.update',['user_type_id'=>$user_type_id,'user_type'=>$request->input('user_type'),'user_screen_main'=>$user_screen_main,'user_screen_sub'=>$user_screen_sub,'user_screen_options'=>$user_screen_options,'user_screen_options_defaults'=>$user_screen_options_defaults,'user_permission'=>$user_permission,'user_rights_edit_1'=>$request->input('user_rights_edit_1'),'user_rights_delete_1'=>$request->input('user_rights_delete_1')]);
        }
        else if($action=='update_perm')
        {
            $user_type_id=$request->input('user_type_id');
            $perm_valu=$request->post('perm_valu');
            $entry_date1  = Carbon::now();
            foreach($perm_valu as $perm_valu1)
            {
                if($perm_valu1[2]=="0"){
                    $tb = new UserPermission();
                    $tb->entry_date  = $entry_date1;
                    $tb->user_screen_main_id = $perm_valu1[0];
                    $tb->user_screen_sub_id = $perm_valu1[1];
                    $tb->user_type_id = $user_type_id;
                    $tb->option_ids = $perm_valu1[3];
                    $tb->option_id_selected = $perm_valu1[4];
                    $tb->save();
                }else{
                    $tb = UserPermission::find($perm_valu1[2]);
                    $tb->option_ids = $perm_valu1[3];
                    $tb->option_id_selected = $perm_valu1[4];
                    $tb->save();
                }
            }
        }
        else if($action=='rights_form')
        {
            $user_type_id=$request->input('user_type_id');
            $user_screen_main=UserScreenMain::select('id','screen_name')->where('status', '1')->where(function($query){$query->where('delete_status', '0')->orWhereNull('delete_status');})->get();
            $user_screen_sub=[];
            $user_screen_options1=UserScreenOptions::select('id','option_name','make_default')->where(function($query){$query->where('delete_status', '0')->orWhereNull('delete_status');})->get();
            $user_screen_options=[];$user_screen_options_defaults=[];
            foreach($user_screen_options1 as $user_screen_options1_1)
            {
                $user_screen_options[$user_screen_options1_1['id']]=$user_screen_options1_1;
                if($user_screen_options1_1['make_default']=='1')
                {$user_screen_options_defaults[]=$user_screen_options1_1['id'];}
            }
            $user_permission=[];
            foreach($user_screen_main as $user_screen_main1)
            {
                $id1=$user_screen_main1['id'];
                $user_screen_sub[$id1]=UserScreenSub::where('user_screen_main_id', $id1)->where('status', '1')->where(function($query){$query->where('delete_status', '0')->orWhereNull('delete_status');})->get(['id','sub_screen_name','description','status']);
                foreach($user_screen_sub[$id1] as $user_screen_sub1)
                {
                    $id2=$user_screen_sub1['id'];
                    $user_permission[$id1][$id2]=UserPermission::select('id','option_ids','option_id_selected')->where('user_type_id',$user_type_id)->where('user_screen_main_id',$id1)->where('user_screen_sub_id',$id2)->where(function($query){$query->where('delete_status', '0')->orWhereNull('delete_status');})->get()->first();
                }
            }
            return view('Admin.user_permission.rights_list',['user_type_id'=>$user_type_id,'user_type'=>$request->input('user_type'),'user_screen_main'=>$user_screen_main,'user_screen_sub'=>$user_screen_sub,'user_screen_options'=>$user_screen_options,'user_screen_options_defaults'=>$user_screen_options_defaults,'user_permission'=>$user_permission,'user_rights_edit_1'=>$request->input('user_rights_edit_1'),'user_rights_delete_1'=>$request->input('user_rights_delete_1')]);
        }
        else if($action=='update_rights')
        {
            $user_screen_main_id=$request->input('user_screen_main_id');
            $user_screen_sub_id=$request->input('user_screen_sub_id');
            $user_type_ids=$request->post('user_type_ids');
            $user_type_option_ids=$request->post('user_type_option_ids');
            $user_type_options=$request->post('user_type_options');
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
    }
    public function get_login_details($cur_pg_uri)
    {
        session_start();
        if (isset($_SESSION['last_activity'])) {
            if((time() - $_SESSION['last_activity']) > 1800)
            {session_unset();session_destroy();}
        }
        $_SESSION['last_activity'] = time();
        if(isset($_SESSION['user']))
        {
            $user_type_id=$_SESSION['user_type_id'];
            $user_rights_view=1;$user_rights_add=1;$user_rights_edit=1;$user_rights_delete=1;
            $screen=[
                ["Dashboard"=>"1"],
                ["User_Type"=>"2","User_Creation"=>"3","User_Screen_Main"=>"4","User_Screen_Sub"=>"5","User_Permission"=>"6"],
                ["Company_Creations"=>"7","Country_Creation"=>"8","State_Creation"=>"9","District_Creation"=>"10","Market_Creation"=>"11","Sales_Rep_Creation"=>"12","advance_creation"=>"13","expense_type_creation"=>"14","sub_expense_type_creation"=>"15",
                "account_ledger_creation"=>"51","Shops_Type"=>"17","Dealer_Creation"=>"18","Designation_Creation"=>"19","Category_Creation"=>"20","Group_Creation"=>"21","Tax_Creation"=>"22","Item_Creation"=>"23","Working_Days"=>"24","Customer_Creation"=>"25","Market_Manager_Creation"=>"26","Item_Liters_Type"=>"48","Item_Properties_Type"=>"49","return_creation"=>"53"],
				["Attendance_Entry"=>"27","Sales_Order-COMPANY_TO_DEALER"=>"28","Sales_Order-DEALER_TO_SHOP"=>"29","Sales_Order_Stock"=>"50","Sales_Order_Delivery"=>"30","Expense_Creations"=>"52","Receipt_Entry"=>"33"]
            ];
            $main_screen_id="0";$sub_screen_id="0";
            for($i1=0;$i1<count($screen);$i1++)
            {
                if(array_key_exists($cur_pg_uri, $screen[$i1]))
                {$main_screen_id="".($i1+1);$sub_screen_id=$screen[$i1][$cur_pg_uri];break;}
            }
            if(($main_screen_id!="0") && ($sub_screen_id!="0"))
            {
                $user_screen_options_defaults=[];
                $user_screen_options1=UserScreenOptions::where('make_default', '1')->where(function($query){$query->where('delete_status', '0')->orWhereNull('delete_status');})->get(['id','option_name','make_default']);
                foreach($user_screen_options1 as $user_screen_options2){$user_screen_options_defaults[]=$user_screen_options2['id'];}
                $user_permission=['option_ids'=>"",'option_id_selected'=>""];
                $user_screen_main=UserScreenMain::where('id',$main_screen_id)->where('status', '1')->where(function($query){$query->where('delete_status', '0')->orWhereNull('delete_status');})->get()->count();
                if($user_screen_main>0)
                {
                    $user_screen_sub=UserScreenSub::where('id',$sub_screen_id)->where('user_screen_main_id', $main_screen_id)->where('status', '1')->where(function($query){$query->where('delete_status', '0')->orWhereNull('delete_status');})->get()->count();
                    if($user_screen_sub>0)
                    {
                        $user_permission1=UserPermission::where('user_type_id',$user_type_id)->where('user_screen_main_id',$main_screen_id)->where('user_screen_sub_id',$sub_screen_id)->where(function($query){$query->where('delete_status', '0')->orWhereNull('delete_status');})->get(['option_ids','option_id_selected'])->first();
                        if($user_permission1){$user_permission=['option_ids'=>$user_permission1['option_ids'],'option_id_selected'=>$user_permission1['option_id_selected']];}
                    }
                }
                if($user_permission['option_ids']!="")
                {
                    $option_ids1=explode(",",$user_permission['option_ids']);
                    $option_id_selected1=explode(",",$user_permission['option_id_selected']);
                    $user_rights_view=((in_array("1",$option_ids1))?(in_array("1",$option_id_selected1)?1:0):0);
                    $user_rights_add=((in_array("2",$option_ids1))?(in_array("2",$option_id_selected1)?1:0):0);
                    $user_rights_edit=((in_array("3",$option_ids1))?(in_array("3",$option_id_selected1)?1:0):0);
                    $user_rights_delete=((in_array("4",$option_ids1))?(in_array("4",$option_id_selected1)?1:0):0);
                }
                else
                {
                    $user_rights_view=(in_array("1",$user_screen_options_defaults)?1:0);
                    $user_rights_add=(in_array("2",$user_screen_options_defaults)?1:0);
                    $user_rights_edit=(in_array("3",$user_screen_options_defaults)?1:0);
                    $user_rights_delete=(in_array("4",$user_screen_options_defaults)?1:0);
                }
            }
            session_write_close();
            return ["user_type_id"=>$user_type_id,"session_user_name"=>$_SESSION['user'],"user_rights_view"=>$user_rights_view,"user_rights_add"=>$user_rights_add,"user_rights_edit"=>$user_rights_edit,"user_rights_delete"=>$user_rights_delete];
        }
        else
        {
            session_write_close();
            return ["user_rights_view"=>0,"user_rights_add"=>0,"user_rights_edit"=>0,"user_rights_delete"=>0];
        }
    }
    public function get_perm_view_details($user_type_id)
    {
        $user_rights_view=[];
        $user_screen_options_defaults=[];
        $user_screen_options1=UserScreenOptions::where('make_default', '1')->where(function($query){$query->where('delete_status', '0')->orWhereNull('delete_status');})->get(['id']);
        foreach($user_screen_options1 as $user_screen_options2)
        {$user_screen_options_defaults[]=$user_screen_options2['id'];}
        $user_screen_main=UserScreenMain::where('status', '1')->where(function($query){$query->where('delete_status', '0')->orWhereNull('delete_status');})->get(['id']);
        foreach($user_screen_main as $user_screen_main1)
        {
            $id1=$user_screen_main1['id'];
            $user_screen_sub=UserScreenSub::where('user_screen_main_id', $id1)->where('status', '1')->where(function($query){$query->where('delete_status', '0')->orWhereNull('delete_status');})->get();
            foreach($user_screen_sub as $user_screen_sub1)
            {
                $id2=$user_screen_sub1['id'];
                $user_permission=['option_ids'=>"",'option_id_selected'=>""];
                $user_permission1=UserPermission::where('user_type_id',$user_type_id)->where('user_screen_main_id',$id1)->where('user_screen_sub_id',$id2)->where(function($query){$query->where('delete_status', '0')->orWhereNull('delete_status');})->get(['option_ids','option_id_selected'])->first();
                if($user_permission1)
                {$user_permission=['option_ids'=>$user_permission1['option_ids'],'option_id_selected'=>$user_permission1['option_id_selected']];}
                if($user_permission['option_ids']!="")
                {
                    $option_ids1=explode(",",$user_permission['option_ids']);
                    if(in_array("1",$option_ids1))
                    {
                        $option_id_selected1=explode(",",$user_permission['option_id_selected']);
                        $user_rights_view[$id1][$id2]=(in_array("1",$option_id_selected1))?"":" style='display:none;'";
                    }
                    else{$user_rights_view[$id1][$id2]=" style='display:none;'";}
                }
                else{$user_rights_view[$id1][$id2]=(in_array("1",$user_screen_options_defaults)?"":" style='display:none;'");}
            }
        }
        return $user_rights_view;
    }
}
