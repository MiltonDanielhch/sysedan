<!DOCTYPE html>
<html lang="es">
<head>
    @include('frontend.partials.head')
</head>
<body class="body">
    <div id="wrapper">
        <div id="pagee" class="clearfix">
            <header>
                @include('frontend.navigation.header')
            </header>

            @yield('content')

            <!-- Footer -->
            @include('frontend.partials.footer')
            <!-- Footer -->

            @include('frontend.partials.scripts')
        </div>
    </div>
</body>
</html>
