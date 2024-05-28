@include('frontend.dashboard.layouts.header')

<section id="wsus__dashboard">
    <div class="container-fluid">

        <!-- sidebar -->
        @include('frontend.dashboard.layouts.sidebar')

        <!-- content -->
        @yield('content')

    </div>
</section>

@include('frontend.dashboard.layouts.footer')
