<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    public function index()
    {
        $this->AdminAuthCheck();
        return view('Admin.category.add_category');
    }

    public function all_category ()
    {
        $this->AdminAuthCheck();
        $all_category_info=DB::table('category_tbls')->get();
        $manage_category=view('Admin.category.all_category')
            ->with('all_category_info',$all_category_info);
        return view('dashboard_layout')
            ->with('all_category_info',$manage_category);
    }

    public function save_category (Request $request)
    {
        $this->AdminAuthCheck();
        $data=array ();
        $data['category_id'] = $request->category_id;
        $data['category_name'] = $request->category_name;
        $data['category_description'] = $request->category_description;
        $data['publication_status'] = $request->publication_status;

        DB::table('category_tbls')->insert($data);
        Session::put('message', 'Category Successfully Added');
        return Redirect::to ('/add-category');
    }




    public function edit_category ($category_id )
    {
        $this->AdminAuthCheck();
        $category_info=DB::table('category_tbls')
            ->where('category_id',$category_id)
            ->first();
        $category_info=view('Admin.category.edit_category')
            ->with('category_info',$category_info);
        return view('dashboard_layout')
            ->with('Admin.category.edit_category',$category_info);

    }



    public function update_category (Request $request, $category_id )
    {
        $this->AdminAuthCheck();
        $data=array ();
        $data['category_name'] = $request->category_name;
        $data['category_description'] = $request->category_description;
        DB::table('category_tbls')
            ->where('category_id', $category_id)
            ->update($data);

        Session::put('message', 'Category Successfully Updated');

        return Redirect::to ('/all-category');

    }



    public function delete_category (Request $request, $category_id )
    {

        $this->AdminAuthCheck();
        DB::table('category_tbls')
            ->where('category_id', $category_id)
            ->delete();

        Session::put('message', 'Category Successfully deleted');

        return Redirect::to ('/all-category');

    }

    public function unactive_category($category_id)
    {
        DB::table('category_tbls')
            ->where('category_id', $category_id)
            ->update(['publication_status'=>0]);
        Session::put('message', 'Category Successfully Deactivated');
        return redirect('/all-category');
    }
    public function active_category($category_id)
    {
        DB::table('category_tbls')
            ->where('category_id', $category_id)
            ->update(['publication_status'=>1]);
        Session::put('message', 'Category Successfully activated');
        return redirect('/all-category');
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
