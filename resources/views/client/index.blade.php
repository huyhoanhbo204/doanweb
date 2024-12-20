<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MEATEATER</title>
    @include('client.layouts.css')
    <meta name="csrf-token" content="{{ csrf_token() }}">

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

            <!-- #FOOD MENU -->
            @yield('content')

            <!-- #DELIVERY -->
            
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
    @yield('script')
  
</body>

</html>