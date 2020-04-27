<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>@yield('title')</title>
    <meta name="description" content="@yield('description')">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @include('admin.main.stylesheet')

    @section('css')
    @show

</head>
<body class="skin-blue">
    @include('admin.main.header')
    @include('admin.main.sidebar')

    @yield('content')

    @include('admin.main.footer')

    @include('admin.main.scripts')

    @section('scripts')
    @show
</body>
</html>
