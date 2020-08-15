<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('layouts.header._meta')
    @include('layouts.header._assets')
</head>
<body>
    <!-- For change backgroung image, go to styles. -->
    <header id="headerInicio" class="site-header inicio">
        @include('layouts.header._header')
    </header>
    @yield('content')
    <footer class="site-footer seccion">
        @include('layouts.footer._footer')
    </footer>
</body>
</html>
