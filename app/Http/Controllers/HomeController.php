<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
     public function index ()
     {
        $all_published_product=DB::table('product_tbls')
            ->join('category_tbls','product_tbls.category_id','=','category_tbls.category_id')
            ->join('manufacture_tbls','product_tbls.manufacture_id','=','manufacture_tbls.manufacture_id')
            ->select('product_tbls.*','category_tbls.category_name','manufacture_tbls.manufacture_name')
            ->limit(12)
            ->get();

        $manage_published_product=view('Frontend.extend_frontend')
            ->with('$all_published_product',$all_published_product);

        return view('frontend')
            ->with('Frontend.extend_frontend',$manage_published_product);
     }

     
    public function show_product_by_category ($category_id)
    {
        $product_by_category =DB::table('product_tbls')
            ->join('category_tbls','product_tbls.category_id','=','category_tbls.category_id')
            ->select('product_tbls.*','category_tbls.category_name')
            ->where('category_tbls.category_id', $category_id)
            ->where('product_tbls.publication_status',1)
            ->limit(12)
            ->get();
        $manage_product_by_category=view('Frontend.category_by_product')
            ->with('product_by_category',$product_by_category);
        return view('frontend')
            ->with('Frontend.category_by_product',$manage_product_by_category);
    }



    public function product_by_manufacture ($manufacture_id)
    {
        $product_by_manufacture=DB::table('product_tbls')
            ->join('category_tbls','product_tbls.category_id','=','category_tbls.category_id')
            ->join('manufacture_tbls','product_tbls.manufacture_id','=','manufacture_tbls.manufacture_id')
            ->select('product_tbls.*','category_tbls.category_name','manufacture_tbls.manufacture_name')
            ->where('manufacture_tbls.manufacture_id',$manufacture_id)
            ->where('product_tbls.publication_status',1)
            ->limit(12)
            ->get();
        $manage_product_by_manufacture=view('frontend.product_by_manufacture')
            ->with('product_by_manufacture',$product_by_manufacture);
        return view('frontend')
            ->with('Frontend.product_by_manufacture',$manage_product_by_manufacture);
    }



    public function view_product_details ($product_id)
    {
        $product_by_details=DB::table('product_tbls')
            ->join('category_tbls','product_tbls.category_id','=','category_tbls.category_id')
            ->join('manufacture_tbls','product_tbls.manufacture_id','=','manufacture_tbls.manufacture_id')
            ->select('product_tbls.*','category_tbls.category_name','manufacture_tbls.manufacture_name')
            ->where('product_tbls.product_id',$product_id)
            ->where('product_tbls.publication_status',1)
            ->first();
        $all_product_by_details=view('frontend.product_details')
            ->with('product_by_details',$product_by_details);
        return view('frontend')
            ->with('frontend.product_details',$all_product_by_details);
    }




}
