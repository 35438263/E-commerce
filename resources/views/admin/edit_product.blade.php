@extends('admin_layout')
@section('admin_content')

    <ul class="breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="index.html">Home</a>
            <i class="icon-angle-right"></i>
        </li>
        <li>
            <i class="icon-edit"></i>
            <a href="#">Update Product</a>
        </li>
    </ul>

    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon edit"></i><span class="break"></span>Update Product</h2>

            </div>
            <p class="alert-success">
                <?php
                $message=Session::get('message');
                if($message){
                    echo ($message);
                    Session::put('message',null);

                }


                $all_category_info=DB::table('tbl_category')->where('publication_status',1)->get();
                $all_brand_info=DB::table('tbl_manufacture')->where('publication_status',1)->get();

                ?>
            </p>
            <div class="box-content">
                <form class="form-horizontal" action="{{url('/update-product/'.$product_info->product_id)}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <fieldset>
                        <div class="control-group">
                            <label class="control-label" for="typeahead">Product Name </label>
                            <div class="controls">
                                <input type="text" class="input-xlarge" name="product_name"  value="{{$product_info->product_name}}">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="selectError3">Product Category</label>
                            <div class="controls">
                                <?php
                                $category=DB::table('tbl_category')->where('category_id',$product_info->category_id)->first();
                                $brand=DB::table('tbl_manufacture')->where('manufacture_id',$product_info->manufacture_id)->first();

                                ?>

                                <select id="selectcategory" name="category_selection">

                                    <option selected  value="{{$category->category_id}}">{{$category->category_name}}</option>
                                    @foreach($all_category_info as $category_info)
                                        <option value="{{$category_info->category_id}}">{{$category_info->category_name}}</option>

                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="selectError3">Product Brand</label>

                            <div class="controls">
                                <select id="selectcategory" name="brand_selection">
                                    <option selected  value="{{$brand->manufacture_id}}">{{$brand->manufacture_name}}</option>
                                    @foreach($all_brand_info as $brand_info)
                                        <option value="{{$brand_info->manufacture_id}}">{{$brand_info->manufacture_name}}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>





                        <div class="control-group">
                            <label class="control-label" for="date01">Product short description</label>
                            <div class="controls">
                                <textarea class="cleditor" name="product_short_description" rows="3" >{{$product_info->product_short_description}}</textarea>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="date01">Product long description</label>
                            <div class="controls">
                                <textarea class="cleditor" name="product_long_description" rows="3" >{{$product_info->product_long_description}}</textarea>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="typeahead">Product Price </label>
                            <div class="controls">
                                <input type="text" class="input-xlarge" name="product_price" value="{{$product_info->product_price}}">
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="fileInput">Image</label>
                            <div class="controls">
                                <input class="input-file uniform_on" name="product_image" id="product_image"  type="file">
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="typeahead">Product size </label>
                            <div class="controls">
                                <input type="text" class="input-xlarge" name="product_size"  value="{{$product_info->product_size}}">
                            </div>
                        </div>


                        <div class="control-group">
                            <label class="control-label" for="typeahead">Product color </label>
                            <div class="controls">
                                <input type="text" class="input-xlarge" name="product_color"  value="{{$product_info->product_color}}">
                            </div>
                        </div>


                        {{----}}
                        {{--<div class="control-group">--}}
                            {{--<label class="control-label" for="typeahead">Brand Name </label>--}}
                            {{--<div class="controls">--}}
                                {{--<input type="text" class="input-xlarge" name="brand_name"  value= {{$brand_info->manufacture_name}}>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="control-group">--}}
                            {{--<label class="control-label" for="date01">Brand description</label>--}}
                            {{--<div class="controls">--}}
                                {{--<textarea class="cleditor" name="brand_description" rows="3"  >--}}
                                    {{--{{$brand_info->manufacture_description}} </textarea>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">update Product</button>
                        </div>
                    </fieldset>
                </form>

            </div>
        </div><!--/span-->

    </div><!--/row-->

@endsection