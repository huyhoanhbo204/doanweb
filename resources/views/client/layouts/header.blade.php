<div class="top-bar">
    <div class="container">
        <p>Free shipping for all orders above 50$</p>
    </div>
</div>

<div class="nav-wrapper">
    <div class="container">
        <h1 class="h1">
            <a href="{{ route('index') }}" class="logo">M<span class="span">EAT</span></a>
            <a href="{{ route('index') }}" class="logo">EAT<span class="span">ER</span></a>
        </h1>
        <div class="menu-wrapper">
            <button class="nav-open-btn" aria-label="Open Menu" data-nav-toggle-btn>
                <ion-icon class="menu-icon" name="menu-outline"></ion-icon>
                <ion-icon class="close-icon" name="close-outline"></ion-icon>
            </button>
            <nav class="navbar" data-navbar>
                <ul class="navbar-list">
                    <li>
                        <a href="{{ route('index') }}" class="navbar-link active">Home</a>
                    </li>
                    <li>
                        <a href="{{ route('index') }}" class="navbar-link">About</a>
                    </li>
                    <li>
                        <a href="{{ route('index') }}" class="navbar-link">Shop</a>
                    </li>
                    <li>
                        <a href="{{ route('index') }}" class="navbar-link">Blog</a>
                    </li>
                    <li>
                        <a href="{{ route('product') }}" class="navbar-link">Products</a>
                    </li>
                    <li>
                        <a href="{{ route('index') }}" class="navbar-link">Contact</a>
                    </li>
                </ul>
            </nav>
        </div>

        <div class="header-action">

            <div class="search-wrapper" data-search-wrapper>
                <button class="header-action-btn" data-search-btn>
                    <ion-icon name="search-outline" class="search-icon"></ion-icon>
                </button>

                <div class="input-wrapper">
                    <form action="{{route('product')}}" method="get">
                        <input type="search" name="name" placeholder="Search here" class="search-input">
                        <button class="search-submit" aria-label="Submit search">
                            <ion-icon name="search-outline"></ion-icon>
                        </button>
                    </form>
                </div>
            </div>

            <div class="cart-wrapper">
                <button class="header-action-btn cart" aria-label="Open shopping cart" data-panel-btn="cart">
                    <ion-icon class="basket-outline" name="basket-outline"></ion-icon>
                    <ion-icon class="basket" name="basket"></ion-icon>
                    <data value="2" class="btn-badge" id="total-card">{{ count($cart) }}</data>
                </button>
                <div class="side-panel cart" data-side-panel="cart">
                    <ul class="panel-list" id="cart-ul">
                        @foreach ($cart as $id => $product)
                        <li class="panel-item">
                            <a href="{{ route('product_details', ['id' => $id]) }}" class="panel-card">
                                <figure class="item-banner">
                                    <img src="{{ $product['image'] }}" width="46" height="46" loading="lazy" alt="fried chicken 1">
                                </figure>
                                <div>
                                    <p class="item-title">{{ $product['name'] }}</p>
                                    <span class="item-value">{{ number_format($product['price'] * $product['quantity'], 2) }}$</span>
                                    <span class="item-amount">x{{ $product['quantity'] }}</span>
                                </div>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                    <div class="subtotal" id="subtotal">
                        <p class="subtotal-text">Subtotal:</p>
                        <data id="total-sub" value="{{ array_sum(array_map(function($product) { return $product['price'] * $product['quantity']; }, $cart)) }}" class="subtotal-value">
                            ${{ number_format(array_sum(array_map(function($product) { return $product['price'] * $product['quantity']; }, $cart)), 2) }}
                        </data>
                    </div>
                    <a href="{{ route('view_cart') }}" class="panel-btn btn btn-fill">View Cart</a>
                </div>
            </div>

            <!-- Kiểm tra trạng thái đăng nhập -->
            @auth
            <div class="user-wrapper">
                <a href="javascript:void(0);" class="header-action-btn user-profile" aria-label="Open user" data-panel-btn="user">
                    <ion-icon class="user-outline" name="person-circle-outline"></ion-icon>
                    <ion-icon class="user" name="person-circle"></ion-icon>
                </a>

                <div class="side-panel user-profile" data-side-panel="user">
                    <div class="avatar-wrapper">
                        <p><b>Chào mừng:</b></p>
                        <h3 class="username">{{ Auth::user()->fullname }}</h3>
                    </div>
                    @if(Auth::check() && Auth::user()->role != 'user')
                    <a href="{{ route('categories.index') }}" class="user-profile-wrapper">
                        <ion-icon name="reader"></ion-icon>
                        <p class="banner-subtitle">Trang quản lý</p>
                    </a>
                    @endif

                    <a href="{{ route('profile.edit') }}" class="user-profile-wrapper">
                        <ion-icon name="person-circle-outline"></ion-icon> <!-- Icon đổi thông tin người dùng -->
                        <p class="banner-subtitle">Đổi thông tin</p>
                    </a>
                    <a href="{{ route('password.change') }}" class="user-profile-wrapper">
                        <ion-icon name="key-outline"></ion-icon> <!-- Icon đổi mật khẩu -->
                        <p class="banner-subtitle">Đổi mật khẩu</p>
                    </a>
                    <a href="{{ route('index') }}" class="user-profile-wrapper">
                        <ion-icon name="file-tray-full-outline"></ion-icon> <!-- Icon nhật ký giao dịch -->
                        <p class="banner-subtitle">Nhật ký giao dịch</p>
                    </a>
                    <a href="{{ route('logout') }}" class="panel-btn btn btn-fill">Log Out</a>
                </div>

            </div>
            @else
            <div class="user-wrapper">
                <a href="{{ route('login') }}" class="header-action-btn user-profile" aria-label="Login">
                    <ion-icon class="user-outline" name="person-circle-outline"></ion-icon>
                    <ion-icon class="user" name="person-circle"></ion-icon>
                </a>
            </div>
            @endauth

        </div>
    </div>
</div>