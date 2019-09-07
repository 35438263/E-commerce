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
            <a href="#">Add Product</a>
        </li>
    </ul>

    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon edit"></i><span class="break"></span>Add Product</h2>

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
                <form class="form-horizontal" action="{{url('/save-product')}}" method="post"  enctype="multipart/form-data">
                    {{csrf_field()}}
                    <fieldset>
                        <div class="control-group">
                            <label class="control-label" for="typeahead">Product Name </label>
                            <div class="controls">
                                <input type="text" class="input-xlarge" name="product_name"  required="">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="selectError3">Product Category</label>
                            <div class="controls">
                                <select id="selectcategory" name="category_selection">

                                    <option hidden >select category</option>
                                    @foreach($all_category_info as $category)
                                    <option value="{{$category->category_id}}">{{$category->category_name}}</option>

                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="selectError3">Product Brand</label>

                                <div class="controls">
                                    <select id="selectcategory" name="brand_selection">
                                        <option hidden>select brand</option>
                                    @foreach($all_brand_info as $brand)
                                        <option value="{{$brand->manufacture_id}}">{{$brand->manufacture_name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                        </div>





                        <div class="control-group">
                            <label class="control-label" for="date01">Product short description</label>
                            <div class="controls">
                                <textarea class="cleditor" name="product_short_description" rows="3" required="" ></textarea>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="date01">Product long description</label>
                            <div class="controls">
                                <textarea class="cleditor" name="product_long_description" rows="3" required="" ></textarea>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="typeahead">Product Price </label>
                            <div class="controls">
                                <input type="text" class="input-xlarge" name="product_price"  required="">
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
                                <input type="text" class="input-xlarge" name="product_size"  required="">
                            </div>
                        </div>


                        <div class="control-group">
                            <label class="control-label" for="typeahead">Product color </label>
                            <div class="controls">
                                <input type="text" class="input-xlarge" name="product_color"  required="">
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="fileInput">Publication Status</label>
                            <div class="controls">
                                <input  type="checkbox" name="publication_status" value="1">
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Add Product</button>
                        </div>
                    </fieldset>
                </form>

            </div>
        </div><!--/span-->

    </div><!--/row-->

@endsection