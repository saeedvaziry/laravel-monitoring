<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="noindex, nofollow">
    <title>{{ __('Monitoring') }}</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="{{ asset(mix('css/app.css', 'vendor/monitoring')) }}" rel="stylesheet" type="text/css">
    <script>
        window.app = {
            prefix: '{{ config('monitoring.routes.prefix') }}'
        }
    </script>
</head>
<body class="bg-gray-100 dark:bg-gray-900 min-h-screen text-gray-700 min-w-max">
    <div id="app" class="min-h-screen">
        <app></app>
    </div>
    <script src="{{ asset(mix('js/app.js', 'vendor/monitoring')) }}"></script>
</body>
</html>
