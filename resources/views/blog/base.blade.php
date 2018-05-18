<!DOCTYPE html>
<html lang="zh-CN" class="loading">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="google" content="notranslate"/>
    <title>诸兴天域</title>
    <meta name="keywords" content=""/>
    <meta name="description" content=""/>
    <meta name="author" content="LoeiFy">
    <link rel="apple-touch-icon-precomposed" sizes="144x144"
          href="{{ asset('images/144.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114"
          href="{{ asset('images/114.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72"
          href="{{ asset('images/72.png') }}">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('images/57.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('images/32.png') }}"/>
    <style>
        .image-logo {
            background-image: url( {{ asset('images/logo.png') }})
        }

        body.mu .image-logo {
            background-image: url({{ asset('images/logo_black.png') }})
        }

        .image-icon {
            background-image: url({{ asset('images/logo_min.png') }})
        }
    </style>
    <link rel="stylesheet" href="{{ asset('css/Diaspora.css') }}"/>
</head>
<body class="loading">
<div id="loader"></div>


　　　　@yield("content")

<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/plugin.js') }}"></script>
<script src="{{ asset('js/Diaspora.js') }}"></script>
</body>
</html>

