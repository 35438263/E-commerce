@extends('layout')
@section('content')

<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Check out</li>
				</ol>
			</div><!--/breadcrums-->

			

			<div class="register-req">
				<p>Please Fill Up This Form</p>
			</div><!--/register-req-->

			<div class="shopper-informations">
				<div class="row">
			
					<div class="col-sm-12 clearfix">
						<div class="bill-to">
							<p>Shipping Details</p>
							<div class="form-one">
								<form action="{{url('/save-shipping-details')}}" method="post">
									{{csrf_field()}}
									<input type="text" name="shipping_email" placeholder="Email*" 
									required="" >
									<input type="text" name="shipping_first_name" placeholder="First Name *" required="">
									<input type="text" name="shipping_last_name" placeholder="Last Name *"required="">
									<input type="text" name="shipping_phone" placeholder="Mobile Number *"required="">
									<input type="text" name="shipping_address" placeholder="Address *"required="">
									<input type="text" name="shipping_city" placeholder="City *"
									required="">

									<input type="submit"   class="btn btn-warning" value ="Done" style="color: black;">
									
								</form>
							</div>
				
						</div>
					</div>
									
				</div>
			</div>
			<div class="review-payment">
				<h2>Review & Payment</h2>
			</div>

			


			
		</div>
	</section> <!--/#cart_items-->




@endsection




