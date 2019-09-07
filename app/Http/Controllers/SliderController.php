<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

session_start();


class SliderController extends Controller
{
    public function index(){
        $this->AdminCheck();
        return view('admin.add_slider');


    }
    public function all_slider(){
        $this->AdminCheck();
        $all_slider_info=DB::table('tbl_slider')->get();
        return view('/admin.all_slider')->with('all_slider_info',$all_slider_info);

    }
    public function save_slider(Request $request){
        $data=array();
        if($request->publication_status) {
            $data['publication_status'] = $request->publication_status;
        }else{
            $data['publication_status']=0;

        }


        $image=$request->file('slider_image');
        if($image){
            $image_name=str_random(20);
            $ext=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $upload_path='image/';
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);
            if($success){
                $data['slider_image']=$image_url;

                DB::table('tbl_slider')->insert($data);
                Session::put('message','slider added successfuly');

                return Redirect::to('/add-slider');

            }
            $data['slider_image']='';
            DB::table('tbl_slider')->insert($data);
            Session::put('message','slider added successfuly');
            return Redirect::to('/add-slider');
        }
    }
    public function unactive_slider($slider_id){

        DB::table('tbl_slider')->where('slider_id',$slider_id)->update(['publication_status'=>0]);
        Session::put('message','slider unactived successfuly');
        return Redirect::to('/all-slider');


    }
    public function active_slider($slider_id){

        DB::table('tbl_slider')->where('slider_id',$slider_id)->update(['publication_status'=>1]);
        Session::put('message','slider actived successfuly');
        return Redirect::to('/all-slider');


    }
    public function delete_slider($slider_id){
        DB::table('tbl_slider')->where('slider_id',$slider_id)->delete();
        Session::put('message','slider deleted successfuly');
        return Redirect::to('/all-slider');

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
