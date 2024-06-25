@extends('admin.layouts.master')

@section("content")
<section class="section">
    <div class="section-header">
        <h1>Profile</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item">Profile</div>
        </div>
    </div>
    <div class="section-body">
        <h2 class="section-title">{{ $auth->name }}</h2>
        <div class="row mt-sm-4">

            <!-- update general info -->
            <div class="col-12 col-lg-8 col-xl-7">
                <div class="card">
                    <form method="post" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data" class="needs-validation">
                        @csrf
                        @method("put")

                        <div class="card-header">
                            <h4>Update Profile</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <!-- image field -->
                                <div class="col-12">
                                    <div class="form-group mb-3 img-thumbnail" style="width: 90px;height:90px;border-radius:50%">
                                        <img src="{{ asset($auth->image) }}" class="w-100 h-100" alt="{{ $auth->name }}" style="border-radius:50%">
                                    </div>
                                </div>

                                <div class="form-group col-12">

                                    <label>Image</label>
                                    <input type="file" class="w-100" name="image">
                                    @if ($errors->any())
                                    <code>{{ $errors->first('image') }}</code>
                                    @endif
                                </div>

                                <!-- name field -->
                                <div class="form-group col-md-6 col-12">
                                    <label>First Name</label>
                                    <input type="text" class="form-control" name="name" value="{{ $auth->name }}" required="">
                                    @if ($errors->any())
                                    <code>{{ $errors->first('name') }}</code>
                                    @endif
                                </div>

                                <!-- email field -->
                                <div class="form-group col-md-6 col-12">
                                    <label>Email</label>
                                    <input type="email" class="form-control" name="email" value="{{ $auth->email }}" required="">
                                    @if ($errors->any())
                                    <code>{{ $errors->first('email') }}</code>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right pt-0">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- update password -->
            <div class="col-12 col-lg-8 col-xl-7">
                <div class="card">
                    <form method="post" action="{{ route('admin.profile.update_password') }}" enctype="multipart/form-data" class="needs-validation">
                        @csrf
                        @method("put")

                        <div class="card-header">
                            <h4>Update Password</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <!-- current password field -->
                                <div class="form-group col-12">

                                    <label>Current Password</label>
                                    <input type="password" class="form-control" name="current_password">
                                    @if ($errors->any())
                                    <code>{{ $errors->first('current_password') }}</code>
                                    @endif
                                </div>

                                <!-- new password field -->
                                <div class="form-group col-md-6 col-12">
                                    <label>New Password</label>
                                    <input type="password" class="form-control" name="password" required="">
                                    @if ($errors->any())
                                    <code>{{ $errors->first('password') }}</code>
                                    @endif
                                </div>

                                <!-- new password field -->
                                <div class="form-group col-md-6 col-12">
                                    <label>Confirm Password</label>
                                    <input type="password" class="form-control" name="password_confirmation" required="">
                                    @if ($errors->any())
                                    <code>{{ $errors->first('password_confirmation') }}</code>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right pt-0">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
