@foreach ($products as $product)
<li class="food-menu-card">
    <div class="card-banner">
        <img src="{{ asset('client/assets/images/food-menu-1.png') }}" width="300" height="300"
            loading="lazy" class="w-100" alt="">
        <div class="badge">-{{ number_format($product->discount, 0) }}%</div>
        <button class="btn btn-fill food-menu-btn">Order Now</button>
    </div>
    <div class="wrapper">
        <p class="category">{{ $product->category_name }}</p>
        <div class="rating-wrapper">
            <ion-icon name="star"></ion-icon>
            <ion-icon name="star"></ion-icon>
            <ion-icon name="star"></ion-icon>
            <ion-icon name="star"></ion-icon>
            <ion-icon name="star"></ion-icon>
        </div>
    </div>
    <h3 class="h3 card-title">{{ $product->name }}</h3>
    <div class="price-wrapper">
        <p class="price-text">Price</p>
        <data value="12.00" class="price">{{ number_format($product->price, 2) }}$</data>
        <del class="del">
            @if ($product->discount > 0)
            <span class="discounted-price">{{ number_format($product->price - ($product->price * $product->discount / 100), 2) }}$</span>
            @else
            <span class="price">{{ number_format($product->price, 2) }}$</span>
            @endif
        </del>
    </div>
</li>
@endforeach