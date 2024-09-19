<!doctype html>
<html lang="ru">
<head>
    @include('includes.head')
</head>
<body>
        @csrf

        <main class="content">

            @yield('content')

            @include('includes.footer')

        </main>


        @include ('includes.scripts')

        @yield('custom_script')

</body>
</html>
