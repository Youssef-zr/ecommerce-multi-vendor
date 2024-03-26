@extends('frontend.layouts.master')

@section('content')

<!--============================
        BREADCRUMB START
    ==============================-->
<section id="wsus__breadcrumb">
    <div class="wsus_breadcrumb_overlay">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h4>change password</h4>
                    <ul>
                        <li><a href="#">login</a></li>
                        <li><a href="#">change password</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!--============================
        BREADCRUMB END
    ==============================-->

<!--============================
        CHANGE PASSWORD START
    ==============================-->
<section id="wsus__login_register">
    <div class="container">
        <div class="row">
            <div class="col-xl-5 col-md-10 col-lg-7 m-auto">

                <form action="{{ route('password.store') }}" method="post">
                    @csrf

                    <div class="wsus__change_password">
                        <h4>reset password</h4>

                        <!-- password reset token -->
                        <input type="hidden" name="token" value="{{ $request->route('token')  }}">

                        <div class="wsus__single_pass">
                            <label>Email adress</label>
                            <input type="email" name="email" value="{{ old('email') }}" placeholder="Your email adress">
                            @if ($errors->has('email'))
                            <code>{{ $errors->first('email') }}</code>
                            @endif
                        </div>

                        <div class="wsus__single_pass">
                            <label>new password</label>
                            <input type="password" name="password" placeholder="New Password">
                            @if ($errors->has('password'))
                            <code>{{ $errors->first('password') }}</code>
                            @endif
                        </div>

                        <div class="wsus__single_pass">
                            <label>confirm password</label>
                            <input type="password" name="password_confirmation" placeholder="Confirm Password">
                            @if ($errors->has('password_confirmation'))
                            <code>{{ $errors->first('password_confirmation') }}</code>
                            @endif
                        </div>
                        <button class="common_btn" type="submit">submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!--============================
        CHANGE PASSWORD END
    ==============================-->

@endsection
