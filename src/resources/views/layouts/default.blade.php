<!doctype html>
<html lang="ru">
<head>
    @include('includes.head')
</head>
<body>
        @csrf
        @include('includes.header')

        <main class="content">

            @yield('content')
        
        </main>
        
        @include('includes.footer')

        @include ('includes.scripts')

        @yield('custom_script')

</body>
</html>
