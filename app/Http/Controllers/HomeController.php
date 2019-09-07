<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    public function index(){

        $all_product_info=DB::table('tbl_product')
            ->join('tbl_category','tbl_product.category_id','=','tbl_category.category_id')
            ->join('tbl_manufacture','tbl_product.manufacture_id','=','tbl_manufacture.manufacture_id')
            ->select('tbl_product.*','tbl_category.category_name','tbl_manufacture.manufacture_name')
            ->where('tbl_product.publication_status',1)
            ->limit(6)
            ->get();
        return view('/pages.home_content')->with('all_product_info',$all_product_info);

    }

   public function show_product(){

      $all_product_info=DB::table('tbl_product')
            ->join('tbl_category','tbl_product.category_id','=','tbl_category.category_id')
            ->join('tbl_manufacture','tbl_product.manufacture_id','=','tbl_manufacture.manufacture_id')
            ->select('tbl_product.*','tbl_category.category_name','tbl_manufacture.manufacture_name')
            ->where('tbl_product.publication_status',1)
            
            ->get();
        return view('/pages.all_products')->with('all_product_info',$all_product_info);
    }



    public function product_by_category($category_id){
        $all_product_info=DB::table('tbl_product')
            ->join('tbl_category','tbl_product.category_id','=','tbl_category.category_id')
            ->select('tbl_product.*','tbl_category.*')
            ->where('tbl_product.category_id',$category_id)
            ->where('tbl_product.publication_status',1)
            ->get();
        return view('/pages.product_by_category')->with('all_product_info',$all_product_info);




    }

    public function product_by_brand($brand_id){
        $all_product_info=DB::table('tbl_product')
            ->join('tbl_manufacture','tbl_product.manufacture_id','=','tbl_manufacture.manufacture_id')
            ->select('tbl_product.*','tbl_manufacture.*')
            ->where('tbl_product.manufacture_id',$brand_id)
            ->where('tbl_product.publication_status',1)
            ->get();
        return view('/pages.product_by_brand')->with('all_product_info',$all_product_info);




    }

    public function product_details($product_id){

        $product=DB::table('tbl_product')
            ->join('tbl_category','tbl_product.category_id','=','tbl_category.category_id')
            ->join('tbl_manufacture','tbl_product.manufacture_id','=','tbl_manufacture.manufacture_id')
            ->select('tbl_product.*','tbl_category.category_name','tbl_manufacture.manufacture_name')
            ->where('tbl_product.publication_status',1)
            ->where('tbl_product.product_id',$product_id)
            ->first();
        return view('/pages.product_details')->with('product',$product);

    }

}
