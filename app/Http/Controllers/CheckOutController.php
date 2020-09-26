<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class CheckOutController extends Controller
{
    public function login_checkout ()
    {
        return view('login.login');
    }

    public function customer_registration (Request $request)
    {
         $data= array();
         $data ['customer_name']=$request->customer_name;
         $data ['customer_email']=$request->customer_email;
         $data ['password']=$request->password;
         $data ['phone_no']=$request->phone_no;
         $customer_id=DB::table('customer_tbls')
          				->insertGetId($data);
         Session::put('customer_id', $customer_id);
         Session::put('customer_name', $request->customer_name);
         return Redirect('/checkout');
    }

    public function manage_order ()
    {

        $all_order_info=DB::table('order_tbls')
            ->join('customer_tbls','order_tbls.order_id','=','customer_tbls.customer_id')
            ->select('order_tbls.*','customer_tbls.customer_name')
            ->get();

        $manage_order=view('Admin.manage_order')
            ->with('all_order_info',$all_order_info);
        return view('dashboard_layout')
            ->with('Admin.manage_order',$manage_order);
    }

    public function checkout ()
    {
        return view('Frontend.checkout');
    }
    public function place_order (Request $request)
    {
        $payment_method= $request->payment_method;
        $pdata= array();
        $pdata ['payment_method']=$payment_method;
        $pdata ['payment_status']='pending';
        $payment_id=DB::table('payment_tbls')
            ->insertGetId($pdata);

        $odata= array();
        $odata ['customer_id']=Session::get('customer_id');
        $odata ['shipping_id']=Session::get('shipping_id');
        $odata ['payment_id']= $payment_id;
        $odata ['order_total']=\Cart::total();
        $odata ['order_status']='pending';
        $order_id=DB::table('order_tbls')
            ->insertGetId($odata);
        $contents= \Cart::content();
            $oddata= array();
            foreach ($contents as $v_contents)
            {
                $oddata ['order_id']= $order_id;
                $oddata ['product_id']= $v_contents->id;
                $oddata ['product_name']= $v_contents->name;
                $oddata ['product_price']= $v_contents->price;
                $oddata ['product_sales_quantity']= $v_contents->qty;
                DB::table('order_details_tbls')
                    ->insert($oddata);
            }
            if ($payment_method=='bkash')
            {
                return view('frontend.payment_method');
                Cart::destroy();
            } elseif ($payment_method=='paypal')
            {
                 echo "successfully done by handcash";
            }   elseif ($payment_method=='visa') {
                echo "successfully done by visa";
            }
            else {echo "not selected";}

    }

    public function save_shipping_details (Request $request)
    {
        $data= array();
        $data ['shipping_email']=$request->shipping_email;
        $data ['shipping_first_name']=$request->shipping_first_name;
        $data ['shipping_last_name']=$request->shipping_last_name;
        $data ['shipping_address']=$request->shipping_address;
        $data ['shipping_mobile_number']=$request->shipping_mobile_number;
        $data ['shipping_city']=$request->shipping_city;

        $shipping_id=DB::table('shipping_tbls')
            ->insertGetId($data);
        Session::put('shipping_id', $shipping_id);
        return Redirect('/payment');
    }

    public function customer_login (Request $request)
    {

        $customer_email=$request->customer_email;
        $password=md5($request->password);

        $result= DB::table('customer_tbls')
            ->where('customer_email', $customer_email)
            ->where('password', $password)
            ->first();

        if ($result){
            Session::put('customer_id',$result->customer_id);
            return Redirect::to ('/checkout');
        } else {
            return Redirect::to ('/login-check');
        }
    }

    public function customer_logout ()
    {
        Session::flush();
        return Redirect::to ('/');

    }
    public function payment ()
    {
        return view('Frontend.payment');
    }


}
