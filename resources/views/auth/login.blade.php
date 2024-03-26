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
                    <h4>login / register</h4>
                    <ul>
                        <li><a href="#">home</a></li>
                        <li><a href="#">login / register</a></li>
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
       LOGIN/REGISTER PAGE START
    ==============================-->
<section id="wsus__login_register">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-xl-5 m-auto">
                <!-- errors  -->
                @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                        <li>- {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <div class="wsus__login_reg_area">
                    <ul class="nav nav-pills mb-3" id="pills-tab2" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pills-home-tab2" data-bs-toggle="pill" data-bs-target="#pills-homes" type="button" role="tab" aria-controls="pills-homes" aria-selected="true">login</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-profile-tab2" data-bs-toggle="pill" data-bs-target="#pills-profiles" type="button" role="tab" aria-controls="pills-profiles" aria-selected="true">signup</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent2">
                        <div class="tab-pane fade show active" id="pills-homes" role="tabpanel" aria-labelledby="pills-home-tab2">
                            <div class="wsus__login">
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf

                                    <div class="wsus__login_input">
                                        <i class="fas fa-user-tie"></i>
                                        <input type="email" name="email" placeholder="User email" value="{{ old('email') }}">
                                    </div>
                                    <div class="wsus__login_input">
                                        <i class="fas fa-key"></i>
                                        <input type="password" name="password" placeholder="Password">
                                    </div>
                                    <div class="wsus__login_save">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" name="remember_me" type="checkbox" id="flexSwitchCheckDefault">
                                            <label class="form-check-label" for="flexSwitchCheckDefault">
                                                Remember me
                                            </label>
                                        </div>
                                        <a class="forget_p" href="{{ route('password.request') }}">
                                            forget password ?
                                        </a>
                                    </div>
                                    <button class="common_btn" type="submit">login</button>
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-profiles" role="tabpanel" aria-labelledby="pills-profile-tab2">
                            <div class="wsus__login">
                                <form action="{{ route('register') }}" method="post">
                                    @csrf
                                    <!-- form name collapse register if has errors -->
                                    <input type="hidden" value="register" name="form">

                                    <div class="wsus__login_input">
                                        <i class="fas fa-user-tie"></i>
                                        <input type="text" name="name" value="{{ old('name') }}" placeholder="name">
                                    </div>
                                    <div class="wsus__login_input">
                                        <i class="far fa-envelope"></i>
                                        <input type="email" name="email" value="{{ old('email') }}" placeholder="email">
                                    </div>
                                    <div class="wsus__login_input">
                                        <i class="fas fa-key"></i>
                                        <input type="password" name="password" placeholder="Password">
                                    </div>
                                    <div class="wsus__login_input">
                                        <i class="fas fa-key"></i>
                                        <input type="password" name="password_confirmation" placeholder="Confirm Password">
                                    </div>
                                    <button class="common_btn mt-4" type="submit">signup</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--============================
       LOGIN/REGISTER PAGE END
    ==============================-->
@endsection

@push('js')
@if (old('form') == 'register' and $errors->any())
<script>
    $('#pills-profile-tab2').click()
</script>
@endif
@endpush
