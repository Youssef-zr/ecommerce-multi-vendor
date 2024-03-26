<!-- header -->
@include("admin.layouts.header")

<div id="app">
    <div class="main-wrapper main-wrapper-1">
        <div class="navbar-bg"></div>
        <!-- navbar -->
        @include('admin.layouts.navbar')

        <!-- sidebar -->
        @include('admin.layouts.sidebar')

        <!-- Main Content -->
        <div class="main-content">
            @yield('content')
        </div>

        <footer class="main-footer">
            <div class="footer-left">
                Copyright &copy; 2018 <div class="bullet"></div> Design By <a href="https://nauval.in/">Muhamad Nauval Azhar</a>
            </div>
            <div class="footer-right">

            </div>
        </footer>
    </div>
</div>

<!-- header -->
@include("admin.layouts.footer")
