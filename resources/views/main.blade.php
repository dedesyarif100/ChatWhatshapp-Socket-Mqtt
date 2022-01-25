<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="index, nofollow">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>srtdash - ICO Dashboard</title>

    {{-- <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" /> --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('css/template.css') }}">
    @yield('css')
</head>

<body>
    <audio id="myAudio" controls hidden>
        {{-- <source src="{{ asset('assets/audio/web_whatsapp.mp3') }}" type="audio/ogg"> --}}
        <source src="{{ asset('assets/audio/web_whatsapp.mp3') }}" type="audio/mpeg">
    </audio>
    @yield('content')
    {{-- <script src="{{ asset('assets/js/jquery-1.10.2.min.js') }}"></script> --}}
    <script src="{{ asset('js/template.js') }}"></script>
    @yield('js')
</body>
</html>
