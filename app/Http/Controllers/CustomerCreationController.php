<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StateCreation;
use App\Models\MarketCreation;
use App\Models\DistrictCreation;
use App\Models\CustomerCreation;

class CustomerCreationController extends Controller
{
    public function retrieve($id)
    {
        if($id=='')
        {return CustomerCreation::select('id','customer_no','customer_name','contact_no','pin_gst_no','status1')->orderBy('customer_name')->get();}
        else
        {return CustomerCreation::select('id','customer_no','customer_name','perm_address','pin_gst_no','contact_no','phone_no','email_address','state_id','district_id','area_id','status1')->orderBy('customer_name')->where('id','=',$id)->get();}
    }
    public function db_cmd(Request $request)
    {
        $action = $request->input('action');
        if ($action == 'insert') {
            $tb = new CustomerCreation();
            $tb->customer_no = $request->input('customer_no');
            $tb->customer_name = $request->input('customer_name');
            $tb->perm_address = $request->input('perm_address');
            $tb->pin_gst_no = $request->input('pin_gst_no');
            $tb->contact_no = $request->input('contact_no');
            $tb->phone_no = $request->input('phone_no');
            $tb->email_address = $request->input('email_address');
            $tb->state_id = $request->input('state_id');
            $tb->district_id = $request->input('district_id');
            $tb->area_id = $request->input('area_id');
            $tb->status1 = $request->input('status1');

            $tb->save();
        }

        else if($action=='update')
        {
            $tb = CustomerCreation::find($request->input('id'));
            $tb->customer_no = $request->input('customer_no');
            $tb->customer_name = $request->input('customer_name');
            $tb->perm_address = $request->input('perm_address');
            $tb->pin_gst_no = $request->input('pin_gst_no');
            $tb->contact_no = $request->input('contact_no');
            $tb->phone_no = $request->input('phone_no');
            $tb->email_address = $request->input('email_address');
            $tb->state_id = $request->input('state_id');
            $tb->district_id = $request->input('district_id');
            $tb->area_id = $request->input('area_id');
            $tb->status1 = $request->input('status1');
            $tb->save();
        }
        else if($action=='delete')
        {
            $tb = CustomerCreation::where('id','=',$request->input('id'));
            $tb->delete();
        }
        else if($action=='retrieve')
        {
            $customer_creation = $this->retrieve('');
            return view('Masters.customer_creation.list',['customer_creation'=>$customer_creation,'user_rights_edit_1'=>$request->input('user_rights_edit_1'),'user_rights_delete_1'=>$request->input('user_rights_delete_1')]);
        }
        else if($action=='count')
        {
            $cnt=0;
            $id=$request->input('id');$customer_creation=$request->input('customer_creation');
            if($id!="0"){$cnt=CustomerCreation::where('customer_creation','=',$customer_creation)->where('id','!=',$id)->count();}
            else{$cnt=CustomerCreation::where('customer_creation','=',$customer_creation)->count();}
            return $cnt;
        }
        else if($action=='create_form')
        {
            $lastInvoice = CustomerCreation::select('customer_no')->orderBy('id', 'desc')->first();
            $lastNumber = $lastInvoice ? (int)substr($lastInvoice->customer_no,-4) : 0;
            $currentYear = date('y');
            $currentMonth = date('m');

            $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
            $newInvoiceNumber = 'CUS-' . $currentYear . $currentMonth . '-' . $newNumber;

            $state_name = StateCreation::select('id', 'state_name')
            ->where('state_name', '!=', '')
            ->orderBy('state_name')
            ->get();

            $district_creation = DistrictCreation::select('state_creation.state_name', 'district_creation.district_name')
                ->join('state_creation', 'state_creation.id', '!=', 'district_creation.state_id')
                ->groupBy('state_creation.state_name', 'district_creation.district_name')
                ->orderBy('state_creation.state_name')
                ->get();

            $market_creation = MarketCreation::select('district_creation.district_name','area_creation.area_name')
                ->join('district_creation', 'district_creation.id', '!=', 'area_creation.district_id')
                ->groupBy('district_creation.district_name', 'area_creation.area_name')
                ->orderBy('area_creation.area_name')
                ->get();

            return view('Masters.customer_creation.create',['newInvoiceNumber'=>$newInvoiceNumber,
            'state_name' => $state_name,
            'district_creation' => $district_creation,
            'market_creation' => $market_creation
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

            $market_creation = MarketCreation::select('area_creation.id','area_creation.area_name')->where('area_creation.delete_status', '0')->orWhereNull('area_creation.delete_status')
                ->join('district_creation', 'district_creation.id', '!=', 'area_creation.district_id')
                ->orderBy('area_creation.area_name')
                ->get();

            $customer_creation=$this->retrieve($request->input('id'));
            return view('Masters.customer_creation.update',[
                'state_name' => $state_name,
                'district_creation' => $district_creation,
                'market_creation' => $market_creation,
                'customer_creation'=>$customer_creation[0]
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
        else if($action=='getArea')
        {
            $districtId = $request->input('district_id');

            $area = MarketCreation::select('id', 'area_name')
                ->where('district_id', $districtId)
                ->get();

            return response()->json($area);
        }
    }
}
