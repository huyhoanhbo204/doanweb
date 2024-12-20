<div class="top-bar">
    <div class="container">
        <p>Free shiping for all order above 50$</p>
    </div>
</div>

<div class="nav-wrapper">
    <div class="container">
        <h1 class="h1">
            <a href="./index.html" class="logo">M<span class="span">EAT</span></a>
            <a href="./index.html" class="logo">EAT<span class="span">ER</span></a>
        </h1>
        <div class="menu-wrapper">
            <button class="nav-open-btn" aria-label="Open Menu" data-nav-toggle-btn>
                <ion-icon class="menu-icon" name="menu-outline"></ion-icon>
                <ion-icon class="close-icon" name="close-outline"></ion-icon>
            </button>
            <nav class="navbar" data-navbar>
                <ul class="navbar-list">
                    <li>
                        <a href="{{route('index')}}" class="navbar-link active">Home</a>
                    </li>
                    <li>
                        <a href="./index.html" class="navbar-link">About</a>
                    </li>
                    <li>
                        <a href="./index.html" class="navbar-link">Shop</a>
                    </li>
                    <li>
                        <a href="./index.html" class="navbar-link">Blog</a>
                    </li>
                    <li>
                        <a href="{{route('product')}}" class="navbar-link">Products</a>
                    </li>
                    <li>
                        <a href="./index.html" class="navbar-link">Contact</a>
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
                    <input type="search" name="search" placeholder="Search here" class="search-input">

                    <button class="search-submit" aria-label="Submit search">
                        <ion-icon name="search-outline"></ion-icon>
                    </button>
                </div>
            </div>
            <div class="cart-wrapper">
                <button class="header-action-btn cart" aria-label="Open shopping cart" data-panel-btn="cart">
                    <ion-icon class="basket-outline" name="basket-outline"></ion-icon>
                    <ion-icon class="basket" name="basket"></ion-icon>
                    <data value="2" class="btn-badge" id="total-card">{{Count($cart)}}</data>
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


                        </li>
                        </a>
                        @endforeach
                    </ul>
                    <div class="subtotal" id="subtotal">
                        <p class="subtotal-text">Subtotal:</p>
                        <data id="total-sub"  value="{{ array_sum(array_map(function($product) { return $product['price'] * $product['quantity']; }, $cart)) }}" class="subtotal-value">
                            ${{ number_format(array_sum(array_map(function($product) { return $product['price'] * $product['quantity']; }, $cart)), 2) }}
                        </data>
                    </div>


                    <a href="{{route('view_cart')}}" class="panel-btn btn btn-fill">View Cart</a>
                </div>
            </div>

            <button class="header-action-btn whishlist" aria-label="Open whishlist" data-panel-btn="whishlist">
                <a href="./whishlist.html" class="panel-btn btn btn-fill">View Whishlist</a>
            </button>
        </div>
    </div>
</div>
<script>

</script>