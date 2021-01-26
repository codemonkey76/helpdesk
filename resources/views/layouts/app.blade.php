<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="login-status" content="{{ Auth::check() }}">
    @auth
        <meta name="user-name" content="{{ Auth::user()->name }}">
        <meta name="user-id" content="{{ Auth::user()->id }}">
        <script>
            window.Laravel = <?php echo json_encode([
                'api_token' => Auth::user()->api_token,
                'user_id' => Auth::user()->id,
            ]); ?>

        </script>
    @endauth

    <title>{{ config('app.name') }}</title>

    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link href="{{ mix('css/custom.css') }}" rel="stylesheet">
    <link href="https://rsms.me/inter/inter.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/vue-multiselect@2.1.0/dist/vue-multiselect.min.css">
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>
<body class="bg-gray-900 h-screen antialiased leading-none">
<div id="app" class="h-full flex flex-col">
    @yield('content')
</div>
</body>
</html>
