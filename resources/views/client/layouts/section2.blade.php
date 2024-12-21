<section class="section section-divider cta" style="background-image:    url('{{ asset('client/assets/images/hero-bg.jpg') }}');">
    <div class="container">
        <div class="cta-content">
            <h2 class="section-title h2">
                The MeatEater Have Excellent Of <span class="span">Quality Burgers!</span>
            </h2>
            <p class="section-text">
                Satisfy your hunger at Da Nang's favorite fast food spot! From crispy fries to juicy burgers, we’ve got all your cravings covered. Fast, delicious, and served hot—order now for a tasty experience you won’t forget!
            </p>
            <a href="{{route('product')}}" class="btn btn-fill">Order Now</a>
        </div>
        <figure class="cta-banner">
            <img src="{{ asset('client/assets/images/cta-banner.png') }}" width="700"
                height="637" loading="lazy" alt="" class="w-100 cta-img">
            <img src="{{ asset('client/assets/images/sale-shape.png') }}" width="216"
                height="226" loading="lazy" alt="" class="abs-img scale-up-anim">
        </figure>
    </div>
</section>
<section class="section section-divider gray delivery">
    <div class="container">
        <div class="delivery-content">

            <h2 class="h2 section-title">A Moments Of Delivered On Right Time & Place</h2>

            <p class="section-text">Satisfy your hunger at Da Nang's favorite fast food spot! From crispy fries to juicy burgers, we’ve got all your cravings covered. Fast, delicious, and served hot—order now for a tasty experience you won’t forget!</p>

            <a href="{{route('product')}}" class="btn btn-fill">Order Now</a>

        </div>

        <figure class="delivery-banner">
            <img src=" {{ asset('client/assets/images/delivery-banner-bg.png') }}"
                class="w-100" width="700" height="602" alt="Clouds"
                loading="lazy">
            <img src="{{ asset('client/assets/images/delivery-boy.svg') }}"
                width="1000" height="880" alt="" class="w-100 delivery-img"
                loading="lazy" data-delivery-boy>
        </figure>
    </div>
</section>

<!-- 
            - #BANNER
            -->

<section class="seciton section-divider gray banner">
    <div class="container">
        <ul class="banner-list">
            @foreach ($banners as $banner)
            <li class="banner-item {{ $loop->first ? 'banner-lg' : ($loop->last ? 'banner-md' : 'banner-sm') }}">
                <div class="banner-card">
                    <img src="{{ asset('storage/banners/' . $banner->img) }}" width="550" height="450"
                        loading="lazy" alt="{{ $banner->title }}" class="banner-img">

                    <div class="banner-item-content">
                        <p class="banner-subtitle">{{ $banner->banner_subtitle }}</p>
                        <h3 class="banner-title">{{ $banner->banner_title }}</h3>
                        <p class="banner-text">{{ $banner->banner_text }}</p>
                        <a href="{{route('product')}}" class="btn btn-fill">Order Now</a>
                    </div>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
</section>