@extends('layout')
@section('content')


<section id="form"><!--form-->
        <div class="container">

 <p class="alert-danger">
                <?php
                $message=Session::get('customer');
                if($message){
                    echo ($message);
                    Session::put('customer',null);

                }

                ?>
                </p>
            <div class="row">
                <div class="col-sm-4 ">
                    <div class="login-form"><!--login form-->

                        <h2>Login to your account</h2>
                        <form action="{{url('/customer-login')}}" method="post">
                            {{csrf_field()}}
                            <input type="email" required="" placeholder="Email" name="customer_email" />
                            <input type="password" required="" placeholder="password" 
                            name="password" />
                           
                            <button type="submit" class="btn btn-default">Login</button>
                        </form>
                    </div><!--/login form-->
                </div>
                <div class="col-sm-1">
                    <h2 class="or">OR</h2>
                </div>
                <div class="col-sm-4">
                    <div class="signup-form"><!--sign up form-->
                        <h2>New User Signup!</h2>
                        <form action="{{url('customer-register')}}" method="post">
                            {{csrf_field()}}
                            <input type="text" placeholder="Full Name" name="customer_name" />
                            <input type="email" placeholder="Email Address" name="customer_email" />
                            <input type="text" placeholder="Phone Number" name="customer_phone" />
                            <input type="password" placeholder="Password" name="password" />
                            <button type="submit" class="btn btn-default">Signup</button>
                        </form>
                    </div><!--/sign up form-->
                </div>
            </div>
        </div>
    </section><!--/form-->













@endsection