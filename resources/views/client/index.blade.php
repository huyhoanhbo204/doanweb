<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MEATEATER</title>
    @include('client.layouts.css')

    <!-- Add jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>

    <!-- #HEADER -->
    <header class="header" data-header>
        @include('client.layouts.header')
    </header>

    <main>
        <article>
            <!-- #HERO -->
            @include('client.layouts.section')

            <!-- #FOOD MENU -->
            <section class="section food-menu">
                <div class="container">
                    <p class="section-subtitle">Popular Dishes</p>
                    <h2 class="h2 section-title">
                        Our Delicious <span class="span">Foods</span>
                    </h2>
                    <p class="section-text">
                        Fast food refers to quick, inexpensive meals that are typically pre-prepared or easily assembled.
                    </p>

                    <form id="filterForm" method="get" onsubmit="handleFormSubmit(event)">
                        <ul class="filter-list">
                            <li>
                                <button type="button" class="filter-btn active" value="all" onclick="handleCategoryClick(event)">All</button>
                            </li>
                            @foreach ($categories as $category)
                            <li>
                                <button type="button" class="filter-btn " value="{{ $category->id }}" onclick="handleCategoryClick(event)">{{ $category->name }}</button>
                            </li>
                            @endforeach
                        </ul>
                    </form>

                    <!-- Food Menu List -->
                    <ul class="food-menu-list" id="productList">
                        @foreach ($products as $product)
                        <li class="food-menu-card">
                            <div class="card-banner">
                                <img src="{{ asset('storage/' . $product->image) }}" width="300" height="300" loading="lazy" class="w-100" alt="{{ $product->name }}">
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
                    </ul>
                </div>
            </section>

            <!-- #DELIVERY -->
            @include('client.layouts.section2')

            <!-- #FOOTER -->
            <footer class="footer">
                @include('client.layouts.footer')
            </footer>

            <!-- #BACK TO TOP -->
            <a href="#top" class="back-top-btn active" aria-label="Back to top" data-back-top-btn>
                <ion-icon name="chevron-up"></ion-icon>
            </a>
        </article>
    </main>

    <!-- Custom JS link -->
    <script src="{{asset('client/assets/js/script.js')}}"></script>

    <!-- Ionicon Link -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <!-- JavaScript for AJAX -->
    <script>
        function handleCategoryClick(event) {
            event.preventDefault();

            // Remove 'active' class from all category buttons
            $('.filter-btn').removeClass('active');

            // Add 'active' class to the clicked button
            $(event.target).addClass('active');

            // Fetch products for the selected category
            const categoryId = event.target.value;
            fetchProductsByCategory(categoryId);
        }

        function fetchProductsByCategory(categoryId) {
            $.ajax({
                url: '/', // Replace with your route
                type: 'GET',
                data: {
                    categoryId: categoryId
                },
                success: function(response) {
                    $('#productList').empty();
                    response.products.forEach(function(product) {
                        const discountedPrice = product.discount > 0 ?
                            (product.price - (product.price * product.discount / 100)).toFixed(2) :
                            product.price.toFixed(2);
                        const url = "http://foodorder.com/storage/";
                        $('#productList').append(`
                        <li class="food-menu-card">
                            <div class="card-banner">
                                <img src="${url}${product.image}" width="300" height="300" class="w-100" alt="${product.name}">
                                <div class="badge">-${product.discount}%</div>
                                <button class="btn btn-fill food-menu-btn">Order Now</button>
                            </div>
                            <div class="wrapper">
                                <p class="category">${product.category_name}</p>
                                <div class="rating-wrapper">${getStars(product.rating)}</div>
                            </div>
                            <h3 class="h3 card-title">${product.name}</h3>
                            <div class="price-wrapper">
                                <p class="price-text">Price</p>
                                <data class="price">${product.price}$</data>
                                <del class="del">
                                    <span class="discounted-price">${discountedPrice}$</span>
                                </del>
                            </div>
                        </li>
                    `);
                    });
                },
                error: function(xhr, status, error) {
                    alert('Error fetching products: ' + error);
                }
            });
        }
        function getStars(rating) {
            let stars = '';
            for (let i = 0; i < 5; i++) {
                stars += i < rating ?
                    '<ion-icon name="star"></ion-icon>' :
                    '<ion-icon name="star-outline"></ion-icon>';
            }
            return stars;
        }
    </script>

</body>

</html>