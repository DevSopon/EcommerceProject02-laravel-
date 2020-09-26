<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function index () {
        return view ('login.admin_login');
    }

    public function dashboard (Request $request)
    {
        $admin_email=$request->admin_email;
        $admin_password=md5($request->admin_password);
        $result=DB::table('admin_tbls')
            ->where('admin_email', $admin_email)
            ->where('admin_password', $admin_password)
            ->first();
        echo "<pre>";
        print_r($result);
        if ($result) {
            Session::put ('admin_name', $result->admin_name);
            Session::put ('admin_id', $result->admin_id);
            return redirect::to ('/dashboard');
        }
        else {
            Session::put ('message', 'Email or password invalid');
            return redirect::to ('/login');

        }
    }
}
