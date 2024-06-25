@extends('frontend.dashboard.layouts.master')

@section('title')
- Adress
@endsection

@section('content')
<div class="row">
    <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
        <div class="dashboard_content">
            <h3><i class="fal fa-gift-card"></i> address</h3>
            <div class="wsus__dashboard_add">
                <div class="row">

                    @foreach ($userAdresses as $userAdress )
                    <!-- adress -->
                    <div class="col-xl-6">
                        <div class="wsus__dash_add_single">
                            <h4>Billing Address</h4>
                            <ul>
                                <li><span>name :</span> {{ $userAdress->name }}</li>
                                <li><span>Phone :</span> {{ $userAdress->phone }}</li>
                                <li><span>email :</span> {{ $userAdress->email }}</li>
                                <li><span>country :</span> {{ config('settings.countries')[$userAdress->country] }}</li>
                                <li><span>city :</span> {{ $userAdress->city }}</li>
                                <li><span>zip code :</span> {{ $userAdress->zip_code }}</li>
                                <li><span>address :</span> {{ $userAdress->adress }}</li>
                            </ul>
                            <div class="wsus__address_btn">
                                <a href="{{ route('user.adress.edit',$userAdress->id) }}" class="edit"><i class="fal fa-edit"></i> edit</a>
                                <a href="{{ route('user.adress.destroy',$userAdress->id) }}" class="del bg-danger delete-btn"><i class="fal fa-trash-alt"></i> delete</a>
                            </div>
                        </div>
                    </div>
                    @endforeach

                    <div class="col-12">
                        <a href="{{ route('user.adress.create') }}" class="add_address_btn common_btn">
                            <i class="far fa-plus"></i>
                            add new address
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
