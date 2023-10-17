<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TaxCreation;

class TaxCreationController extends Controller
{
    public function retrieve($id)
    {
        if($id=='')
        {return TaxCreation::select('id','tax_name','status','percentage')->where ('delete_status',0)->orWhereNull('delete_status')->orderBy('tax_name')->get();}
        else
        {return TaxCreation::select('id','tax_name','percentage')->orderBy('tax_name')->where('id','=',$id)->get();}
    }
    public function db_cmd(Request $request)
    {
        $action=$request->input('action');
        if($action=='insert')
        {
            $cnt=TaxCreation::where('tax_name','=',$request->input('tax_name'))->where('percentage','=',$request->input('percentage'))->where(function($query){$query->where('delete_status', '0')->orWhereNull('delete_status');})->count();
            if($cnt>0){return $cnt;}
            else
            {
            $tb = new TaxCreation();
            $tb->tax_name = $request->input('tax_name');
            $tb->percentage = $request->input('percentage');
            $tb->status='1';
            $tb->save();
            }
        }
        else if($action=='update')
        {
            $cnt=TaxCreation::where('tax_name','=',$request->input('tax_name'))->where('percentage','=',$request->input('percentage'))->where(function($query){$query->where('delete_status', '0')->orWhereNull('delete_status');})->count();

            $tb = TaxCreation::find($request->input('id'));
            $tb->tax_name = $request->input('tax_name');
            $tb->percentage = $request->input('percentage');
            $tb->save();

        }
        else if($action=='delete')
        {
            $tb = TaxCreation::find($request->input('id'));
            $tb->delete_status = "1";
            $tb->save();
        }
        else if($action=='retrieve')
        {
            $tax_creation = $this->retrieve('');
            return view('Masters.tax_creation.list',['tax_creation'=>$tax_creation,'user_rights_edit_1'=>$request->input('user_rights_edit_1'),'user_rights_delete_1'=>$request->input('user_rights_delete_1')]);
        }
        else if($action=='create_form')
        {
            return view('Masters.tax_creation.create');
        }
        else if($action=='update_form')
        {
            $tax_creation=$this->retrieve($request->input('id'));
            return view('Masters.tax_creation.update',['tax_creation'=>$tax_creation[0]]);
        }
        else if($action=='statusinfo')
        {
            $stat = $request->input('status')==1 ? "0" : "1";
            $tb = TaxCreation::find($request->input('id'));
            $tb->status = $stat;
            $tb->save();

        }
    }
}
