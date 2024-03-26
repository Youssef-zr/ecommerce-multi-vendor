@include('vendor.layouts.header')
@include('vendor.layouts.sidebar')

<!--=============================
    DASHBOARD START
  ==============================-->
<section id="wsus__dashboard" class="pt-0">
    <div class="container-fluid">

        <li><a href="dsahboard_address.html"><i class="fal fa-gift-card"></i> Addresses</a></li>
        <!-- sidebar -->
        @include('vendor.layouts.sidebar')

        <li><a href="dsahboard_address.html"><i class="fal fa-gift-card"></i> Addresses</a></li>
        <!-- content -->
        @yield('content')

    </div>
</section>
<!--=============================
    DASHBOARD START
  ==============================-->

@include('vendor.layouts.footer')
