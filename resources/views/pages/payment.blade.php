@extends('layout')
@section('content')
 <section id="cart_items">
        <div class="container col-sm-12">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li class="active">Shopping Cart</li>
                </ol>
            </div>

            <p class="alert-danger">
                <?php
                $message=Session::get('success');
                if($message){
                    echo ($message);
                    Session::put('success',null);

                }

                ?>
            </p>
            <div class="table-responsive cart_info">
                <table class="table table-condensed">
                    <thead>
                    <tr class="cart_menu">
                        <td class="image">Item</td>
                        <td class="price">Price</td>
                        <td class="quantity">Quantity</td>
                        <td class="total">Total</td>
                        <td>action</td>
                    </tr>
                    </thead>

                            <tbody>
                            <?php $total = 0 ?>

                            @if(session('cart'))
                                @foreach(session('cart') as $id => $details)

                                    <?php $total += $details['price'] * $details['qty'];
                                    Session::put('total',$total);

                                    $product_info=DB::table('tbl_product')->where('product_id',$id)->first();
                                    ?>


                            <tr>
                                <td class="view_product">
                                    <a href=""><img src="{{URL::to( $product_info->product_image) }}" style="height: 100px ; width: 100px" alt=""></a>
                                </td>
                                <td class="cart_price">
                                    <p>{{ $details['price'] }}</p>
                                </td>
                                <td class="cart_quantity">
                                    <div class="cart_quantity_button">
                                        <a class="cart_quantity_up" href="{{url('/plus-cart/'.$product_info->product_id)}}"> + </a>
                                        <input class="cart_quantity_input" type="text" name="qty" value="{{ $details['qty'] }}" autocomplete="off" size="2">
                                        <a class="cart_quantity_down" href="{{url('/minus-cart/'.$product_info->product_id)}}"> - </a>
                                    </div>
                                </td>


                                <td class="cart_total_price">
                                    <p class="">{{ $details['price'] * $details['qty'] }}</p>
                                </td>

                                <td class="cart_delete" style="margin-top:30px;">
                                    <a class="fa fa-times" href="{{url('/delete-cart/'.$product_info->product_id)}}"></a>
                                </td>
                            </tr>

                            {{--<tr>--}}
                                {{--<td data-th="Product">--}}
                                    {{--<div class="row">--}}
                                        {{--<div class="col-sm-3 hidden-xs"><img src="{{ $details['image'] }}" width="100" height="100" class="img-responsive"/></div>--}}
                                        {{--<div class="col-sm-9">--}}
                                            {{--<h4 class="nomargin">{{ $details['name'] }}</h4>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</td>--}}
                                {{--<td data-th="Price">${{ $details['price'] }}</td>--}}
                                {{--<td data-th="Quantity">--}}
                                    {{--<input type="number" value="{{ $details['quantity'] }}" class="form-control quantity" />--}}
                                {{--</td>--}}
                                {{--<td data-th="Subtotal" class="text-center">${{ $details['price'] * $details['quantity'] }}</td>--}}
                                {{--<td class="actions" data-th="">--}}
                                    {{--<button class="btn btn-info btn-sm update-cart" data-id="{{ $id }}"><i class="fa fa-refresh"></i></button>--}}
                                    {{--<button class="btn btn-danger btn-sm remove-from-cart" data-id="{{ $id }}"><i class="fa fa-trash-o"></i></button>--}}
                                {{--</td>--}}
                            {{--</tr>--}}








                    @endforeach
                    @endif
                            </tbody>
                </table>
            </div>
        </div>
    </section> <!--/#cart_items-->

<section id="do_action">
	<div class="container">
		<div class="heading">
			<h3>What would you like to do next?</h3>
			<p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
		</div>
		<div class="breadcrumbs">
			<ol class="breadcrumb">
			  <li><a href="#">Home</a></li>
			  <li class="active">Payment method</li>
			</ol>
		</div>
		<div class="paymentCont col-sm-9">
					<div class="headingWrap">
							<h3 class="headingTop text-center">Select Your Payment Method</h3>	
							<p class="text-center">Created with bootsrap button and using radio button</p>
					</div>
					<form action="{{url('/order')}}" method="post">
						{{csrf_field()}}
					<div class="paymentWrap">
						<div class="btn-group paymentBtnGroup btn-group-justified" data-toggle="buttons">
				            <label class="btn paymentMethod active">
				            	<div class="method visa"></div>
				                <input type="radio" name="payment_gateway" checked
				                value="visa"> 
				            </label>
				            <label class="btn paymentMethod">
				            	<div class="method master-card"></div>
				                <input type="radio" name="payment_gateway"
				                value="master-card">

				            </label>
				            <label class="btn paymentMethod">
			            		<div class="method amex"></div>
				                <input type="radio" name="payment_gateway"
				                value="handcash">
				            </label>
				       
				           
				         
				        </div>        
					</div>

					
						
							<input class="btn btn-success pull-left btn-fyi"  
								type="submit" value="Done" 
							></input> 
					
					</form>
				</div>
	</div>
</section><!--/#do_action-->

@endsection