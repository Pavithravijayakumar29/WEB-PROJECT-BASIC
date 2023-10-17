<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MarketManagerCreation;

class MarketManagerCreationController extends Controller
{
    public function retrieve($id)
    {

        if($id=='')
        {return MarketManagerCreation::select('id','manager_no','manager_name','contact_no','whatsapp_no','image_name','status1')->where('delete_status', '0')->orWhereNull('delete_status')->orderBy('manager_no')->get();}
        else
        {return MarketManagerCreation::select('id','manager_no','manager_name','gender','address','contact_no','whatsapp_no','email_address','image_name','status1')->orderBy('manager_no')->where('id','=',$id)->get();}
    }
    public function db_cmd(Request $request)
    {
        $action = $request->input('action');
        if ($action == 'insert') {
            $tb = new MarketManagerCreation();
            $tb->manager_no = $request->input('manager_no');
            $tb->manager_name = $request->input('manager_name');
            $tb->gender = $request->input('gender');
            $tb->address = $request->input('address');
            $tb->contact_no = $request->input('contact_no');
            $tb->whatsapp_no = $request->input('whatsapp_no');
            $tb->email_address = $request->input('email_address');
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
            $tb = MarketManagerCreation::find($request->input('id'));
            if ($tb) {
            $tb->manager_no = $request->input('manager_no');
            $tb->manager_name = $request->input('manager_name');
            $tb->gender = $request->input('gender');
            $tb->address = $request->input('address');
            $tb->contact_no = $request->input('contact_no');
            $tb->whatsapp_no = $request->input('whatsapp_no');
            $tb->email_address = $request->input('email_address');
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
            $tb = MarketManagerCreation::find($request->input('id'));
            $tb->delete_status = "1";
            $tb->save();
        }
        else if($action=='retrieve')
        {
            $market_manager_creation = $this->retrieve('');
            return view('Masters.market_manager_creation.list',['market_manager_creation'=>$market_manager_creation,'user_rights_edit_1'=>$request->input('user_rights_edit_1'),'user_rights_delete_1'=>$request->input('user_rights_delete_1')]);
        }
        else if($action=='count')
        {
            $cnt=0;
            $id=$request->input('id');$market_manager_creation=$request->input('market_manager_creation');
            if($id!="0"){$cnt=MarketManagerCreation::where('market_manager_creation','=',$market_manager_creation)->where('id','!=',$id)->count();}
            else{$cnt=MarketManagerCreation::where('market_manager_creation','=',$market_manager_creation)->count();}
            return $cnt;
        }
        else if($action=='create_form')
        {
            $lastInvoice = MarketManagerCreation::select('manager_no')->orderBy('id', 'desc')->first();
            $lastNumber = $lastInvoice ? (int)substr($lastInvoice->manager_no,-4) : 0;
            $currentYear = date('y');
            $currentMonth = date('m');

            $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
            $newInvoiceNumber = 'MAN-' . $currentYear . $currentMonth . '-' . $newNumber;

            return view('Masters.market_manager_creation.create',['newInvoiceNumber'=>$newInvoiceNumber]);
        }
        else if($action=='update_form')
        {
            $market_manager_creation=$this->retrieve($request->input('id'));
            return view('Masters.market_manager_creation.update',
            ['market_manager_creation'=>$market_manager_creation[0]]);
        }
        else if($action=='statusinfo')
        {
            $stat = $request->input('status1')==1 ? "0" : "1";

            $tb = MarketManagerCreation::find($request->input('id'));
            $tb->status1 = $stat;
            $tb->save();

        }
    }
}
