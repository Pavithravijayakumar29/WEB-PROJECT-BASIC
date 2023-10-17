<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WorkingDays;
class WorkingDaysController extends Controller
{
    public function retrieve($id)
    {
        if($id=='')
        {
            return WorkingDays::select('id','month_year','working_days','actual_month_days','status')->orderBy('month_year')->get();
        }
        else
        {
            return WorkingDays::select('id','month_year','actual_month_days','working_days','description')->orderBy('month_year')->where('id','=',$id)->get();
        }
    }
    public function db_cmd(Request $request)
    {
        $action=$request->input('action');
        if($action=='insert')
        {
            $tb = new WorkingDays();
            $tb->month_year = $request->input('month_year');
            $tb->actual_month_days = $request->input('actual_month_days');
            $tb->working_days = $request->input('working_days');
            $tb->status='1';
            $tb->description = $request->input('description');
            $tb->save();
        }
        else if($action=='update')
        {
            $tb = WorkingDays::find($request->input('id'));
            $tb->month_year = $request->input('month_year');
            $tb->actual_month_days = $request->input('actual_month_days');
            $tb->working_days = $request->input('working_days');
            $tb->description = $request->input('description');
            $tb->save();
        }
        else if($action=='delete')
        {
            $tb = WorkingDays::where('id','=',$request->input('id'));
            $tb->delete();
        }
        else if($action=='retrieve')
        {
            $working_days = $this->retrieve('');
            return view('Masters.working_days.list',['working_days'=>$working_days,'user_rights_edit_1'=>$request->input('user_rights_edit_1'),'user_rights_delete_1'=>$request->input('user_rights_delete_1')]);
        }
        else if($action=='count')
        {
            $cnt=0;
            $id=$request->input('id');$working_days=$request->input('working_days');
            if($id!="0"){$cnt=WorkingDays::where('working_days','=',$working_days)->where('id','!=',$id)->count();}
            else{$cnt=WorkingDays::where('working_days','=',$working_days)->count();}
            return $cnt;
        }
        else if($action=='create_form')
        {
            return view('Masters.working_days.create');
        }
        else if($action=='update_form')
        {
            $working_days=$this->retrieve($request->input('id'));
            return view('Masters.working_days.update',['working_days'=>$working_days[0]]);
        }
        else if($action=='statusinfo')
        {
            $stat = $request->input('status')==1 ? "0" : "1";
            $tb = WorkingDays::find($request->input('id'));
            $tb->status = $stat;
            $tb->save();

        }
    }
}
