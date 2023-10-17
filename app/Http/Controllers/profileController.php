<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SalesRepCreation;
use App\Models\DesignationCreation;
use App\Models\MarketManagerCreation;

class profileController extends Controller
{
    public function showProfile()
    {
        session_start();

        if($_SESSION['staff_id']==''){
            $ida=$_SESSION['market_manager'];
            $market=MarketManagerCreation::find($ida);
            return view('login.prof', ['market'=>$market]);
        }else {
            $id=$_SESSION['staff_id'];
            $employeeCreation=SalesRepCreation::find($id);
            return view('login.profile', [
                'employee_creation' => $employeeCreation]);
        }
    }
}
session_write_close();
