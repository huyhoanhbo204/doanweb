@extends('client.index')
@section('content')
<div class="link-wrapper">
    <a href="{{ route('index') }}" class="link">home</a>
    <a href="{{ route('product') }}" class="link">product</a>
    <a href="{{ route('product_details', ['id' => $product->id]) }}" class="link">{{ $product->name }}</a>
</div>
<section class="section product">
    <div class="container">
        <figure class="product-image">
            <img id="productImage" src="{{ asset('/client/assets/images/food-menu-1.png') }}" 
                width="400" height="400" loading="lazy" class="w-100" alt="{{ $product->name }}">
        </figure>
        <div class="product-content">
            <h2 class="product-title">{{ $product->name }}</h2>
            <div class="price-wrapper">
                <p class="price-text">Price</p>
                <data value="{{ number_format($product->price, 0) }}" class="price">
                    @if ($product->discount > 0)
                    {{ number_format($product->price - ($product->discount * $product->price / 100), 2) }}$
                    @else
                    {{ number_format($product->price, 2) }}$
                    @endif
                </data>
                @if ($product->discount > 0)
                <del class="del">{{ number_format($product->price, 2) }}$</del>
                @endif
            </div>
            <p class="product-text">{{ $product->description }}</p>
            <div class="product-quantity">
                <button id="decrease">
                    <ion-icon name="remove-outline"></ion-icon>
                </button>
                <span id="quantity">1</span>
                <button id="increase">
                    <ion-icon name="add-outline"></ion-icon>
                </button>
            </div>
            <div class="button-wrapper">
                <button id="orderNow" class="btn btn-fill">Order Now</button>
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')
<script>
document.addEventListener("DOMContentLoaded", () => {
    const decreaseButton = document.getElementById("decrease");
    const increaseButton = document.getElementById("increase");
    const quantityElement = document.getElementById("quantity");
    const priceElement = document.querySelector(".price");
    const delElement = document.querySelector(".del");
    const orderNowButton = document.getElementById("orderNow");
    const productImage = document.getElementById("productImage");

    // Giá trị sản phẩm từ server
    const basePrice = parseFloat("{{ $product->price }}");
    const discount = parseFloat("{{ $product->discount }}");
    const discountedPrice = discount > 0 ? basePrice - (discount * basePrice / 100) : basePrice;

    let quantity = 1;

    // Hàm cập nhật giá
    const updatePrice = () => {
        const totalPrice = discountedPrice * quantity;
        priceElement.textContent = `${totalPrice.toFixed(2)}$`;
        if (delElement) {
            delElement.textContent = `${(basePrice * quantity).toFixed(2)}$`;
        }
    };

    // Giảm số lượng
    decreaseButton.addEventListener("click", () => {
        if (quantity > 1) {
            quantity--;
            quantityElement.textContent = quantity;
            updatePrice();
        }
    });

    // Tăng số lượng
    increaseButton.addEventListener("click", () => {
        quantity++;
        quantityElement.textContent = quantity;
        updatePrice();
    });

    // Xử lý Order Now
    orderNowButton.addEventListener("click", () => {
        const productId = "{{ $product->id }}";
        const productName = "{{ $product->name }}";
        const productPrice = discountedPrice;
        const productImageUrl = productImage.src; // Lấy URL của hình ảnh

        fetch("{{ route('add_to_cart') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
            },
            body: JSON.stringify({
                id: productId,
                name: productName,
                price: productPrice,
                quantity: quantity,
                image: productImageUrl, // Đẩy URL hình ảnh lên server
            }),
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("Product added to cart successfully!");
            } else {
                alert("Failed to add product to cart.");
            }
        })
        .catch(error => {
            console.error("Error:", error);
            alert("An error occurred while adding the product to cart.");
        });
    });
});
</script>
@endsection
