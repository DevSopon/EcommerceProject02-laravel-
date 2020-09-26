@extends('frontend')

@section('content')

    <section id="form"><!--form-->
        <div class="container">
            <div class="row">
                <div class="col-sm-3 col-sm-offset-1">
                    <div class="login-form"><!--login form-->
                        <h2>Login to your account</h2>
                        <form action="{{url('/customer_login')}}"  method="post">
                            @csrf
                            <input type="text" name="customer_email" placeholder="Enter email" />
                            <input type="password" name="password" placeholder="password" />
                            <button type="submit" class="btn btn-default">Login</button>
                        </form>
                    </div><!--/login form-->
                </div>
                <div class="col-sm-1">
                    <h2 class="or">OR</h2>
                </div>
                <div class="col-sm-3">
                    <div class="signup-form"><!--sign up form-->
                        <h2>New User Signup!</h2>
                        <form action="{{url('/customer_registration')}}" method="post">
                            @csrf
                            <input type="text" name="customer_name" placeholder="Enter Name" required=""/>
                            <input type="email" name="customer_email" placeholder="Email Address" required=""/>
                            <input type="password" name="password" placeholder="Password" required=""/>
                            <input type="text" name="phone_no" placeholder="Phone No" required=""/>
                            <button type="submit" class="btn btn-default">Signup</button>
                        </form>
                    </div><!--/sign up form-->
                </div>
            </div>
        </div>
    </section><!--/form-->

@endsection
