@extends('vendor.layouts.master')

@section('content')
    <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
            <div class="dashboard_content mt-2 mt-md-0">
                <h3><i class="far fa-user"></i> profile</h3>
                <div class="wsus__dashboard_profile">
                    <!-- errors  -->
                    @if ($errors->any())
                        <ul class="alert alert-danger my-3">
                            @foreach ($errors->all() as $error)
                                <li>- {{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <div class="wsus__dash_pro_area">

                        <!-- vendor information form -->
                        <form action="{{ route('vendor.dashboard.profile.update') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')

                            <h4>basic information</h4>

                            <div class="row">
                                <div class="col-xl-3 col-sm-6 col-md-4 mt-3 mb-4">
                                    <div class="wsus__dash_pro_img">
                                        <img src="{{ $user->image ? asset($user->image) : asset('frontend/images/ts-2.jpg') }}"
                                            alt="img" class="img-fluid w-100">
                                        <input type="file" name="image">
                                    </div>
                                </div>

                                <div class="col-xl-10">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="wsus__dash_pro_single">
                                                <i class="fas fa-user-tie"></i>
                                                <input type="text" name="name" value="{{ $user->name }}"
                                                    placeholder="Name">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="wsus__dash_pro_single">
                                                <i class="far fa-phone-alt"></i>
                                                <input type="text" name="phone" value="{{ $user->phone }}"
                                                    placeholder="Phone">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="wsus__dash_pro_single">
                                                <i class="fal fa-envelope-open"></i>
                                                <input type="email" value="{{ $user->email }}" name="email"
                                                    placeholder="Email">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <button class="common_btn" type="submit">
                                        <i class="fa fa-edit"></i>
                                        Update
                                    </button>
                                </div>
                            </div>
                        </form>

                        <hr class="my-5 d-block">

                       <!-- password form  -->
                        <form action="{{ route('vendor.dashboard.password.update') }}" method="post">
                            @csrf
                            @method('put')
                            <h4 class="mb-4">Update Password</h4>
                            <div class="row">

                                <div class="wsus__dash_pass_change">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="wsus__dash_pro_single">
                                                <i class="fas fa-unlock-alt"></i>
                                                <input type="password" name="current_password"
                                                    placeholder="Current Password">
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-md-6">
                                            <div class="wsus__dash_pro_single">
                                                <i class="fas fa-lock-alt"></i>
                                                <input type="password" name="password" placeholder="New Password">
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-md-6">
                                            <div class="wsus__dash_pro_single">
                                                <i class="fas fa-lock-alt"></i>
                                                <input type="password" name="password_confirmation"
                                                    placeholder="Confirm Password">
                                            </div>
                                        </div>
                                        <div class="col-xl-12">
                                            <button class="common_btn" type="submit">
                                                <i class="fa fa-pencil"></i>
                                                Update
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
