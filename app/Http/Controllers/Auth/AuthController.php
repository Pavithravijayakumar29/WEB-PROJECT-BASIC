<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin\UserCreation;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index()
    {
        return view ('login.admin');
    }

    public function postLogin(Request $request)
    {


        $name = $request->input('name');
        $password = $request->input('password');

        if (empty($name)) {
            return redirect("/")->with('error', 'Please Enter A User Name ');
        }
        if (empty($password)) {
            return redirect("/")->with('errors', 'Please Enter A Password ');

        }

        $user = UserCreation::where('user_name', $name)->where(function($query){$query->where('delete_status', '0')->orWhereNull('delete_status');})->first();

            if ($user) {

                $storedPassword = base64_decode($user->password);
                if ($password === $storedPassword) {
                    if($user->status==1){
                    session_start();
                    $_SESSION['user']=$name;
                    $_SESSION['market_manager']=$user->market_manager;
                    $_SESSION['designation_id']=$user->designation_id;
                    $_SESSION['id']=$user->id;
                    $_SESSION['user_type_id']=$user->user_type_id;
                    $_SESSION['staff_id']=$user->staff_id;

                    return redirect("/Dashboard/");
                }else {

                    return redirect("/")->withSuccess('Oops! You have Not Active User');
                }
            } else {
                return redirect("/")->withSuccess('Oops! Your Password is Wrong');
            }
        }else{

            return redirect("/")->withSuccess('Oops! You have entered invalid credentials');
        }

    }

}
