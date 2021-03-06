<!doctype html>
<html lang="en" class="h-100">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>
        @yield('title', 'Infocast')
    </title>
    {{--<script src="https://use.typekit.net/icq2ocy.js"></script>--}}
    {{--<script>try{Typekit.load({ async: true });}catch(e){}</script>--}}
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ mix('css/fapp.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('head')
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/manifest.json">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="theme-color" content="#183242">
    <meta name="google-site-verification" content="4OI-IBz6j8j9B5HFd-7W7EShMDN_I1HJ7y5rKog9ciU" />
</head>
<body  class="{{ $pageName ?? '' }} flex flex-column reg-type min-h-100 col-p">
<!--[if lte IE 9]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
<![endif]-->
<div id="app" class="flex-auto">

    @yield('content')
</div>
@include('front.partials.footer')
@include('front.partials.navbar')



<script src="{{ mix('js/front.js') }}"></script>
@yield('bodyscripts')
<script>
    window.ga=function(){ga.q.push(arguments)};ga.q=[];ga.l=+new Date;
    ga('create','{{ config('services.google.analytics_id') }}','auto');ga('send','pageview')
</script>
<script src="https://www.google-analytics.com/analytics.js" async defer></script>

@yield('json-schema')

</body>
</html>