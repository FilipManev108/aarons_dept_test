<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://kit.fontawesome.com/396a695174.js" crossorigin="anonymous"></script>
    <title>@yield('title' , 'Aaron\'s Dept Test')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @vite(['resources/js/app.js'])
</head>
<body>
@include('layouts.partials._nav')

<div class="container px-5">
    @yield('content')
</div>

</body>
</html>
