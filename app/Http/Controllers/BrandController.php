<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class BrandController extends Controller
{
    public function index()
    {
        $this->AdminAuthCheck();
        return view('Admin.brand.add_brand');
    }


    public function all_brand ()
    {
        $this->AdminAuthCheck();
        $all_brand_info=DB::table('manufacture_tbls')->get();
        $manage_brand=view('admin.brand.all_brand')
            ->with('all_brand_info',$all_brand_info);
        return view('dashboard_layout')
            ->with('all_brand_info',$manage_brand);
    }


    public function save_brand (Request $request)
    {
        $this->AdminAuthCheck();
        $data=array ();
        $data['manufacture_id'] = $request->manufacture_id;
        $data['manufacture_name'] = $request->manufacture_name;
        $data['manufacture_description'] = $request->manufacture_description;
        $data['publication_status'] = $request->publication_status;

        DB::table('manufacture_tbls')->insert($data);

        Session::put('message', 'Brand Successfully Added');

        return Redirect::to ('/add-brand');

    }


    public function edit_brand ($manufacture_id )
    {
        $this->AdminAuthCheck();
        $brand_info=DB::table('manufacture_tbls')
            ->where('manufacture_id',$manufacture_id)
            ->first();
        $brand_info=view('admin.brand.edit_brand')
            ->with('brand_info',$brand_info);
        return view('dashboard_layout')
            ->with('admin.brand.edit_brand',$brand_info);

    }

    
    public function update_brand (Request $request, $manufacture_id )
    {
        $this->AdminAuthCheck();
        $data=array ();
        $data['manufacture_name'] = $request->manufacture_name;
        $data['manufacture_description'] = $request->manufacture_description;
        DB::table('manufacture_tbls')
            ->where('manufacture_id', $manufacture_id)
            ->update($data);
        Session::put('message', 'Brand Successfully Updated');
        return Redirect::to ('/all-brand');
    }



    public function delete_brand (Request $request, $manufacture_id )
    {
        $this->AdminAuthCheck();
        DB::table('manufacture_tbls')
            ->where('manufacture_id', $manufacture_id)
            ->delete();
        Session::put('message', 'Brand Successfully deleted');
        return Redirect::to ('/all-brand');
    }
    

    public function unactive_brand($manufacture_id)
    {
        $this->AdminAuthCheck();
        DB::table('manufacture_tbls')
            ->where('manufacture_id', $manufacture_id)
            ->update(['publication_status'=>0]);
        Session::put('message', 'Brand Successfully Deactivated');
        return redirect('/all-brand');
    }



    public function active_brand($manufacture_id)
    {
        $this->AdminAuthCheck();
        DB::table('manufacture_tbls')
            ->where('manufacture_id', $manufacture_id)
            ->update(['publication_status'=>1]);
        Session::put('message', 'Brand Successfully activated');
        return redirect('/all-brand');
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
