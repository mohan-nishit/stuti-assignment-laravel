<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Photo Share Platform</title>
    @livewireStyles
    @vite('resources/css/app.css')
</head>
<body>
    @yield('content')
    @livewireScripts
    @vite('resources/js/app.js')
</body>
</html>
