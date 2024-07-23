<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Area Management</title>
    @vite('resources/css/app.css')
    @livewireStyles
</head>
<body>
<div class="min-h-screen bg-gray-100">
    <div class="container mx-auto p-6">
        @yield('content')
    </div>

</div>
@livewireScripts
</body>
</html>
