<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

session_start();

class ManufactureController extends Controller
{
    public function index(){
        $this->AdminCheck();
        return view('admin.add_brand');


    }
    public function all_brand(){
        $this->AdminCheck();
        $all_brand_info=DB::table('tbl_manufacture')->get();
        return view('/admin.all_brand')->with('all_brand_info',$all_brand_info);

    }


    public function save_brand(Request $request){
        $data=array();
        $data['manufacture_id']=$request->brand_id;
        $data['manufacture_name']=$request->brand_name;
        $data['manufacture_description']=$request->brand_description;
        if($request->publication_status) {
            $data['publication_status'] = $request->publication_status;
        }else{
            $data['publication_status']=0;

        }

        DB::table('tbl_manufacture')->insert($data);
        Session::put('message','brand added successfuly');

        return Redirect::to('/add-brand');




    }


    public function unactive_brand($brand_id){

        DB::table('tbl_manufacture')->where('manufacture_id',$brand_id)->update(['publication_status'=>0]);
        Session::put('message','brand unactived successfuly');
        return Redirect::to('/all-brand');


    }
    public function active_brand($brand_id){

        DB::table('tbl_manufacture')->where('manufacture_id',$brand_id)->update(['publication_status'=>1]);
        Session::put('message','brand actived successfuly');
        return Redirect::to('/all-brand');


    }

    public function edit_brand($brand_id){
        $brand_info=DB::table('tbl_manufacture')->where('manufacture_id',$brand_id)->first();
        $this->AdminCheck();
        return view('admin.edit_brand')->with('brand_info',$brand_info);

    }
    public function update_brand(Request $request,$brand_id){
        $data=array();
        $data['manufacture_name']=$request->brand_name;
        $data['manufacture_description']=$request->brand_description;
        DB::table('tbl_manufacture')->where('manufacture_id',$brand_id)->update($data);
        Session::put('message','brand updated successfuly');

        return Redirect::to('/all-brand');



    }
    public function delete_brand($brand_id){
        DB::table('tbl_manufacture')->where('manufacture_id',$brand_id)->delete();
        Session::put('message','brand deleted successfuly');

        return Redirect::to('/all-brand');


    }


    public function AdminCheck(){
        $admin_id=Session::get('admin_id');
        if($admin_id){

            return;
        }else{
            return Redirect::to('/admin')->send();

        }
    }
}
