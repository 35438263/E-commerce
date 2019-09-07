@extends('admin_layout')
@section('admin_content')

    <div class="row-fluid sortable">
        <div class="box span6">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon user"></i><span class="break"></span>Customer Details</h2>

            </div>

            <div class="box-content">
                <table class="table table-striped ">
                    <thead>
                    <tr>
                        
                        <th>Customer Name</th>
                        <th>Email</th>
                        <th>Mmobile Number</th>
                        
                    </tr>
                    </thead>
                    
                    <tbody>
                        @foreach($all_order_info as $order)
                        @endforeach
                    <tr>
                        
                        <td class="center">{{$order->customer_name}}</td>
                        <td class="center">{{$order->customer_email}}</td>
                        <td class="center">{{$order->customer_phone}}</td>
                       
                    </tr>

                    </tbody>
                        
                </table>
            </div>
        </div><!--/span-->

    
   
        <div class="box span6">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon user"></i><span class="break"></span>Shipping Details</h2>

            </div>

            <div class="box-content">
                <table class="table table-striped ">
                    <thead>
                    <tr>
                        <th>Shipping Name</th>
                        <th>Address</th>
                        <th>Mobile Number</th>
                        <th>Email</th>
                        
                        
                    </tr>
                    </thead>
                    
                    <tbody>
                          @foreach($all_order_info as $order)
                    @endforeach
                    <tr>
                        
                        <td class="center">{{$order->shipping_first_name}} 
                            </td>
                        <td class="center">{{$order->shipping_address}}</td>
                        <td class="center">{{$order->shipping_phone}}</td>
                        <td class="center">{{$order->shipping_email}}</td>
                       
                    </tr>


                    </tbody>
                       
                </table>
            </div>
        </div><!--/span-->

   
    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon user"></i><span class="break"></span>Order Details</h2>

            </div>

            <div class="box-content">
                <table class="table table-striped ">
                    <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Product Name</th>
                        <th>Product Price</th>
                        <th>Product Sales Quantity </th>
                        <th>Product Sub total </th>
                        
                    </tr>
                    </thead>
                    
                        
                    <tbody>
                        @foreach($all_order_info as $order)
                    <tr>    
                        <td class="center">{{$order->order_id}}</td>
                        <td class="center">{{$order->product_name}}</td>
                        <td class="center">{{$order->product_price}}</td>
                        <td class="center">{{$order->product_sales_quantity}}</td>
                        <td class="center">{{$order->product_price*$order->product_sales_quantity}}</td>
                    </tr>


                       @endforeach
                     

                    </tbody>
                    <tfoot>
                       <tr>
                           <td colspan="4"><strong> Total : </strong></td>
                   <td><strong>=  {{$order->order_total}}</strong></td>


                       </tr> 


                    </tfoot>
                </table>
            </div>
        </div><!--/span-->

    </div><!--/row-->
    @endsection