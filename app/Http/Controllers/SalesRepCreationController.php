<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StateCreation;
use App\Models\DistrictCreation;
use App\Models\MarketCreation;
use App\Models\SalesRepCreation;
use App\Models\MarketManagerCreation;
class SalesRepCreationController extends Controller
{

public function retrieve($id)
    {

        $MarketController_tb = (new MarketCreation)->getTable();
        $SalesRepCreation_tb = (new SalesRepCreation)->getTable();
        $MarketManagerCreation_tb = (new MarketManagerCreation)->getTable();
        if($id=='')
        {
            return  SalesRepCreation::join($MarketManagerCreation_tb, $MarketManagerCreation_tb . '.id', '=', $SalesRepCreation_tb . '.manager_id')
            ->select([
                $SalesRepCreation_tb . '.id',
                $SalesRepCreation_tb . '.manager_id',
                $MarketManagerCreation_tb . '.manager_name',

                $SalesRepCreation_tb . '.manager_id',
                $SalesRepCreation_tb . '.sales_ref_name',
                $SalesRepCreation_tb . '.mobile_no',
                $SalesRepCreation_tb . '.pin_gst_no',
                $SalesRepCreation_tb . '.phone_no',
                $SalesRepCreation_tb . '.address',
                $SalesRepCreation_tb . '.status',
                $SalesRepCreation_tb . '.state_id',
                $SalesRepCreation_tb . '.district_id',
                $SalesRepCreation_tb . '.image_name',
            ])
            ->where(function ($query) use ($SalesRepCreation_tb) {
                $query->where($SalesRepCreation_tb . '.delete_status', '0')
                    ->orWhereNull($SalesRepCreation_tb . '.delete_status');
            })
            ->get();}
        else
        {return $result = SalesRepCreation::where($SalesRepCreation_tb . '.id', '=', $id)
            ->select([
                $SalesRepCreation_tb . '.id',


                $SalesRepCreation_tb . '.manager_id',
                $SalesRepCreation_tb . '.sales_ref_name',
                $SalesRepCreation_tb . '.mobile_no',
                $SalesRepCreation_tb . '.pin_gst_no',
                $SalesRepCreation_tb . '.aadhar_no',
                $SalesRepCreation_tb . '.driving_licence',
                $SalesRepCreation_tb . '.phone_no',
                $SalesRepCreation_tb . '.address',
                $SalesRepCreation_tb . '.state_id',
                $SalesRepCreation_tb . '.status',
                $SalesRepCreation_tb . '.district_id',
                $SalesRepCreation_tb . '.image_name',
            ])
            ->where(function ($query) use ($SalesRepCreation_tb) {
                $query->where($SalesRepCreation_tb . '.delete_status', '0')
                    ->orWhereNull($SalesRepCreation_tb . '.delete_status');
            })
            ->get();}

    }


    public function db_cmd(Request $request)
    {
        $action = $request->input('action');
        if ($action == 'insert') {
            $tb = new SalesRepCreation();
            $tb->manager_id = $request->input('manager_id');
            $tb->sales_ref_name = $request->input('sales_ref_name');
            $tb->mobile_no = $request->input('mobile_no');
            $tb->pin_gst_no = $request->input('pin_gst_no');
            $tb->phone_no = $request->input('phone_no');
            $tb->address = $request->input('address');
            $tb->aadhar_no = $request->input('aadhar_no');
            $tb->driving_licence = $request->input('driving_licence');
            $tb->state_id = $request->input('state_id');
            $tb->district_id = $request->input('district_id1');
            $tb->status = '1';
            if ($request->hasFile('image_name')) {
                $image = $request->file('image_name');
                $imgName = $image->getClientOriginalName();

                $image->storeAs('public/barang', $imgName);

                $tb->image_name = $imgName;
            } else {

                $tb->image_name = "default_image.png";
            }
            $tb->save();
        }

        else if ($action == 'update') {
            $tb = SalesRepCreation::find($request->input('id'));
            $tb->manager_id = $request->input('manager_id');
            $tb->sales_ref_name = $request->input('sales_ref_name');
            $tb->mobile_no = $request->input('mobile_no');
            $tb->pin_gst_no = $request->input('pin_gst_no');
            $tb->phone_no = $request->input('phone_no');
            $tb->address = $request->input('address');
            $tb->aadhar_no = $request->input('aadhar_no');
            $tb->driving_licence = $request->input('driving_licence');
            $tb->state_id = $request->input('state_id');
            $tb->district_id = $request->input('district_id1');

            if ($request->hasFile('image_name')) {
                $image = $request->file('image_name');
                $imgName = $image->getClientOriginalName();
                $image->storeAs('public/barang', $imgName);

                $tb->image_name = $imgName;
            }
            $tb->save();
        }

        else if($action=='delete')
        {
            $tb = SalesRepCreation::find($request->input('id'));
            $tb->delete_status = "1";
            $tb->save();
        }
        else if($action=='retrieve')
        {
            $sales_rep_creation = $this->retrieve('');
            return view('Masters.sales_rep_creation.list',['sales_rep_creation'=>$sales_rep_creation,'user_rights_edit_1'=>$request->input('user_rights_edit_1'),'user_rights_delete_1'=>$request->input('user_rights_delete_1')]);
        }
        else if($action=='count')
        {
            $cnt=0;
            $id=$request->input('id');$country_name=$request->input('country_name');
            if($id!="0"){$cnt=SalesRepCreation::where('country_id','=',$country_name)->where('id','!=',$id)->count();}
            else{$cnt=SalesRepCreation::where('country_id','=',$country_name)->count();}
            return $cnt;
        }

        else if($action=='create_form')
        {
            $state_name = StateCreation::select('id', 'state_name')
                ->where('state_name', '!=', '')
                ->orderBy('state_name')
                ->get();

            $district_creation = DistrictCreation::select('state_creation.state_name', 'district_creation.district_name')
                ->join('state_creation', 'state_creation.id', '!=', 'district_creation.state_id')
                ->groupBy('state_creation.state_name', 'district_creation.district_name')
                ->orderBy('state_creation.state_name')
                ->get();

                $market_manager_creations = MarketManagerCreation::select('id', 'manager_name')
                ->where(function ($query) {
                    $query->where('delete_status', '0')
                        ->orWhereNull('delete_status')
                        ->where('status1', '0');
                })
                ->orderBy('manager_name')
                ->get();


                return view('Masters.sales_rep_creation.create',[
                'state_name' => $state_name,
                'district_creation' => $district_creation,

                'market_manager_creations' => $market_manager_creations
            ]);
        }

        else if($action=='update_form')
        {
            $stateId = $request->input('state_id');
            $districtId = $request->input('district_id');

            $state_name = StateCreation::select('id', 'state_name')
                ->orderBy('state_name')
                ->get();

            $district_creation = DistrictCreation::select('district_creation.id', 'district_creation.district_name')->where('district_creation.delete_status', '0')->orWhereNull('district_creation.delete_status')
                ->join('state_creation', 'state_creation.id', '=', 'district_creation.state_id')
                ->orderBy('district_creation.district_name')
                ->get();

            $sales_rep_creation=$this->retrieve($request->input('id'));

            $market_manager_creations=MarketManagerCreation::select('id','manager_name')->where(function($query){$query->where('delete_status', '0')->orWhereNull('delete_status')->where('status1', '0');})->orderBy('manager_name')->get();


            return view('Masters.sales_rep_creation.update',[
                'state_name' => $state_name,
                'district_creation' => $district_creation,
                'sales_rep_creation'=>$sales_rep_creation[0],
                'market_manager_creations'=>$market_manager_creations
            ]);

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

            $tb = SalesRepCreation::find($request->input('id'));
            $tb->status = $stat;
            $tb->save();

        }

    }
}

