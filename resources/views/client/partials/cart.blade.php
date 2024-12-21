@extends('client.index')
@section('content')

<section class="section shopping-cart">
    <div class="container">
        <h1 class="heading">
            <ion-icon name="cart-outline" role="img" class="md hydrated" aria-label="cart outline"></ion-icon> Shopping Cart
        </h1>

        <div class="section-wrapper">

            <!-- Cart -->

            <div class="cart">

                <div class="cart-item-box">

                    <h2 class="section-heading">Order Summary</h2>

                    <ul class="product-list">

                        @foreach ($cart as $id => $product)
                        <li class="product-item" data-id="{{ $id }}">
                            <figure class="item-banner">
                                <img src="{{ $product['image'] }}" width="80" alt="{{ $product['name'] }}">
                            </figure>

                            <div class="detail">
                                <h3 class="item-title">{{ $product['name'] }}</h3>
                                <div class="wrapper">
                                    <div class="product-quantity">
                                        <button class="quantity-btn decrease" data-id="{{ $id }}">
                                            <ion-icon name="remove-outline"></ion-icon>
                                        </button>
                                        <span class="quantity" id="quantity-{{ $id }}">{{ $product['quantity'] }}</span>
                                        <button class="quantity-btn increase" data-id="{{ $id }}">
                                            <ion-icon name="add-outline"></ion-icon>
                                        </button>
                                    </div>
                                    <div class="product-price">
                                        $<span class="price" data-id="{{ $id }}">{{ number_format($product['price'] * $product['quantity'], 2) }}</span>
                                    </div>
                                </div>
                            </div>
                        </li>
                        @endforeach


                    </ul>

                </div>

                <div class="total-wrapper">

                    <div class="discount-token">
                        <label for="token" class="label-default">Gift card/Discount code</label>
                        <div class="discount-wrapper">
                            <input type="text" name="discount-token" class="input-field" id="discount-token">
                            <button class="btn btn-fill" id="apply-discount">Apply</button>
                        </div>
                    </div>
                    <div class="amount-wrapper">
                        <div class="amount">
                            <span>Subtotal</span>
                            <span id="total-sub-card">
                                ${{ number_format(array_sum(array_map(function($product) { return $product['price'] * $product['quantity']; }, $cart)), 2) }}
                            </span>
                        </div>
                        <div class="amount">
                            <span>Shipping</span>
                            $<span id="shipping">2.05</span>
                        </div>

                        <div class="amount total">
                            <span>Total</span>
                            <span id="total-price">
                                ${{ number_format(
                array_sum(array_map(function($product) { return $product['price'] * $product['quantity']; }, $cart)) + 2.05, 2) }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Check out -->

            <div class="section checkout">

                <h2 class="section-heading">Payment Details</h2>

                <div class="payment-form">

                    <div class="payment-method">

                        <button class="method" data-tab-btn="qr">
                            <ion-icon name="qr-code" role="img" class="md hydrated" aria-label="qr code"></ion-icon>
                            <span class="span">QR Code</span>
                            <ion-icon class="checkmark md hydrated" name="checkmark-circle-outline" data-checkmark-circle="" role="img" aria-label="checkmark circle outline"></ion-icon>
                        </button>
                        <button class="method" data-tab-btn="COD">
                            <ion-icon name="wallet" role="img" class="md hydrated" aria-label="wallet"></ion-icon>
                            <span class="span">COD</span>
                            <ion-icon class="checkmark md hydrated" name="checkmark-circle-outline" data-checkmark-circle="" role="img" aria-label="checkmark circle outline"></ion-icon>
                        </button>

                    </div>

                    <form class="credit-card payment-tab" action="#" data-payment-tab="card">

                        <div class="cardholder-name">
                            <label for="cardholder-name" class="label-default">Cardholder Name</label>
                            <input type="text" class="input-field" required="" placeholder="Cardholder Name" name="cardholder-name">
                        </div>

                        <div class="card-number">
                            <label for="card-number" class="label-default">Card Number</label>
                            <input type="number" class="input-field" required="" placeholder="Card Number" name="card-number">
                        </div>

                        <div class="input-wrapper">

                            <div class="expire-date">
                                <label for="expire-date" class="label-default">Expiration date</label>

                                <div class="input-flex">

                                    <input type="number" required="" min="1" name="day" max="31" placeholder="31" class="input-field">
                                    /
                                    <input type="number" required="" min="1" name="month" max="12" placeholder="12" class="input-field">

                                </div>
                            </div>

                            <div class="cvv">
                                <label for="cvv" class="label-default">CVV</label>
                                <input type="number" required="" name="cvv" class="input-field">
                            </div>
                        </div>
                    </form>
                    <form action="{{ route('index') }}" method="POST" class="COD payment-tab" data-payment-tab="COD">
                        @csrf <!-- CSRF protection -->

                        <div class="address">
                            <label for="address" class="label-default">Address</label>
                            <input type="text" class="input-field" required placeholder="Address" name="address">
                        </div>

                        <div class="phone">
                            <label for="phone" class="label-default">Phone Number</label>
                            <input type="number" class="input-field" required placeholder="Phone Number" name="phone">
                        </div>

                        <div class="content">
                            <label for="content" class="label-default">Content</label>
                            <input type="text" class="input-field" required placeholder="Content" name="content">
                        </div>

                        <!-- Hidden field for discount token -->
                        <input type="hidden" id="discount-token-hidden" name="discount_token" value="">

                        <!-- Calculate total price from the cart data in the session -->
                        <input type="hidden" name="priceTotal" value="{{ number_format(array_sum(array_map(function($product) { 
        return $product['price'] * $product['quantity']; 
    }, session('cart', []))), 2) }}">

                        <button type="submit" class="btn btn-fill">
                            <span class="pay-amount">Submit</span>
                        </button>
                    </form>




                </div>
            </div>

        </div>

    </div>
</section>

@endsection

@section('script')
<script>
    document.querySelectorAll('.quantity-btn').forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.dataset.id;
            const action = this.classList.contains('increase') ? 1 : -1;
            const quantityElement = document.getElementById(`quantity-${productId}`);
            let newQuantity = parseInt(quantityElement.innerText) + action;

            if (newQuantity >= 0) {
                fetch('/cart/update-quantity', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({
                            id: productId,
                            quantity: newQuantity
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            console.log(data);
                            const total_sub = document.getElementById("total-sub");
                            const subtotal = document.getElementById("total-sub-card");
                            const price = document.getElementById("total-price");

                            subtotal.innerHTML = "$" + data.subtotal.toFixed(2);

                            if (newQuantity === 0) {
                                const productItem = document.querySelector(`.product-item[data-id="${productId}"]`);
                                if (productItem) {
                                    productItem.remove();
                                }


                            } else {
                                quantityElement.innerText = newQuantity;
                                const priceElement = document.querySelector(`.price[data-id="${productId}"]`);
                                priceElement.innerText = (data.cart[productId].price * newQuantity).toFixed(2); // Update the price
                            }

                            const cart_ul = document.getElementById("cart-ul");
                            const total = document.getElementById("total-card");


                            total.innerHTML = data.totalQuantity;


                            let cartHTML = '';

                            Object.keys(data.cart).forEach(function(key) {
                                const element = data.cart[key];


                                cartHTML += `
                <li class="panel-item">
                    <a href="http://foodorder.com/product_details/${key}" class="panel-card">
                        <figure class="item-banner">
                            <img src="${element.image}" width="46" height="46" loading="lazy" alt="${element.name}">
                        </figure>
                        <div>
                            <p class="item-title">${element.name}</p>
                            <span class="item-value">${(element.price * element.quantity).toFixed(2)}$</span>
                            <span class="item-amount">x${element.quantity}</span>
                        </div>
                    </a>
                </li>
            `;
                            });


                            cart_ul.innerHTML = '';


                            cart_ul.innerHTML = cartHTML;
                            total_sub.innerHTML = "$" + data.subtotal.toFixed(2);
                            total.innerHTML = data.totalProducts;
                            price.innerHTML = "$" + (data.subtotal + 2.05).toFixed(2);

                        } else {
                            alert('Failed to update cart');
                        }
                    })
                    .catch(error => console.error('Error:', error)); // Handle errors
            }
        });
    });


    $(document).ready(function() {
        $('#apply-discount').on('click', function() {
            var discountToken = $('#discount-token').val();
            if (discountToken) {

                $.ajax({
                    url: "{{ route('apply_discount') }}",
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        discount_token: discountToken
                    },
                    success: function(response) {
                        if (response.success) {

                            // Update the price in the UI
                            $('#total-sub-card').text('$' + response.new_subtotal);
                            $('#total-price').text('$' + response.new_total);

                            // Set the hidden input for discount token before form submission
                            $('#discount-token-hidden').val(discountToken);

                            alert('Áp dụng thành công voucher!');
                        } else {
                            alert('Voucher không tồn tại!');
                        }
                    },
                    error: function() {
                        alert('Lỗi khi sử dụng voucher.');
                    }
                });
            } else {
                alert('Vui lòng nhập voucher.');
            }
        });
    });


    document.getElementById('payment-form').submit();
</script>

@endsection