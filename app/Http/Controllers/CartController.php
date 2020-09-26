<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Redirect;

class CartController extends Controller
{
    
    public function add_to_cart (Request $request)
    {
        $qty=$request->qty;
        $product_id=$request->product_id;
        $product_info=DB::table('product_tbls')
            ->where('product_id', $product_id)
            ->first();
        $data['qty']=$qty;
        $data['id']=$product_info->product_id;
        $data['name']=$product_info->product_name;
        $data['price']=$product_info->product_price;
        $data['options']['image']=$product_info->product_image;
        Cart::add ($data);

        return Redirect::to('/show_cart_details');
    }

    public function show_cart_details(request $request)
    {
        $all_published_category=DB::table('category_tbls')
            ->where('publication_status', 1)
            ->get();
        $manage_published_category=view('Frontend.add_to_cart')
            ->with('all_published_category',$all_published_category);

        return view('frontend')
            ->with('Frontend.add_to_cart',$manage_published_category);

    }

    public function delete_to_cart ($rowId)
    {
        Cart::Update($rowId,0);
        return redirect::to('/show_cart_details');
    }

    public function update_to_cart (Request $request)
    {
        $qty=$request->qty;
        $rowId=$request->rowId;

        Cart::Update($rowId,$qty);
        return redirect::to('/show_cart_details');
    }
}
