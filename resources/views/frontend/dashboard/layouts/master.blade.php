@include('frontend.dashboard.layouts.header')
@include('frontend.dashboard.layouts.sidebar')

<!--=============================
    DASHBOARD START
  ==============================-->
<section id="wsus__dashboard">
    <div class="container-fluid">

        {{-- sidebar --}}
        @include('frontend.dashboard.layouts.sidebar')

        {{-- content --}}
        @yield('content')

    </div>
</section>
<!--=============================
    DASHBOARD END
  ==============================-->

@include('frontend.dashboard.layouts.footer')
