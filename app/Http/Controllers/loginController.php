<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\register;
use App\Models\login;

class loginController extends Controller
{
    function insert(Request $req){
         $data = new register;
         $data->username = $req->input('txtname');
         $data->password = $req->input('txtpassword');
         $data->gender = $req->input('gender');
         $data->email = $req->input('txtemail');
             
         $data->save();

         $data1 = new login;
         $data1->username = $req->input('txtname');
         $data1->password = $req->input('txtpassword');
         $data1->save();

         return redirect('login');
    }


    function getlogin(Request $req){
            $email=$req->txtemail;
            $password=$req->txtpassword;
            $reg = new register;
            $data = $reg::where('email',$email)->first();
            if($data){
                $req->session()->put('email',$email);
                $req->session()->put('regid',$data['regid']);
                return redirect('mainhome');
            }                   
            else{
                   // echo("Invalid User");
                    return back()->with('success', 'Incorrect Username or password');
            }
    }
}
