<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DesignationCreation;
use App\Models\DealerCreation;
use App\Models\EmployeeCreation;

class EmployeeCreationController extends Controller
{
    public function retrieve($id)
    {
        $DealerController_td = (new DealerCreation)->getTable();
        $EmployeeController_td = (new EmployeeCreation)->getTable();

        if($id=='')
        {return EmployeeCreation::join($DealerController_td, $DealerController_td.'.id', '=', $EmployeeController_td.'.dealer_id')
            ->orderBy($EmployeeController_td.'.employee_no')
            ->get([$EmployeeController_td.'.id',$EmployeeController_td.'.employee_no',$EmployeeController_td.'.employee_name',$EmployeeController_td.'.contact_no',$DealerController_td.'.dealer_name',$EmployeeController_td.'.image_name']);

        }
        else
        {return EmployeeCreation::select('id','employee_no','employee_name','gender','address','contact_no','phone_no','email_address','aadhar_no','designation_id','staff_head_id','dealer_id','salary','incentive','image_name','status1')->orderBy('employee_no')->where('id','=',$id)->get();}
    }
    public function db_cmd(Request $request)
    {
        $action = $request->input('action');
        if ($action == 'insert') {
            $tb = new EmployeeCreation();
            $tb->employee_no = $request->input('employee_no');
            $tb->employee_name = $request->input('employee_name');
            $tb->gender = $request->input('gender');
            $tb->address = $request->input('address');
            $tb->contact_no = $request->input('contact_no');
            $tb->phone_no = $request->input('phone_no');
            $tb->email_address = $request->input('email_address');
            $tb->aadhar_no = $request->input('aadhar_no');
            $tb->designation_id = $request->input('designation_id');
            $tb->staff_head_id = $request->input('staff_head_id');
            $tb->dealer_id = $request->input('dealer_id');
            $tb->salary = $request->input('salary');
            $tb->incentive = $request->input('incentive');
            $tb->status1 = $request->input('status1');

            if ($request->hasFile('image_name')) {
                $image = $request->file('image_name');
                $imgName = $image->getClientOriginalName();

                $image->storeAs('public/employee_images', $imgName);

                $tb->image_name = $imgName;
            } else {

                $tb->image_name = "default_image.png";
            }
            $tb->save();
        }
        else if($action=='update')
        {
            $tb = EmployeeCreation::find($request->input('id'));
            if ($tb) {
            $tb->employee_no = $request->input('employee_no');
            $tb->employee_name = $request->input('employee_name');
            $tb->gender = $request->input('gender');
            $tb->address = $request->input('address');
            $tb->contact_no = $request->input('contact_no');
            $tb->phone_no = $request->input('phone_no');
            $tb->email_address = $request->input('email_address');
            $tb->aadhar_no = $request->input('aadhar_no');
            $tb->designation_id = $request->input('designation_id');
            $tb->staff_head_id = $request->input('staff_head_id');
            $tb->dealer_id = $request->input('dealer_id');
            $tb->salary = $request->input('salary');
            $tb->incentive = $request->input('incentive');
            $tb->status1 = $request->input('status1');

            if ($request->hasFile('image_name')) {
                $image = $request->file('image_name');
                $imgName = $image->getClientOriginalName();
                $image->storeAs('public/employee_images', $imgName);

                $tb->image_name = $imgName;
            }
            $tb->save();
        }
    }
        else if($action=='delete')
        {
            $tb = EmployeeCreation::where('id','=',$request->input('id'));
            $tb->delete();
        }
        else if($action=='retrieve')
        {
            $employee_creation = $this->retrieve('');
            return view('Masters.employee_creation.list',['employee_creation'=>$employee_creation,'user_rights_edit_1'=>$request->input('user_rights_edit_1'),'user_rights_delete_1'=>$request->input('user_rights_delete_1')]);
        }
        else if($action=='count')
        {
            $cnt=0;
            $id=$request->input('id');$employee_creation=$request->input('employee_creation');
            if($id!="0"){$cnt=EmployeeCreation::where('employee_creation','=',$employee_creation)->where('id','!=',$id)->count();}
            else{$cnt=EmployeeCreation::where('employee_creation','=',$employee_creation)->count();}
            return $cnt;
        }
        else if($action=='create_form')
        {
            $lastInvoice = EmployeeCreation::select('employee_no')->orderBy('id', 'desc')->first();
            $lastNumber = $lastInvoice ? (int)substr($lastInvoice->employee_no,-4) : 0;
            $currentYear = date('y');
            $currentMonth = date('m');

            $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
            $newInvoiceNumber = 'EMP-' . $currentYear . $currentMonth . '-' . $newNumber;

            $designation_name = DesignationCreation::select('id', 'designation_name')
                ->where('designation_name', '!=', '')
                ->orderBy('designation_name')
                ->get();
            $dealer_name = DealerCreation::select('id', 'dealer_name')
                ->where('dealer_name', '!=', '')
                ->orderBy('dealer_name')
                ->get();
            $employee_name = EmployeeCreation::select('id', 'employee_name')
                ->where('employee_name', '!=', '')
                ->orderBy('employee_name')
                ->get();

            return view('Masters.employee_creation.create',['newInvoiceNumber'=>$newInvoiceNumber,'designation_name'=>$designation_name,
            'employee_name'=>$employee_name,
            'dealer_name'=>$dealer_name,
        ]);
        }
        else if($action=='update_form')
        {
        $designation_name = DesignationCreation::select('id', 'designation_name')
            ->where('designation_name', '!=', '')
            ->orderBy('designation_name')
            ->get();
        $dealer_name = DealerCreation::select('id', 'dealer_name')
            ->where('dealer_name', '!=', '')
            ->orderBy('dealer_name')
            ->get();
        $employee_name = EmployeeCreation::select('id', 'employee_name')
            ->where('employee_name', '!=', '')
            ->orderBy('employee_name')
            ->get();

            $employee_creation=$this->retrieve($request->input('id'));
            return view('Masters.employee_creation.update',
            ['designation_name'=>$designation_name,
            'employee_name'=>$employee_name,
            'dealer_name'=>$dealer_name,
            'employee_creation'=>$employee_creation[0]
        ]);
        }
    }
}
