@extends('admin_layout')
@section('admin_content')
    <ul class="breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="index.html">Home</a>
            <i class="icon-angle-right"></i>
        </li>
        <li><a href="#">All Brand</a></li>
    </ul>
    <p class="alert-success">
        <?php
        $message=Session::get('message');
        if($message){
            echo ($message);
            Session::put('message',null);

        }

        ?>
    </p>
    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon user"></i><span class="break"></span>All Brand</h2>

            </div>

            <div class="box-content">
                <table class="table table-striped table-bordered bootstrap-datatable datatable">
                    <thead>
                    <tr>
                        <th>Brand ID</th>
                        <th>Brand Name</th>
                        <th>Brand Description</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    @foreach($all_brand_info as $brand)
                        <tbody>
                        <tr>
                            <td>{{$brand->manufacture_id}}</td>
                            <td class="center">{{$brand->manufacture_name}}</td>
                            <td class="center">{{$brand->manufacture_description}}</td>
                            <td class="center">
                                @if($brand->publication_status==1)
                                    <span class="label label-success">Active</span>
                                @else
                                    <span class="label label-danger">Unactive</span>
                                @endif

                            </td>
                            <td class="center">
                                @if($brand->publication_status==1)
                                    <a class="btn btn-danger" href="{{URL::to('/unactive-brand/'.$brand->manufacture_id)}}">
                                        <i class="halflings-icon white thumbs-down"></i>
                                    </a>
                                @else
                                    <a class="btn btn-success" href="{{URL::to('/active-brand/'.$brand->manufacture_id)}}">
                                        <i class="halflings-icon white thumbs-up"></i>
                                    </a>
                                @endif
                                <a class="btn btn-info" href="{{URL::to('/edit-brand/'.$brand->manufacture_id)}}">
                                    <i class="halflings-icon white edit"></i>
                                </a>
                                <a class="btn btn-danger" id="delete" href="{{URL::to('/delete-brand/'.$brand->manufacture_id)}}">
                                    <i class="halflings-icon white trash"></i>
                                </a>
                            </td>
                        </tr>


                        </tbody>
                    @endforeach
                </table>
            </div>
        </div><!--/span-->

    </div><!--/row-->
@endsection