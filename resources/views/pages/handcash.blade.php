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

                        <h1>Thanks For Order..</h1>
                        <h2>we will contact you as soon as possible</h2>
                        
                    </div><!--/login form-->
                </div>
                <!--<div class="col-sm-1">
                    <h2 class="or">OR</h2>
                </div>
                <div class="col-sm-4">
                    <div class="signup-form">sign up form
                        <h2>New User Signup!</h2>
                       
                    </div>/sign up form-->
                    
                </div>
            </div>
        </div>
    </section><!--/form-->













@endsection