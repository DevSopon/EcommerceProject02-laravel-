<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class SliderController extends Controller
{
    public function index ( )
    {
        $this->AdminAuthCheck();
        return view('admin.slider.add_slider');
    }


    public function all_slider ()
    {
        $this->AdminAuthCheck();
        $all_slider_info=DB::table('slider_tbls')->get();
        $manage_slider=view('admin.slider.all_slider')
            ->with('all_slider_info',$all_slider_info);
        return view('dashboard_layout')
            ->with('$all_slider_info',$manage_slider);
    }

    
    public function delete_slider (Request $request, $slider_id )
    {
        $this->AdminAuthCheck();
        DB::table('slider_tbls')
            ->where('slider_id', $slider_id)
            ->delete();
        Session::put('message', 'Slider Successfully deleted');
        return Redirect::to ('/all-slider');
    }
    public function unactive_slider($slider_id)
    {
        $this->AdminAuthCheck();
        DB::table('slider_tbls')
            ->where('slider_id', $slider_id)
            ->update(['publication_status'=>0]);
        Session::put('message', 'Slider Successfully Deactivated');
        return redirect('/all-slider');
    }
    public function active_slider($slider_id)
    {
        $this->AdminAuthCheck();
        DB::table('slider_tbls')
            ->where('slider_id', $slider_id)
            ->update(['publication_status'=>1]);
        Session::put('message', 'Slider Successfully activated');
        return redirect('/all-slider');
    }

    public function save_slider (Request $request)
    {
        $this->AdminAuthCheck();
        $data=array ();
        $data['publication_status'] = $request->publication_status;
        $image=$request->file('slider_image');
        if($image){
            $image_name=str_random(20);
            $ext=strtolower($image->getClientOriginalExtension());
            $img_full_name=$image_name.'.'.$ext;
            $upload_path='slider/';
            $img_url=$upload_path.$img_full_name;
            $success=$image->move($upload_path, $img_full_name);
            if($success){
                $data['slider_image']=$img_url;
                DB::table('slider_tbls')->insert($data);
                Session::put('message', 'Slider Successfully Added');
                return Redirect::to ('/add-slider');
            }

        }
        $data['slider_image']='';
        DB::table('slider_tbls')->insert($data);
        Session::put('message', 'Product Successfully Added without image');
        return Redirect::to ('/add-slider');
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
