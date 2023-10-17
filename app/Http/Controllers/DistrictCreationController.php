<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CountryCreation;
use App\Models\StateCreation;
use App\Models\DistrictCreation;

class DistrictCreationController extends Controller
{
    public function retrieve($id)
    {

        $CountryCreation_tb = (new CountryCreation)->getTable();
        $StateCreation_tb = (new StateCreation)->getTable();
        $DistrictCreation_tb = (new DistrictCreation)->getTable();

        if($id=='')

        {return DistrictCreation::join($CountryCreation_tb, $CountryCreation_tb.'.id', '=', $DistrictCreation_tb.'.country_id')->join($StateCreation_tb, $DistrictCreation_tb.'.state_id', '=', $StateCreation_tb.'.id')->where(function($query) use ($DistrictCreation_tb){$query->where($DistrictCreation_tb.'.delete_status', '0')->orWhereNull($DistrictCreation_tb.'.delete_status');})->orderBy($DistrictCreation_tb.'.district_name')->get([$DistrictCreation_tb.'.id',$DistrictCreation_tb.'.country_id',$CountryCreation_tb.'.country_name',$DistrictCreation_tb.'.state_id',$StateCreation_tb.'.state_name',$DistrictCreation_tb.'.district_name',$DistrictCreation_tb.'.description',$DistrictCreation_tb.'.status']);}
        else
        {return DistrictCreation::join($CountryCreation_tb, $CountryCreation_tb.'.id', '=', $DistrictCreation_tb.'.country_id')->join($StateCreation_tb, $DistrictCreation_tb.'.state_id', '=', $StateCreation_tb.'.id')->orderBy($DistrictCreation_tb.'.district_name')->where($DistrictCreation_tb.'.id','=',$id)->get([$DistrictCreation_tb.'.id',$DistrictCreation_tb.'.country_id',$CountryCreation_tb.'.country_name',$DistrictCreation_tb.'.state_id',$StateCreation_tb.'.state_name',$DistrictCreation_tb.'.district_name',$DistrictCreation_tb.'.description']);}
    }
    public function db_cmd(Request $request)
    {
        $action=$request->input('action');
        if($action=='insert')
        {
            $cnt=DistrictCreation::where('country_id','=',$request->input('country_id'))->where('state_id', $request->input('state_id'))->where('district_name', $request->input('district_name'))->where(function($query){$query->where('delete_status', '0')->orWhereNull('delete_status');})->count();
            if($cnt>0){return $cnt;}
            else{
            $tb = new DistrictCreation();
            $tb->country_id = $request->input('country_id');
            $tb->state_id = $request->input('state_id');
            $tb->district_name = $request->input('district_name');
            $tb->status='1';
            $tb->description = $request->input('description');
            $tb->save();
            }
        }
        else if ($action == 'update') {
            $tb = DistrictCreation::find($request->input('id'));
            if (!$tb) {
                return response()->json(['error' => 'Record not found.']);
            }

            $country_id = $request->input('country_id');
            $state_id = $request->input('state_id');
            $district_name = $request->input('district_name');
            $description = $request->input('description');

            if ($tb->country_id != $country_id || $tb->state_id != $state_id || $tb->district_name != $district_name || $tb->description != $description) {

                $cnt = DistrictCreation::where('country_id', $country_id)
                    ->where('state_id', $state_id)
                    ->where('district_name', $district_name)
                    ->where('id', '!=', $request->input('id'))
                    ->where(function ($query) {
                        $query->where('delete_status', '0')->orWhereNull('delete_status');
                    })->count();

                if ($cnt > 0) {
                    return response()->json(['error' => 'Duplicate district name found in the selected state.']);
                } else {
                    $tb->country_id = $country_id;
                    $tb->state_id = $state_id;
                    $tb->district_name = $district_name;
                    $tb->description = $description;
                    $tb->save();
                }
            } else {
                return response()->json(['message' => 'No changes made to the record.']);
            }
        }
        else if($action=='delete')
        {
            $tb = DistrictCreation::find($request->input('id'));
            $tb->delete_status = "1";
            $tb->save();
        }
        else if($action=='getStates')
        {
            $countryId = $request->input('country_id');
            $states = StateCreation::where('country_id', $countryId)->pluck('state_name', 'id');

            return response()->json($states);
        }
        else if($action=='retrieve')
        {
            $district_creation = $this->retrieve('');
            return view('Masters.district_creation.list',['district_creation'=>$district_creation,'user_rights_edit_1'=>$request->input('user_rights_edit_1'),'user_rights_delete_1'=>$request->input('user_rights_delete_1')]);
        }
        else if($action=='count')
        {
            $cnt=0;
            $id=$request->input('id');$state_name=$request->input('state_name');
            if($id!="0"){

                $cnt=DistrictCreation::where('state_id','=',$state_name)->where('id','!=',$id)->count();
            }
            else{
                $cnt=DistrictCreation::where('state_id','=',$state_name)->count();
            }
            return $cnt;
        }

        else if($action=='create_form')
        {
            $country_creation=CountryCreation::select('id','country_name')->where('country_name','!=','')->orderBy('country_name')->get();
            $state_creation=StateCreation::select('id','state_name')->where('state_name','!=','')->orderBy('state_name')->get();

            return view('Masters.district_creation.create',['country_creation'=>$country_creation],['state_creation'=>$state_creation]);
        }
        else if($action=='update_form')
        {
              $district_id = $request->input('id');

            $country_creation=CountryCreation::select('id','country_name')->orderBy('country_name')->get();

            $district_creation=DistrictCreation::select('id','country_id')->where('id','=',$district_id)->orderBy('id')->get()->first();

            if($district_creation){
                $state_drop_id = $district_creation->country_id;
            }else{
                $state_drop_id = 0;
            }
            $state_creation=StateCreation::select('id','state_name')->where('country_id','=',$state_drop_id)->orderBy('state_name')->get();

            $district_creation=$this->retrieve($request->input('id'));
            return view('Masters.district_creation.update',['country_creation'=>$country_creation,'state_creation'=>$state_creation,'district_creation'=>$district_creation[0]]);
        }
        else if($action=='statusinfo')
        {
            $stat = $request->input('status')==1 ? "0" : "1";

            $tb = DistrictCreation::find($request->input('id'));
            $tb->status = $stat;
            $tb->save();

        }
    }




}
