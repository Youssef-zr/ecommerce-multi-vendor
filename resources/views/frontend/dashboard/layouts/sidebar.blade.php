{{-- sidebar --}}
<div class="dashboard_sidebar">
    <span class="close_icon">
        <i class="far fa-bars dash_bar"></i>
        <i class="far fa-times dash_close"></i>
    </span>
    <a href="{{ route('user.dashboard.index') }}" class="dash_logo"><img src="images/logo.png" alt="logo" class="img-fluid"></a>
    <ul class="dashboard_link">
        <li><a class="active" href="{{ route('user.dashboard.index') }}"><i class="fas fa-tachometer"></i>Dashboadrd</a></li>
        <li><a href="dsahboard_order.html"><i class="fas fa-list-ul"></i> Orders</a></li>
        <li><a href="dsahboard_download.html"><i class="far fa-cloud-download-alt"></i> Downloads</a></li>
        <li><a href="dsahboard_review.html"><i class="far fa-star"></i> Reviews</a></li>
        <li><a href="dsahboard_wishlist.html"><i class="far fa-heart"></i> Wishlist</a></li>
        <li><a href="{{ route('user.dashboard.profile.index') }}"><i class="far fa-user"></i> My Profile</a></li>
        <li><a href="dsahboard_address.html"><i class="fal fa-gift-card"></i> Addresses</a></li>
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
