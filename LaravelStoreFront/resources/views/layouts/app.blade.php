<!DOCTYPE html>
<html lang="en">
<link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title class=".uppercase font-bold">{{ config('app.name') }} - @yield('title', 'Store')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

    <nav>
        <a class="text-xl font bold" href="{{ route('products.index') }}">Shop</a>
    </nav>

    <main class="container mx-auto py-4">
        @yield('content')
    </main>

    <footer>
        <p>&copy; {{ date('Y') }} {{ config('app.name') }}</p>
    </footer>

</body>
</html>
