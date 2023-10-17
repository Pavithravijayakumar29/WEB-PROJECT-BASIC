<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CountryCreation;
class CountryCreationController extends Controller
{
    public function retrieve($id)
    {
        if($id=='')
        {return CountryCreation::select('id','country_name','status','description')->orderBy('country_name')->get();}
        else
        {return CountryCreation::select('id','country_name','description')->orderBy('country_name')->where('id','=',$id)->get();}
    }

    public function db_cmd(Request $request)
    {
        $action=$request->input('action');

        if ($action == 'insert') {
            $country_name = $request->input('country_name');
            $description = $request->input('description');
            $count = CountryCreation::where('country_name', $country_name)->count();

            if ($count > 0) {
                return response()->json(['error' => 'Country name already exists.']);
            }

            $tb = new CountryCreation();
            $tb->country_name = $country_name;
            $tb->status='1';
            $tb->description = $description;
            $tb->save();

            return response()->json(['message' => 'Record inserted successfully']);
        }
        else if ($action == 'update')
        {
            $country_name = $request->input('country_name');
            $description = $request->input('description');
            $id = $request->input('id');
            $count = CountryCreation::where('country_name', $country_name)
                ->where('id', '!=', $id)
                ->count();

            if ($count > 0) {
                return response()->json(['error' => 'Country name already exists.']);
            }

            $tb = CountryCreation::find($id);
            $tb->country_name = $country_name;
            $tb->description = $description;
            $tb->save();

            return response()->json(['message' => 'Record updated successfully']);
        }

        else if($action=='delete')
        {
            $tb = CountryCreation::where('id','=',$request->input('id'));
            $tb->delete();
        }
        else if($action=='retrieve')
        {
            $country_creation = $this->retrieve('');
            return view('Masters.country_creation.list',['country_creation'=>$country_creation,'user_rights_edit_1'=>$request->input('user_rights_edit_1'),'user_rights_delete_1'=>$request->input('user_rights_delete_1')]);
        }
        else if($action=='count')
        {
            $cnt=0;
            $id=$request->input('id');$country_name=$request->input('country_name');
            if($id!="0"){$cnt=CountryCreation::where('country_name','=',$country_name)->where('id','!=',$id)->count();}
            else{$cnt=CountryCreation::where('country_name','=',$country_name)->count();}
            return $cnt;
        }
        else if($action=='create_form')
        {
            return view('Masters.Country_creation.create');
        }
        else if($action=='update_form')
        {
            $country_creation=$this->retrieve($request->input('id'));
            return view('Masters.Country_creation.update',['country_creation'=>$country_creation[0]]);
        }
        else if($action=='statusinfo')
        {
            $stat = $request->input('status')==1 ? "0" : "1";

            $tb = CountryCreation::find($request->input('id'));
            $tb->status = $stat;
            $tb->save();

        }
    }
}

