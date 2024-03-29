@extends('layout')
@section('content')
@include('slider')

    <h2 class="title text-center">Features Items</h2>
@foreach($all_product_info as $product_info)
    <div class="col-sm-4">
        <div class="product-image-wrapper">
            <div class="single-products">
                <div class="productinfo text-center">
                    <img src="{{URL::to($product_info->product_image)}}" style="height: 300px ;" alt="" />
                    <h2>${{$product_info->product_price}}</h2>
                    <p>{{$product_info->product_name}}</p>
                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                </div>
                <div class="product-overlay">
                    <div class="overlay-content">
                        <h2>${{$product_info->product_price}}</h2>
                        <p>{{$product_info->product_name}}</p>
                        <a href="{{URL::to('/product-details/'.$product_info->product_id)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                    </div>
                </div>
            </div>
            <div class="choose">
                <ul class="nav nav-pills nav-justified">
                    <li><a href="#"><i class="fa fa-plus-square"></i>{{$product_info->manufacture_name}}</a></li>
                    <li><a href="{{URL::to('/product-details/'.$product_info->product_id)}}"><i class="fa fa-plus-square"></i>View Product</a></li>
                </ul>
            </div>
        </div>
    </div><!--features_items-->
    @endforeach
    </div><!--features_items-->

   

   

@endsection