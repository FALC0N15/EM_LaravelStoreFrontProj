<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title class=".uppercase font-bold">{{ config('app.name') }} - @yield('title', 'Store')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <nav>
                <a href="{{ route('products.index') }}" class="btn btn-secondary .text-blue-500">View All Products</a>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary .text-blue-500">View All Categories</a>

        @guest
        <a href="{{route('login')}}" class="btn btn-secondary .text-blue-500">Login</a>
        <a href="{{route('register')}}" class="btn btn-secondary .text-blue-500">Register</a>
        @endguest
        @auth
          @can('admin')
        <a href="{{ route('products.create') }}" class="btn btn-success">Add Product</a>
        <a href="{{ route('categories.create') }}" class="btn btn-success">Add Category</a>
        @endcan
        <a href="{{ route('products.cart') }}" class="btn btn-secondary .text-blue-500">View Cart</a>
        <form method="POST" action="{{ route('logout') }}" style="display: inline;">
            @csrf
            <button type="submit" class="btn btn-secondary .text-blue-500">Logout</button>
        </form>
        @endauth
    </nav>

    <main class="container mx-auto py-4">
        @yield('content')
    </main>

    <footer>
        <p>&copy; {{ date('Y') }} {{ config('app.name') }}</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
