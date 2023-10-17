<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\UserType;
use App\Models\Admin\UserCreation;
use App\Models\SalesRepCreation;
use App\Models\MarketManagerCreation;
use App\Models\DesignationCreation;
use Carbon\Carbon;
class UserCreationController extends Controller
{
    public function retrieve($id)
    {
        $UserType_tb = (new UserType)->getTable();
        $staff_tb = (new SalesRepCreation)->getTable();
        $designation_tb = (new DesignationCreation)->getTable();
         $market_tb = (new MarketManagerCreation)->getTable();
        $UserCreation_tb = (new UserCreation)->getTable();
        if($id=='')
        {return UserCreation::join($UserType_tb, $UserType_tb.'.id', '=', $UserCreation_tb.'.user_type_id')->where(function($query) use ($UserCreation_tb){$query->where($UserCreation_tb.'.delete_status', '0')->orWhereNull($UserCreation_tb.'.delete_status');})->orderBy($UserCreation_tb.'.user_name')->get([$UserCreation_tb.'.id',$UserCreation_tb.'.user_type_id',$UserType_tb.'.user_type',$UserCreation_tb.'.user_name',$UserCreation_tb.'.status']);}
        else
        {

            $user_creation = UserCreation::find($id);
            return $user_creation;
            if($user_creation->staff_id!=''){
                return UserCreation::join($UserType_tb, $UserType_tb.'.id', '=', $UserCreation_tb.'.user_type_id')
                ->join($staff_tb,$staff_tb.'.id','=',$UserCreation_tb.'.staff_id')
                ->join($designation_tb,$designation_tb.'.id','=',$UserCreation_tb.'.designation_id')

                ->where($UserCreation_tb.'.id','=',$id)->get([$UserCreation_tb.'.id',$UserCreation_tb.'.user_type_id',$UserType_tb.'.user_type',$UserCreation_tb.'.user_name',$UserCreation_tb.'.status',$UserCreation_tb.'.password',$UserCreation_tb.'.confirm_password',$staff_tb.'.sales_ref_name',$UserCreation_tb.'.staff_id',$UserCreation_tb.'.designation_id',$designation_tb.'.designation_name',$UserCreation_tb.'.market_manager'])->first();
            }else{
                UserCreation::join($UserType_tb, $UserType_tb.'.id', '=', $UserCreation_tb.'.user_type_id')
            ->join($designation_tb,$designation_tb.'.id','=',$UserCreation_tb.'.designation_id')
            ->join($market_tb,$market_tb.'.id','=',$UserCreation_tb.'.market_manager')
            ->where($UserCreation_tb.'.id','=',$id)->get([$UserCreation_tb.'.id',$UserCreation_tb.'.user_type_id',$UserType_tb.'.user_type',$UserCreation_tb.'.user_name',$UserCreation_tb.'.status',$UserCreation_tb.'.password',$UserCreation_tb.'.confirm_password',$UserCreation_tb.'.staff_id',$UserCreation_tb.'.designation_id',$designation_tb.'.designation_name',$UserCreation_tb.'.market_manager',$market_tb.'.manager_name'])->first();
            }
        }
    }
    public function db_cmd(Request $request)
    {
        $action=$request->input('action');
        if($action=='insert')
        {
            $cnt=UserCreation::where('user_name','=',$request->input('user_name'))->where(function($query){$query->where('delete_status', '0')->orWhereNull('delete_status');})->count();

            if($cnt>0){return $cnt;}
            else
            {
                $tb = new UserCreation();
                $tb->entry_date  = Carbon::now();
                $tb->user_type_id = $request->input('user_type_id');
                $tb->staff_id = $request->input('staff_id');
                $tb->market_manager = $request->input('mar_man');
                $tb->designation_id = $request->input('designation');
                $tb->user_name = $request->input('user_name');
                $encodedPassword = base64_encode($request->input('password'));
                $encodedConfirmPassword = base64_encode($request->input('confirm_password'));

                $tb->password = $encodedPassword;
                $tb->confirm_password = $encodedConfirmPassword;
                $tb->status = $request->input('status');
                $ipAddress = $request->ip();
                session_start();

                $tb->created_ipaddress = $ipAddress;
                $tb->save();
            }
        }
        else if($action=='update')
        {
            $cnt=UserCreation::where('user_name','=',$request->input('user_name'))->where('id','!=',$request->input('id'))->where(function($query){$query->where('delete_status', '0')->orWhereNull('delete_status');})->count();

                $tb = UserCreation::find($request->input('id'));
                $tb->user_type_id = $request->input('user_type_id');
                $tb->staff_id = $request->input('staff_id');
                 $tb->market_manager = $request->input('mar_man');
                $tb->designation_id = $request->input('designation');
                $tb->user_name = $request->input('user_name');
                $encodedPassword = base64_encode($request->input('password'));
                $encodedConfirmPassword = base64_encode($request->input('confirm_password'));

                $tb->password = $encodedPassword;
                $tb->confirm_password = $encodedConfirmPassword;
                $tb->status = $request->input('status');
                $ipAddress = $request->ip();
                session_start();
                $staff_id=$_SESSION['staff_id'];
                $tb->updated_staff_id=$staff_id;
                session_write_close();
                $tb->updated_ipaddress = $ipAddress;
                $tb->save();

        }
        else if($action=='delete')
        {
            $tb = UserCreation::find($request->input('id'));
            $tb->delete_status = "1";
            $tb->save();
        }
        else if($action=='retrieve')
        {
            $user_creation = $this->retrieve('');
            return view('Admin.user_creation.list',['user_creation'=>$user_creation,'user_rights_edit_1'=>$request->input('user_rights_edit_1'),'user_rights_delete_1'=>$request->input('user_rights_delete_1')]);
        }
        else if($action=='create_form')
        {
            $user_type=UserType::select('id','user_type')->where('status', '1')->where(function($query){$query->where('delete_status', '0')->orWhereNull('delete_status');})->orderBy('user_type')->get();

            $staff_creation=SalesRepCreation::select('id','sales_ref_name')->where(function($query){$query->where('delete_status', '0')->orWhereNull('delete_status');})->orderBy('sales_ref_name')->get();

             $designation=DesignationCreation::select('id','designation_name')->where(function($query){$query->where('delete_status', '0')->orWhereNull('delete_status');})->orderBy('designation_name')->get();

             $MarketManager=MarketManagerCreation::select('id','manager_name')->where(function($query){$query->where('delete_status', '0')->orWhereNull('delete_status');})->orderBy('manager_name')->get();

            return view('Admin.user_creation.create',['user_type'=>$user_type,'staff_creation'=>$staff_creation,'designation'=>$designation,'MarketManager'=>$MarketManager]);
        }
        else if($action=='update_form')
        {
            $user_type=UserType::select('id','user_type')->where('status', '1')
            ->where(function($query){$query->where('delete_status', '0')->orWhereNull('delete_status');})->orderBy('user_type')->get();

            $staff_creation=SalesRepCreation::select('id','sales_ref_name')->where(function($query){$query->where('delete_status', '0')->orWhereNull('delete_status');})->orderBy('sales_ref_name')->get();

             $designation=DesignationCreation::select('id','designation_name')->where(function($query){$query->where('delete_status', '0')->orWhereNull('delete_status');})->orderBy('designation_name')->get();

             $MarketManagerCreation=MarketManagerCreation::select('id','manager_name')
             ->where(function($query){$query->where('delete_status', '0')->orWhereNull('delete_status');})->get();



            $user_creation=$this->retrieve($request->input('id'));

            return view('Admin.user_creation.update',[
                'user_type'=>$user_type,
                'staff_creation'=>$staff_creation,
                'designation'=>$designation,
                'MarketManager' => $MarketManagerCreation,
                'user_creation'=>$user_creation
            ]);
        }
        else if($action=='statusinfo')
        {
            $stat = $request->input('status')==1 ? "0" : "1";

            $tb = UserCreation::find($request->input('id'));
            $tb->status = $stat;
            $tb->save();

        }
    }
}
