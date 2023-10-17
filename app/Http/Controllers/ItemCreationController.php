<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoryCreation;
use App\Models\GroupCreation;
use App\Models\ItemCreation;
use App\Models\TaxCreation;
use App\Models\ItemLitersType;
use App\Models\ItemPropertiesType;

class ItemCreationController extends Controller
{
    public function retrieve($id)
    {
        $CategoryCreation_tb = (new CategoryCreation)->getTable();
        $GroupCreation_tb = (new GroupCreation)->getTable();
        $ItemCreation_tb = (new ItemCreation)->getTable();
        $TaxCreation_tb = (new TaxCreation)->getTable();

        if($id=='')
        {
           return ItemCreation::join($CategoryCreation_tb, $CategoryCreation_tb.'.id', '=', $ItemCreation_tb.'.category_id')->join($GroupCreation_tb, $ItemCreation_tb.'.group_id', '=', $GroupCreation_tb.'.id')->where($ItemCreation_tb.'.delete_status', '0')->orWhereNull($ItemCreation_tb.'.delete_status')->orderBy($ItemCreation_tb.'.item_name')->get([$ItemCreation_tb.'.id',$ItemCreation_tb.'.category_id',$CategoryCreation_tb.'.category_name',$ItemCreation_tb.'.group_id',$GroupCreation_tb.'.group_name',$ItemCreation_tb.'.item_name',$ItemCreation_tb.'.item_code',$ItemCreation_tb.'.hsn_code',$ItemCreation_tb.'.tax_id',$ItemCreation_tb.'.distributor_rate',$ItemCreation_tb.'.sub_dealer_rate',$ItemCreation_tb.'.piece',$ItemCreation_tb.'.description',$ItemCreation_tb.'.status',$ItemCreation_tb.'.short_code']);}
        else
        {return ItemCreation::join($CategoryCreation_tb, $CategoryCreation_tb.'.id', '=', $ItemCreation_tb.'.category_id')
            ->join($GroupCreation_tb, $ItemCreation_tb.'.group_id', '=', $GroupCreation_tb.'.id')->orderBy($ItemCreation_tb.'.item_name')
            ->where($ItemCreation_tb.'.id','=',$id)
            ->get([$ItemCreation_tb.'.id',$ItemCreation_tb.'.category_id',$CategoryCreation_tb.'.category_name',$ItemCreation_tb.'.group_id',$GroupCreation_tb.'.group_name',$ItemCreation_tb.'.item_name',$ItemCreation_tb.'.item_code',$ItemCreation_tb.'.hsn_code',$ItemCreation_tb.'.item_liters_type',$ItemCreation_tb.'.item_properties_type',$ItemCreation_tb.'.tax_id',$ItemCreation_tb.'.distributor_rate',$ItemCreation_tb.'.sub_dealer_rate',$ItemCreation_tb.'.piece',$ItemCreation_tb.'.description',$ItemCreation_tb.'.short_code']);}
    }
    public function db_cmd(Request $request)
    {
        $action=$request->input('action');
        if($action=='insert')
        {
            $cnt=ItemCreation::where('category_id','=',$request->input('category_id'))->where('group_id','=',$request->input('group_id'))->where('item_name','=',$request->input('item_name'))->where('item_code','=',$request->input('item_code'))->where('tax_id','=',$request->input('tax_id'))->where('distributor_rate','=',$request->input('distributor_rate'))->where('piece','=',$request->input('piece'))->where('short_code','=',$request->input('short_code'))->where('sub_dealer_rate','=',$request->input('sub_dealer_rate'))->where(function($query){$query->where('delete_status', '0')->orWhereNull('delete_status');})->count();
            if($cnt>0){return $cnt;}
            else{
            $tb = new ItemCreation();
            $tb->category_id = $request->input('category_id');
            $tb->group_id = $request->input('group_id');
            $tb->item_name = $request->input('item_name');
            $tb->item_code = $request->input('item_code');
            $tb->item_liters_type = $request->input('item_liters_type_id');
            $tb->item_liters_type = $request->input('item_liters_type_id');
            $tb->tax_id = $request->input('tax_id');
            $tb->distributor_rate = $request->input('distributor_rate');
            $tb->sub_dealer_rate = $request->input('sub_dealer_rate');
            $tb->status='1';
            $tb->description = $request->input('description');
            $tb->hsn_code = $request->input('hsn_code');
            $tb->piece = $request->input('piece');
            $tb->short_code = $request->input('short_code');
            $tb->save();
            }
        }
        else if($action=='update')
        {
            $cnt=ItemCreation::where('category_id','=',$request->input('category_id'))->where('group_id','=',$request->input('group_id'))->where('item_name','=',$request->input('item_name'))->where('item_code','=',$request->input('item_code'))->where('tax_id','=',$request->input('tax_id'))->where('distributor_rate','=',$request->input('distributor_rate'))->where('piece','=',$request->input('piece'))->where('sub_dealer_rate','=',$request->input('sub_dealer_rate'))->where(function($query){$query->where('delete_status', '0')->orWhereNull('delete_status');})->count();

            $tb = ItemCreation::find($request->input('id'));
            $tb->category_id = $request->input('category_id');
            $tb->group_id = $request->input('group_id');
            $tb->item_name = $request->input('item_name');
            $tb->item_code = $request->input('item_code');
            $tb->item_liters_type = $request->input('item_liters_type_id');
            $tb->item_properties_type = $request->input('item_properties_type_id');
            $tb->tax_id = $request->input('tax_id');
            $tb->distributor_rate = $request->input('distributor_rate');
            $tb->sub_dealer_rate = $request->input('sub_dealer_rate');
            $tb->description = $request->input('description');
            $tb->hsn_code = $request->input('hsn_code');
            $tb->piece = $request->input('piece');
            $tb->short_code = $request->input('short_code');
            $tb->save();

        }
        else if($action=='delete')
        {
            $tb = ItemCreation::find($request->input('id'));
            $tb->delete_status = "1";
            $tb->save();
        }
        else if($action=='getGroups')
        {


            $category_id = $request->input('category_id');

            $groups = GroupCreation::select('group_name','id')
                ->where('category_id', $category_id)->where('group_name','!=',null)->get();
            return response()->json($groups);
        }
        else if($action=='getHsnCode')
        {
            $category_id = $request->input('category_id');
            $group_name = $request->input('group_name');

            $hsn = GroupCreation::select('hsn_code')
                ->where('category_id', $category_id)->where('group_name', $group_name)
                ->get()->first();
            return response()->json($hsn);
        }
        else if($action=='retrieve')
        {
            $item_creation = $this->retrieve('');
            return view('Masters.item_creation.list',['item_creation'=>$item_creation,'user_rights_edit_1'=>$request->input('user_rights_edit_1'),'user_rights_delete_1'=>$request->input('user_rights_delete_1')]);
        }
        else if($action=='create_form')
        {
            $category_creation=CategoryCreation::select('id','category_name')->where('category_name','!=','')->where('delete_status','=','0')->orderBy('category_name')->get();

            $group_creation=GroupCreation::select('id','group_name')->where('group_name','!=','')->where('delete_status','=','0')->orderBy('group_name')->get();

            $tax_creation=TaxCreation::select('id','tax_name')->where('tax_name','!=','')->where('delete_status','!=','1')->orderBy('tax_name')->get();

            $item_liters_type=ItemLitersType::select('id','item_liters_type')->where('item_liters_type','!=','')->orderBy('item_liters_type')->get();

            $item_properties_type=ItemPropertiesType::select('id','item_properties_type')->where('item_properties_type','!=','')->orderBy('item_properties_type')->get();

            return view('Masters.item_creation.create',['category_creation'=>$category_creation,'group_creation'=>$group_creation,
            'tax_creation'=>$tax_creation,
            'item_liters_type'=>$item_liters_type,
            'item_properties_type'=>$item_properties_type
            ]);
        }
        else if($action=='update_form')
        {
            $category_id = $request->input('category_id');
            $category_creation=CategoryCreation::select('id','category_name')->where('category_name','!=','')->where('delete_status','=','0')->orderBy('category_name')->get();

            $group_creation=GroupCreation::select('id','group_name')->where('group_name','!=',null)->orderBy('group_name')->get();

            $tax_creation=TaxCreation::select('id','tax_name')->where('tax_name','!=','')->where('delete_status','!=','1')->orderBy('tax_name')->get();

            $item_liters_type=ItemLitersType::select('id','item_liters_type')->where('item_liters_type','!=','')->orderBy('item_liters_type')->get();

            $item_properties_type=ItemPropertiesType::select('id','item_properties_type')->where('item_properties_type','!=','')->orderBy('item_properties_type')->get();

            $item_creation=$this->retrieve($request->input('id'));

            return view('Masters.item_creation.update',['category_creation'=>$category_creation,'group_creation'=>$group_creation,'tax_creation'=>$tax_creation,'item_liters_type'=>$item_liters_type,'item_properties_type'=>$item_properties_type,'item_creation'=>$item_creation[0]]);
        }
        else if($action=='statusinfo')
        {
            $stat = $request->input('status')==1 ? "0" : "1";

            $tb = ItemCreation::find($request->input('id'));
            $tb->status = $stat;
            $tb->save();

        }
    }
}
