<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers.">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="{{ asset('dashboard_asset') }}/images/favicon.png">
    <!-- Page Title  -->
    <title>{{ env('APP_NAME') }} | Login</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="{{ asset('dashboard_asset') }}/assets/css/dashlite.css?ver=2.9.0">
    <link id="skin-default" rel="stylesheet" href="{{ asset('dashboard_asset') }}/assets/css/theme.css?ver=2.9.0">
</head>

<body class="nk-body bg-white npc-general pg-auth">


@yield('auth_content')




<!-- JavaScript -->
<script src="{{ asset('dashboard_asset') }}/assets/js/bundle.js?ver=2.9.0"></script>
<script src="{{ asset('dashboard_asset') }}/assets/js/scripts.js?ver=2.9.0"></script>
</body>
</html>    