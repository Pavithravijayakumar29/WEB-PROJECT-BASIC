<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SalesRepCreation;
use App\Models\StateCreation;
use App\Models\MarketCreation;
use App\Models\DistrictCreation;
use App\Models\DealerCreation;
use App\Models\ShopsType;
use App\Models\ShopCreation;
use App\Models\MarketManagerCreation;
use App\Models\BeatsListShow;
use Carbon\Carbon;
use App\Imports\DealerCreationImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;

class DealerCreationController extends Controller
{
    public function retrieve($id)
    {
        $MarketController_td = (new MarketCreation)->getTable();
        $DealerController_td = (new DealerCreation)->getTable();
        if($id=='')
        {$dealers = DealerCreation::where(function ($query) use ($DealerController_td) {
            $query->where($DealerController_td.'.delete_status', '0')->orWhereNull($DealerController_td.'.delete_status');
        })
        ->orderBy($DealerController_td.'.id')
        ->get([
            $DealerController_td.'.id',
            $DealerController_td.'.dealer_name',
            $DealerController_td.'.place',
            $DealerController_td.'.whatsapp_no',
            $DealerController_td.'.image_name',
            $DealerController_td.'.status',
        ]);

    return $dealers;

        }
        else
        {return DealerCreation::select('id','sales_rep_id','dealer_name','mobile_no','whatsapp_no','address','place','pan_no','gst_no','aadhar_no','driving_licence','bank_name','check_no','state_id','district_id','area_id','image_name','manager_name')->orderBy('id')->where('id','=',$id)->get();}
    }
    public function shop_retrieve($id)
    {
        if($id=='')
        {return ShopCreation::select('id','shop_name','whatsapp_no','gst_no','language')->orderBy('id')->get();}
        else
        {return ShopCreation::select('id','shop_name','shop_type_id','beats_id','dealer_id','mobile_no','whatsapp_no','address','gst_no','image_name','language')->orderBy('id')->where('id','=',$id)->get();}
    }
    public function shop_sublist_retrieve($beats_id,$dealer_id)
    {
        if($beats_id==''&& $dealer_id=='')
        {return ShopCreation::select('id','shop_name','whatsapp_no','gst_no','language')->orderBy('id')->get();}
        else
        {return ShopCreation::select('id','shop_type_id','shop_name','beats_id','dealer_id','whatsapp_no','gst_no','language')->orderBy('id')->where('beats_id','=',$beats_id)->where('dealer_id','=',$dealer_id)->get();}
    }
    public function shop_view_retrieve($dealer_id)
    {
        if($dealer_id=='')
        {return ShopCreation::select('id','shop_name','whatsapp_no','gst_no')->orderBy('id')->get();}
        else
        {return ShopCreation::select('id','shop_type_id','shop_name','beats_id','dealer_id','whatsapp_no','gst_no')->orderBy('id')->where('dealer_id','=',$dealer_id)->get();}
    }
    public function db_cmd(Request $request)
    {
        $action = $request->input('action');
        if ($action == 'insert') {
            $crnt_date= date('Y-m-d');
            $tb = new DealerCreation();
            $StateCreation_tb = (new StateCreation)->getTable();
            $DistrictCreation_tb = (new DistrictCreation)->getTable();
            $MarketController_td = (new MarketCreation)->getTable();
            $tb->entry_date = $crnt_date;
            $tb->sales_rep_id = $request->input('sales_rep_id');
            $tb->dealer_name = $request->input('dealer_name');
            $tb->mobile_no = $request->input('mobile_no');
            $tb->whatsapp_no = $request->input('whatsapp_no');
            $tb->address = $request->input('address');
            $tb->place = $request->input('place');
            $tb->pan_no = $request->input('pan_no');
            $tb->gst_no = $request->input('gst_no');
            $tb->aadhar_no = $request->input('aadhar_no');
            $tb->driving_licence = $request->input('driving_licence');
            $tb->bank_name = $request->input('bank_name');
            $tb->check_no = $request->input('check_no');
            $tb->state_id = $request->input('state_id');
            $tb->district_id = $request->input('district_id');
            $tb->area_id = $request->input('area_id');
            $tb->manager_name = $request->input('manager_id');
            $tb->status='1';
            if ($request->hasFile('image_name')) {
                $image = $request->file('image_name');
                $imgName = $image->getClientOriginalName();
                $image->storeAs('public/dealer_img', $imgName);

                $tb->image_name = $imgName;
            }
            $tb->save();
        }
        else if($action=='update')
        {
            $tb = DealerCreation::find($request->input('id'));
            if ($tb) {
                $tb->sales_rep_id = $request->input('sales_rep_id');
                $tb->dealer_name = $request->input('dealer_name');
                $tb->mobile_no = $request->input('mobile_no');
                $tb->whatsapp_no = $request->input('whatsapp_no');
                $tb->address = $request->input('address');
                $tb->place = $request->input('place');
                $tb->pan_no = $request->input('pan_no');
                $tb->gst_no = $request->input('gst_no');
                $tb->aadhar_no = $request->input('aadhar_no');
                $tb->driving_licence = $request->input('driving_licence');
                $tb->bank_name = $request->input('bank_name');
                $tb->check_no = $request->input('check_no');
                $tb->state_id = $request->input('state_id');
                $tb->district_id = $request->input('district_id');
                $tb->area_id = $request->input('area_id');
                $tb->manager_name = $request->input('manager_id');
                if ($request->hasFile('image_name')) {
                    $image = $request->file('image_name');
                    $imgName = $image->getClientOriginalName();
                    $image->storeAs('public/dealer_img', $imgName);

                    $tb->image_name = $imgName;
                }
            $tb->save();
            }
        }
        else if($action=='delete')
        {
            $tb = DealerCreation::find($request->input('id'));
            $tb->delete_status = "1";
            $tb->save();
        }
        else if ($action == 'shop_insert') {
            $crnt_date= date('Y-m-d');
            $tb = new ShopCreation();
            $tb->entry_date = $crnt_date;
            $tb->shop_type_id = $request->input('shop_type_id');
            $tb->shop_name = $request->input('shop_name');
            $tb->beats_id = $request->input('beats_id');
            $tb->dealer_id = $request->input('dealer_id');
            $tb->mobile_no = $request->input('mobile_no');
            $tb->whatsapp_no = $request->input('whatsapp_no');
            $tb->address = $request->input('address');
            $tb->gst_no = $request->input('gst_no');
            $tb->language = $request->input('language');

            if ($request->hasFile('image_name')) {
                $image = $request->file('image_name');
                $imgName = $image->getClientOriginalName();
                $image->storeAs('public/shop_img', $imgName);

                $tb->image_name = $imgName;
            }
            $tb->save();
        }
        else if($action=='shop_update')
        {
            $tb = ShopCreation::find($request->input('id'));
            if ($tb) {
                $tb->shop_type_id = $request->input('shop_type_id');
                $tb->shop_name = $request->input('shop_name');
                $tb->mobile_no = $request->input('mobile_no');
                $tb->whatsapp_no = $request->input('whatsapp_no');
                $tb->address = $request->input('address');
                $tb->gst_no = $request->input('gst_no');
                $tb->language = $request->input('language');

                if ($request->hasFile('image_name')) {
                    $image = $request->file('image_name');
                    $imgName = $image->getClientOriginalName();
                    $image->storeAs('public/shop_img', $imgName);

                    $tb->image_name = $imgName;
                }
            $tb->save();
            }
        }
        else if($action=='shop_delete')
        {
            $tb = ShopCreation::find($request->input('id'));
            $tb->delete();
        }
        else if($action=='shop_sublist')
        {
            $beats_id = $request->input('beats_id');
            $dealer_id = $request->input('dealer_id');
            $shop_creation = $this->shop_sublist_retrieve($beats_id,$dealer_id);
            return view('Masters.dealer_creation.sublist',[
                'shop_creation'=>$shop_creation
            ]);
        }
        else if ($action == 'shops_form')
        {
            $beats_id = $request->input('beats_id');
            $dealer_id = $request->input('dealer_id');
            $shops_type = ShopsType::select('id', 'shops_type')
            ->where('shops_type', '!=', '')
            ->where('status1', '=', '1')
            ->orderBy('shops_type')
            ->get();
            return view('Masters.dealer_creation.shops',[
                'beats_id'=> $beats_id,
                'dealer_id'=> $dealer_id,
                'shops_type'=> $shops_type,
            ]);
        }
        else if ($action == 'shop_update_form')
        {
            $shops_type = ShopsType::select('id', 'shops_type')
            ->where('shops_type', '!=', '')
            ->where('status1', '=', '1')
            ->orderBy('shops_type')
            ->get();

            $shop_creation=$this->shop_retrieve($request->input('id'));
            return view('Masters.dealer_creation.shops_update',[
                'shops_type'=> $shops_type,
                'shop_creation'=> $shop_creation[0]
            ]);
        }
        else if ($action == 'view_form') {
            $dealer_id = $request->input('id');

            $DealerController_td = (new DealerCreation)->getTable();
            $MarketController_td = (new MarketCreation)->getTable();
            $ShopController_td = (new ShopCreation)->getTable();

            $shop_creation = ShopCreation::join($DealerController_td, $ShopController_td.'.dealer_id', '=', $DealerController_td.'.id')
                ->join($MarketController_td, $ShopController_td.'.beats_id', '=', $MarketController_td.'.id')
                ->where($ShopController_td.'.dealer_id', '=', $dealer_id)
                ->get([
                    $ShopController_td.'.id',
                    $DealerController_td.'.dealer_name',
                    $MarketController_td.'.area_name',
                    $ShopController_td.'.shop_name',
                    $ShopController_td.'.whatsapp_no',
                    $ShopController_td.'.gst_no'
                ]);


            return view('Masters.dealer_creation.view', [
                'shop_creation'=>$shop_creation,
            ]);
        }
        else if ($action == 'beats_form') {
            $dealer_id = $request->input('id');

            $dealer_creation = DealerCreation::find($dealer_id);
            $market_id = $dealer_creation->area_id;
            $market_ids = explode(",", $market_id);
            $area_names = [];
            $marketId_s = [];
            $cnt_values = [];
            $language_values = [];

            foreach ($market_ids as $marketId) {
                $area_name = MarketCreation::find($marketId);
                if ($area_name) {
                    $area_names[] = $area_name;
                    $marketId_s[] = $marketId;

                    $digits = str_split($marketId);

                    foreach ($digits as $digit) {
                        $cnt = ShopCreation::where('beats_id', '=', $digit)
                            ->where('dealer_id', '=', $dealer_id)
                            ->where(function ($query) {
                                $query->where('delete_status', '0')->orWhereNull('delete_status');
                            })
                            ->count();

                        $language = ShopCreation::where('beats_id', '=', $digit)
                            ->where('dealer_id', '=', $dealer_id)
                            ->where(function ($query) {
                                $query->where('delete_status', '0')->orWhereNull('delete_status');
                            })
                            ->value('language');

                        $cnt_values[] = $cnt;
                        $language_values[] = $language;
                    }
                }
            }

            $district_name = DistrictCreation::select('id', 'district_name')
                ->where('district_name', '!=', '')
                ->orderBy('district_name')
                ->get();

            return view('Masters.dealer_creation.beats', [
                'dealer_id' => $dealer_id,
                'area_names' => $area_names,
                'market_ids' => $marketId_s,
                'cnt_values' => $cnt_values,
                'language_values' => $language_values,
            ]);
        }



        else if($action=='retrieve')
        {
            $dealer_creation = $this->retrieve('');
        // return $dealer_creation;
            return view('Masters.dealer_creation.list',['dealer_creation'=>$dealer_creation,'user_rights_edit_1'=>$request->input('user_rights_edit_1'),'user_rights_delete_1'=>$request->input('user_rights_delete_1')]);
        }
        else if($action=='count')
        {
            $cnt=0;
            $id=$request->input('id');$dealer_creation=$request->input('dealer_creation');
            if($id!="0"){$cnt=DealerCreation::where('dealer_creation','=',$dealer_creation)->where('id','!=',$id)->count();}
            else{$cnt=DealerCreation::where('dealer_creation','=',$dealer_creation)->count();}
            return $cnt;
        }
        else if($action=='create_form')
        {
            $sales_rep_name = SalesRepCreation::select('id', 'sales_ref_name')
            ->where(function ($query) {
                $query->where('delete_status', '0')->orWhereNull('delete_status');
            })
            ->where('status', 0)
            ->orderBy('sales_ref_name')
            ->get();


            $manager = MarketManagerCreation::select('id', 'manager_name')
                ->where(function ($query) {
                    $query->where('delete_status', '0')->orWhereNull('delete_status');
                 })
                ->orderBy('manager_name')
                ->get();

            $state_name = StateCreation::select('id', 'state_name')
                ->where('state_name', '!=', '')
                ->orderBy('state_name')
                ->get();

            $district_name = DistrictCreation::select('id', 'district_name')
                ->where('district_name', '!=', '')
                ->orderBy('district_name')
                ->get();

            $area_name = MarketCreation::select('id', 'area_name')
                ->where('area_name', '!=', '')
                ->orderBy('area_name')
                ->get();

            return view('Masters.dealer_creation.create',[
                'sales_rep_name' => $sales_rep_name,
                'state_name' => $state_name,
                'district_name' => $district_name,
                'area_name' => $area_name,
                'manager' => $manager
            ]);
        }
        else if($action=='update_form')
        {


            $sales_rep_name = SalesRepCreation::select('id', 'sales_ref_name')
            ->where(function ($query) {
                $query->where('delete_status', '0')->orWhereNull('delete_status');
             })
             ->where('status', 0)
            ->orderBy('sales_ref_name')
            ->get();

                $manager = MarketManagerCreation::select('id', 'manager_name')
                ->where(function ($query) {
                    $query->where('delete_status', '0')->orWhereNull('delete_status');
                 })
                ->orderBy('manager_name')
                ->get();

            $dealer_ids = $request->input('id');

                $dealer_query = DealerCreation::select('id','state_id','district_id')
                ->where('id', $dealer_ids)
                ->first();


            $state_name = StateCreation::select('id', 'state_name')
                ->where('state_name', '!=', '')
                ->orderBy('state_name')
                ->get();

                $dealer_drop_id = 0;

                if ($dealer_query) {
                    $dealer_drop_id = $dealer_query->state_id;
                }

                $district_name = DistrictCreation::select('id', 'district_name')
                ->where('state_id', '=', $dealer_drop_id)
                ->orderBy('id')
                ->get();

                $area_name = MarketCreation::select('id', 'area_name')
                ->where('district_id', '=', $dealer_query->district_id)
                ->orderBy('id')
                ->get();


            $dealer_creation=$this->retrieve($request->input('id'));
            return view('Masters.dealer_creation.update',[
                'sales_rep_name' => $sales_rep_name,
                'state_name' => $state_name,
                'district_name' => $district_name,
                'manager' => $manager,
                'area_name' => $area_name,'dealer_query'=>$dealer_query,
                'dealer_creation'=> $dealer_creation[0]
            ]);
        }
        if ($action == 'getDistricts') {
            $stateIds = $request->input('state_id');

            $districts = DistrictCreation::select('id', 'district_name')
                ->whereIn('state_id', $stateIds)
                ->get();

            return response()->json($districts);
        }
        else if($action=='getArea')
        {
            $districtId = $request->input('district_id');

            $area = MarketCreation::select('id', 'area_name')
                ->whereIn('district_id', $districtId)
                ->get();

            return response()->json($area);
        }
        else if($action=='statusinfo')
        {
            $stat = $request->input('status')==1 ? "0" : "1";

            $tb = DealerCreation::find($request->input('id'));
            $tb->status = $stat;
            $tb->save();

        }

    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xls,xlsx',
        ]);

        if ($request->file('file')->getSize() == 0) {
            Session::flash('error', 'The uploaded file is empty.');
            // return back();
            return redirect("Dealer_Creation")->with('error', 'The uploaded file is empty.');
        }

        try {
            Excel::import(new DealerCreationImport, $request->file('file'));
            Session::flash('success', 'Data imported successfully.');
            return back();
        } catch (\Exception $e) {
            return redirect("Dealer_Creation")->with('error', 'An error occurred during import: ' . $e->getMessage());
        }


    }



}
