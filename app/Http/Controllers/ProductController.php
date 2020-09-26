<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    public function index()
    {
        $this->AdminAuthCheck();
        return view('Admin.product.add_product');
    }

    public function unactive_product($product_id)
    {
        $this->AdminAuthCheck();
        DB::table('product_tbls')
            ->where('product_id', $product_id)
            ->update(['publication_status'=>0]);
        Session::put('message', 'Product Successfully Deactivated');
        return redirect('/all-product');
    }
    public function active_product ($product_id)
    {
        $this->AdminAuthCheck();
        DB::table('product_tbls')
            ->where('product_id', $product_id)
            ->update(['publication_status'=>1]);
        Session::put('message', 'Product Successfully activated');
        return redirect('/all-product');
    }
    

    public function all_product ()
    {
        $this->AdminAuthCheck();
        $all_product_info=DB::table('product_tbls')
            ->join('category_tbls','product_tbls.category_id','=','category_tbls.category_id')
            ->join('manufacture_tbls','product_tbls.manufacture_id','=','manufacture_tbls.manufacture_id')
            ->select('product_tbls.*','category_tbls.category_name','manufacture_tbls.manufacture_name')
            ->get();

        $manage_product=view('admin.product.all_product')
            ->with('all_product_info',$all_product_info);
        return view('dashboard_layout')
            ->with('all_brand_info',$manage_product);
    }



    public function save_product (Request $request)
    {
        $this->AdminAuthCheck();
        $data=array ();
        $data['product_name'] = $request->product_name;
        $data['category_id'] = $request->category_id;
        $data['manufacture_id'] = $request->manufacture_id;
        $data['product_short_description'] = $request->product_short_description;
        $data['product_price'] = $request->product_price;
        $data['product_size'] = $request->product_size;
        $data['product_color'] = $request->product_color;
        $data['publication_status'] = $request->publication_status;
        $image=$request->file('product_image');
        if($image){
            $image_name=str_random(20);
            $ext=strtolower($image->getClientOriginalExtension());
            $img_full_name=$image_name.'.'.$ext;
            $upload_path='image/';
            $img_url=$upload_path.$img_full_name;
            $success=$image->move($upload_path, $img_full_name);
            if($success){
                $data['product_image']=$img_url;
                DB::table('product_tbls')->insert($data);
                Session::put('message', 'Product Successfully Added');
                return Redirect::to ('/add-product');
            }

        }
        $data['product_image']='';
        DB::table('product_tbls')->insert($data);
        Session::put('message', 'Product Successfully Added without image');
        return Redirect::to ('/add-product');
    }



    public function update_product (Request $request,$product_id)
    {
        $data = array();
        $data['category_id'] = $request->category;
        $data['manufacture_id'] = $request->manufacture;
        $data['product_name'] = $request->product_name;
        $data['product_short_description'] = $request->product_short_description;
        $data['product_price'] = $request->product_price;
        $data['product_size'] = $request->product_size;
        $data['product_color'] = $request->product_color;

        $image = $request->file('product_image');
        if ($image){
            $image_name = str_random(20);
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name.'.'.$ext;
            $upload_path = 'image/';
            $image_url = $upload_path.$image_full_name;
            $success = $image->move($upload_path,$image_full_name);
            if ($success){
                $data['product_image'] = $image_url;

                DB::table('product_tbls')->where('product_id',$product_id)->update($data);
                Session::put('message','Product Update Successfully!!');
                return Redirect::to('/all-product');
            }
        }
        $data['product_image'] = '';
        DB::table('product_tbls')->where('product_id',$product_id)->update($data);
        Session::put('message','Product Updated Successfully Without Image!!');
        return Redirect::to('/all-product');
    }
    

    public function delete_product (Request $request, $product_id )
    {
        $this->AdminAuthCheck();
        DB::table('product_tbls')
            ->where('product_id', $product_id)
            ->delete();
        Session::put('message', 'Product Successfully deleted');
        return Redirect::to ('/all-product');
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
