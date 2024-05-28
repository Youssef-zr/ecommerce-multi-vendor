<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <!-- sidebar brand -->
        <div class="sidebar-brand">
            <a href="{{ route('admin.dashboard.index') }}">Stisla</a>
        </div>

        <!-- sidbar brand st -->
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('admin.dashboard.index') }}">St</a>
        </div>

        <!-- sidebar menu -->
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="{{ setActive(['admin.dashboard.index']) }}">
                <a class="nav-link" href="{{ route('admin.dashboard.index') }}">
                    <i class="fas fa-fire"></i>
                    Dashboard
                </a>
            </li>
            <li class="menu-header">Website</li>

            <!-- manage categories -->
            <li
                class="dropdown {{ setActive([
                    'admin.dashboard.category.*',
                    'admin.dashboard.sub-category.*',
                    'admin.dashboard.child-category.*',
                ]) }}">

                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                    <i class="fas fa-columns"></i>
                    <span>Manage Categories</span>
                </a>

                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.dashboard.category.*']) }}">
                        <a class="nav-link" href="{{ route('admin.dashboard.category.index') }}">Categories</a>
                    </li>
                    <li class="{{ setActive(['admin.dashboard.sub-category.*']) }}"><a class="nav-link"
                            href="{{ route('admin.dashboard.sub-category.index') }}">Sub Categories</a>
                    </li>
                    <li class="{{ setActive(['admin.dashboard.child-category.*']) }}">
                        <a class="nav-link" href="{{ route('admin.dashboard.child-category.index') }}">Child
                            Categories
                        </a>
                    </li>
                </ul>
            </li>

            <!-- manage products -->
            <li
                class="dropdown {{ setActive([
                    'admin.dashboard.brand.*',
                    'admin.dashboard.product.*',
                    'admin.dashboard.image-gallery.*',
                    'admin.dashboard.product-variant.*',
                    'admin.dashboard.product-variant-item.*',
                    'admin.dashboard.seller-product.*',
                ]) }}">

                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                    <i class="fas fa-columns"></i>
                    <span>Manage Products</span>
                </a>

                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.dashboard.brand.*']) }}">
                        <a class="nav-link" href="{{ route('admin.dashboard.brand.index') }}">
                            Brands
                        </a>
                    </li>
                    <li
                        class="{{ setActive(['admin.dashboard.product.*', 'admin.dashboard.image-gallery.*', 'admin.dashboard.product-variant.*', 'admin.dashboard.product-variant-item.*']) }}">
                        <a class="nav-link" href="{{ route('admin.dashboard.product.index') }}">
                            Products
                        </a>
                    </li>
                    <li class="{{ setActive(['admin.dashboard.seller-product.*']) }}">
                        <a class="nav-link" href="{{ route('admin.dashboard.seller-product.index') }}">
                            Seller Product
                        </a>
                    </li>
                </ul>
            </li>

            <!-- manage website -->
            <li class="dropdown {{ setActive(['admin.dashboard.slider.*']) }}">

                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                    <i class="fas fa-columns"></i>
                    <span>Manage Website</span>
                </a>

                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.dashboard.slider.*']) }}"><a class="nav-link"
                            href="{{ route('admin.dashboard.slider.index') }}">Sliders</a></li>
                </ul>
            </li>

            <!-- manage vendor -->
            <li
                class="dropdown {{ setActive(['admin.dashboard.vendor-profile.*', 'admin.dashboard.flash-sale.*', 'admin.dashboard.coupon.*', 'admin.dashboard.shipping-rule.*']) }}">

                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                    <i class="fas fa-columns"></i>
                    <span>Ecommerce</span>
                </a>

                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.dashboard.flash-sale.*']) }}">
                        <a class="nav-link" href="{{ route('admin.dashboard.flash-sale.index') }}">
                            Flash Sale
                        </a>
                    </li>
                    <li class="{{ setActive(['admin.dashboard.coupon.*']) }}">
                        <a class="nav-link" href="{{ route('admin.dashboard.coupon.index') }}">
                            Coupons
                        </a>
                    </li>
                    <li class="{{ setActive(['admin.dashboard.shipping-rule.*']) }}">
                        <a class="nav-link" href="{{ route('admin.dashboard.shipping-rule.index') }}">
                            Shipping Rule
                        </a>
                    </li>
                    <li class="{{ setActive(['admin.dashboard.vendor-profile.*']) }}">
                        <a class="nav-link" href="{{ route('admin.dashboard.vendor-profile.edit') }}">
                            Vendor Profile
                        </a>
                    </li>
                </ul>
            </li>

            <!-- general setting -->
            <li>
                <a class="nav-link" href="{{ route('admin.dashboard.settings.index') }}">
                    <i class="fas fa-columns"></i>
                    <span>Settings</span>
                </a>
            </li>
        </ul>
    </aside>
</div>
