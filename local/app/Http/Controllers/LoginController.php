<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Redirect;
use DB;
use App\Models;

class LoginController extends Controller
{
    protected $redirecTo = "/home";
    
    public function Login(Request $request)
    {
        if ($request->session()->has('name')) {
            return View('home');
        }else{
            return View('login');
        }
    }
 
    public function ValidarForm(Request $request)
    {
        
        $username = $request->input('username');
        $password = $request->input('password');

        if($username != "" AND $password != "") 
        {
            $checkLogin = DB::table('ad_user')->where(['name'=>$username,'password'=>$password])->get();
            
            if(count($checkLogin)>0)
            {
                foreach ($checkLogin as $c)
                {
                    $id = $c->ad_user_id;
                    $org = $c->ad_org_id;
                    $name = $c->title;
                    $email = $c->email;
                }

                if($id==1013285){Session::put('admin', TRUE);}
                Session::put('id', $id); 
                Session::put('org', $org);
                Session::put('name', $name);
                Session::put('email', $email);

                return redirect()->route('home');
            }else{
                
                return Redirect::back()->with('message', 'Datos son incorrectos');
              }

        }else{

            return Redirect::back()->with('message', 'Datos son incorrectos');
        }

    }
    

    public function logout()
    {
        Session::forget('id');
        Session::forget('org');
        Session::forget('name');
        Session::forget('email');
        Session::flush();

        return redirect()->route('login');
    }
    
}
