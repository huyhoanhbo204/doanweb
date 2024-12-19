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
                    <!-- Updated 'onclick' here instead of 'onsubmit' -->
                    <button type="button" class="filter-btn active" value="all" onclick="handleCategoryClick(event)">All</button>
                </li>
                @foreach ($categories as $category)
                <li>
                    <!-- Updated 'onclick' here instead of 'onsubmit' -->
                    <button type="button" class="filter-btn" value="{{ $category->id }}" onclick="handleCategoryClick(event)">{{ $category->name  }}</button>
                </li>
                @endforeach
            </ul>
        </form>

        <!-- Food Menu List -->
        <ul class="food-menu-list" id="productList">
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
        </ul>
    </div>
</section>

<script>
    $(document).ready(function() {
        // Hàm thực hiện tìm kiếm và phân trang
        function fetchProducts(page = 1) {
            // Thu thập dữ liệu từ form
            let category = $('#searchCategory').val();
            let status = $('#searchStatus').val();
            let hot = $('#searchHot').val();
            let name = $('#searchName').val();

            // Gửi AJAX request
            $.ajax({
                url: "{{ route('products.index') }}",
                method: "GET",
                data: {
                    category: category,
                    status: status,
                    hot: hot,
                    name: name,
                    page: page
                },
                success: function(response) {
                    // Cập nhật dữ liệu bảng và phân trang
                    $('#productsTableBody').html(response.html);
                    $('#paginationLinks').html(response.pagination);
                },
                error: function(xhr) {
                    console.error('Có lỗi xảy ra:', xhr.responseText);
                }
            });
        }

        // Sự kiện thay đổi hoặc nhập liệu trên form tìm kiếm
        $('#searchCategory, #searchStatus, #searchHot, #searchName').on('change keyup', function() {
            fetchProducts(); // Gọi tìm kiếm
        });

        // Sự kiện click vào liên kết phân trang
        $(document).on('click', '#paginationLinks a', function(e) {
            e.preventDefault();

            // Lấy số trang từ link phân trang
            let page = $(this).attr('href').split('page=')[1];
            fetchProducts(page); // Gọi lại tìm kiếm với trang mới
        });
    });
</script>