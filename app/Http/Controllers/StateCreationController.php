<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CountryCreation;
use App\Models\StateCreation;
class StateCreationController extends Controller
{
    public function retrieve($id)
    {
        $CountryCreation_tb = (new CountryCreation)->getTable();
        $StateCreation_tb = (new StateCreation)->getTable();
        if($id=='')
        {return StateCreation::join( $CountryCreation_tb, $CountryCreation_tb.'.id','=',$StateCreation_tb.'.country_id')->get([$StateCreation_tb.'.id',$StateCreation_tb.'.country_id',$CountryCreation_tb.'.country_name',$StateCreation_tb.'.state_name',$StateCreation_tb.'.status',$StateCreation_tb.'.description']);}
        else
        {return StateCreation::join( $CountryCreation_tb, $CountryCreation_tb.'.id','=',$StateCreation_tb.'.country_id')->where($StateCreation_tb.'.id','=',$id)->get([$StateCreation_tb.'.id',$StateCreation_tb.'.country_id',$CountryCreation_tb.'.country_name',$StateCreation_tb.'.state_name',$StateCreation_tb.'.description']);}
    }
    public function db_cmd(Request $request)
    {
        $action = $request->input('action');
        if ($action == 'insert') {
            $state_name = $request->input('state_name');
            $description = $request->input('description');
            $country_id = $request->input('country_id');
            $count = StateCreation::where('state_name', $state_name)
                                  ->where('country_id', $country_id)
                                  ->count();
            if ($count > 0) {
                return response()->json(['error' => 'State name already exists for the selected country.']);
            }
            $tb = new StateCreation();
            $tb->country_id = $country_id;
            $tb->state_name = $state_name;
            $tb->status='1';
            $tb->description = $description;
            $tb->save();
        }

        else if ($action == 'update') {
            $state_id = $request->input('id');
            $country_id = $request->input('country_id');
            $state_name = $request->input('state_name');
            $description = $request->input('description');
            $count = StateCreation::where('state_name', $state_name)
                                  ->where('country_id', $country_id)
                                  ->where('id', '!=', $state_id)
                                  ->count();
            if ($count > 0) {
                return response()->json(['error' => 'State name already exists for the selected country.']);
            }
            $tb = StateCreation::find($state_id);
            if (!$tb) {
                return response()->json(['error' => 'Record not found.']);
            }
            $tb->country_id = $country_id;
            $tb->state_name = $state_name;
            $tb->description = $description;
            $tb->save();
            return response()->json(['message' => 'Record updated successfully']);
        }
        else if($action=='delete')
        {
            $tb = StateCreation::where('id','=',$request->input('id'));
            $tb->delete();
        }
        else if($action=='retrieve')
        {
            $state_creation = $this->retrieve('');
            return view('Masters.state_creation.list',['state_creation'=>$state_creation,'user_rights_edit_1'=>$request->input('user_rights_edit_1'),'user_rights_delete_1'=>$request->input('user_rights_delete_1')]);
        }
        else if($action=='count')
        {
            $cnt=0;
            $id=$request->input('id');$country_name=$request->input('country_name');
            if($id!="0"){$cnt=StateCreation::where('country_id','=',$country_name)->where('id','!=',$id)->count();}
            else{$cnt=StateCreation::where('country_id','=',$country_name)->count();}
            return $cnt;
        }
        else if($action=='create_form')
        {
            $country_name=CountryCreation::select('id','country_name')->orderBy('country_name')->get();
            return view('Masters.state_creation.create',['country_name'=>$country_name]);
        }
        else if($action=='update_form')
        {
            $country_name=CountryCreation::select('id','country_name')->orderBy('country_name')->get();
            $state_creation=$this->retrieve($request->input('id'));
            return view('Masters.state_creation.update',['country_name'=>$country_name,'state_creation'=>$state_creation[0]]);

        }
        else if($action=='statusinfo')
        {
            $stat = $request->input('status')==1 ? "0" : "1";

            $tb = StateCreation::find($request->input('id'));
            $tb->status = $stat;
            $tb->save();

        }
    }
}

