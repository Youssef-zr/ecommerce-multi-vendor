{{-- sidebar --}}
<div class="dashboard_sidebar">
    <span class="close_icon">
        <i class="far fa-bars dash_bar"></i>
        <i class="far fa-times dash_close"></i>
    </span>
    <a href="dsahboard.html" class="dash_logo"><img src="images/logo.png" alt="logo" class="img-fluid"></a>
    <ul class="dashboard_link">
        <li><a class="active" href="dsahboard.html"><i class="fas fa-tachometer"></i>Dashboadrd</a></li>
        <li><a href="{{ route('vendor.dashboard.product.index') }}"><i class="far fa-list"></i> products</a></li>
        <li><a href="{{ route('vendor.dashboard.shop-profile.index') }}"><i class="far fa-user"></i> Shop Profile</a></li>
        <li><a href="{{ route('vendor.dashboard.profile.index') }}"><i class="far fa-user"></i> My Profile</a></li>
        <li>
            <!-- Authentication -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <a href="#" onclick="event.preventDefault(); this.closest('form').submit();">
                    <i class="far fa-sign-out-alt"></i>
                    Log out
                </a>
            </form>
        </li>
    </ul>
</div>
