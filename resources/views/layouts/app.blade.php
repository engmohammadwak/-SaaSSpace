<!DOCTYPE html>
<html lang="en-US" class="lenis" style="scroll-behavior: smooth;">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', $settings['site_name'] ?? 'SaaSSpace') – Global Design Agency</title>
    @if(!empty($settings['favicon']))
    <link rel="icon" type="image/x-icon" href="{{ Storage::url($settings['favicon']) }}">
    @else
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    @endif
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="home" style="overflow-x: hidden;">

    @include('partials.header')

    <main id="content">
        @yield('content')
    </main>

    @include('partials.footer')

    @stack('scripts')
</body>
</html>
