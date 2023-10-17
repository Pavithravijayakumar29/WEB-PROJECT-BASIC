<?php


namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StateCreation;
use App\Models\MarketCreation;
use App\Models\DistrictCreation;
class MarketController extends Controller
{
    public function retrieve($id)
    {

        $StateCreation_tb = (new StateCreation)->getTable();
        $DistrictCreation_tb = (new DistrictCreation)->getTable();
        $MarketController_td = (new MarketCreation)->getTable();

        if($id=='')
        {return MarketCreation::join($StateCreation_tb, $StateCreation_tb.'.id', '=', $MarketController_td.'.state_id')->where($MarketController_td.'.delete_status', '0')->orWhereNull($MarketController_td.'.delete_status')->join($DistrictCreation_tb, $MarketController_td.'.district_id', '=', $DistrictCreation_tb.'.id')->orderBy($MarketController_td.'.area_name')->get([$MarketController_td.'.id',$MarketController_td.'.state_id',$StateCreation_tb.'.state_name',$MarketController_td.'.district_id',$DistrictCreation_tb.'.district_name',$MarketController_td.'.area_name',$MarketController_td.'.description',$MarketController_td.'.status']);}
        else
        {return MarketCreation::join($StateCreation_tb, $StateCreation_tb.'.id', '=', $MarketController_td.'.state_id')->join($DistrictCreation_tb, $MarketController_td.'.district_id', '=', $DistrictCreation_tb.'.id')->orderBy($MarketController_td.'.area_name')->where($MarketController_td.'.id','=',$id)->get([$MarketController_td.'.id',$MarketController_td.'.state_id',$StateCreation_tb.'.state_name',$MarketController_td.'.district_id',$DistrictCreation_tb.'.district_name',$MarketController_td.'.area_name',$MarketController_td.'.description'])->first();}

    }
    public function db_cmd(Request $request)
    {
        $action=$request->input('action');
        if($action=='insert')
        {
            $tb = new MarketCreation();
            $tb->state_id = $request->input('state_id');
            $tb->district_id = $request->input('district_id');
            $tb->area_name	 = $request->input('area_name');
            $tb->status='1';
            $tb->description = $request->input('description');
            $tb->save();
        }
        else if($action=='update')
        {
            $tb = MarketCreation::find($request->input('id'));
            $tb->state_id = $request->input('state_id');
            $tb->district_id = $request->input('district_id');
            $tb->area_name	 = $request->input('area_name');
            $tb->description = $request->input('description');
            $tb->save();
        }
        else if($action=='delete')
        {
            $tb = MarketCreation::where('id','=',$request->input('id'));
            $tb->delete();
        }
        else if($action=='retrieve')
        {
            $market_creation = $this->retrieve('');
            return view('Masters.market_creation.list',['market_creation'=>$market_creation,'user_rights_edit_1'=>$request->input('user_rights_edit_1'),'user_rights_delete_1'=>$request->input('user_rights_delete_1')]);
        }
        else if($action=='count')
        {
            $cnt=0;
            $id=$request->input('id');$state_name=$request->input('state_name');
            if($id!="0"){$cnt=MarketCreation::where('state_name','=',$state_name)->where('id','!=',$id)->count();}
            else{$cnt=MarketCreation::where('state_name','=',$state_name)->count();}
            return $cnt;
        }
        else if ($action == 'create_form') {
            $state_name = StateCreation::select('id', 'state_name')
                ->where('state_name', '!=', '')
                ->orderBy('state_name')
                ->get();

            $district_creation = DistrictCreation::select('state_creation.state_name', 'district_creation.district_name')
                ->join('state_creation', 'state_creation.id', '!=', 'district_creation.state_id')
                ->groupBy('state_creation.state_name', 'district_creation.district_name')
                ->orderBy('state_creation.state_name')
                ->get();

            return view('Masters.market_creation.create', [
                'state_name' => $state_name,
                'district_creation' => $district_creation
            ]);
        }

        else if($action=='update_form')
        {

            $id_state = $request->input('id');

            $state_name = StateCreation::select('id', 'state_name')
            ->orderBy('state_name')
            ->get();

            $area_creation=MarketCreation::select('id','state_id')->where('id','=',$id_state)->orderBy('id')->get()->first();

            if($area_creation){
                $area_drop_id = $area_creation->state_id;
            }else{
                $area_drop_id = 0;
            }

            $district_creation=DistrictCreation::select('id','district_name')->where('state_id','=',$area_drop_id)->orderBy('district_name')->get();

            $market_creation=$this->retrieve($request->input('id'));

            return view('Masters.market_creation.update',['state_name'=>$state_name,'area_creation'=>$area_creation,'district_creation'=>$district_creation,'market_creation'=>$market_creation]);
        }

        else if($action=='getDistricts')
        {
            $stateId = $request->input('state_id');

            $districts = DistrictCreation::select('id', 'district_name')
                ->where('state_id', $stateId)
                ->get();

            return response()->json($districts);
        }
        else if($action=='statusinfo')
        {
            $stat = $request->input('status')==1 ? "0" : "1";
            $tb = MarketCreation::find($request->input('id'));
            $tb->status = $stat;
            $tb->save();
        }
    }
}

