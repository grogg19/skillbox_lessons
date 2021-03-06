<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{--    <link rel="icon" href="/docs/4.1/assets/img/favicons/favicon.ico">--}}

    <title>@yield('title', 'Laravel Skillbox')</title>

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/blog.css') }}" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.0.11/css/all.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/animate.css@3.5.1" rel="stylesheet" type="text/css">
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
</head>

<body>

<div class="container" >

    @include('partials/header')

    @include('partials/nav')

</div>

<main role="main" class="container mb-5" id="app">
    <div class="row">
        <div class="col-md-8 blog-main">
            @if (session('status'))
                @include('flash.success')
            @endif
            @yield('content')

        </div><!-- /.blog-main -->

        @include('partials/sidebar')

    </div><!-- /.row -->
    @auth()
    <chat u-id="{{ auth()->user()->id ?? null}}"></chat>
    @endauth
</main><!-- /.container -->

@include('partials/footer')

</body>
</html>
