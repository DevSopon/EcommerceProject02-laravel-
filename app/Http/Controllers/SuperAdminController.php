<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SuperAdminController extends Controller
{
    public function index ()
    {
        $this->AdminAuthCheck();
        return view ('Admin.extended_dashboard');
    }

    public function logout ()
    {
        Session::flush();
        return redirect('/login');
    }
    public function AdminAuthCheck ()
    {
        $admin_id=Session::get('admin_id');
        if ($admin_id) {
            return view ('Admin.extended_dashboard');
        } else{
            return redirect('/login')->send();
        }

    }
}
