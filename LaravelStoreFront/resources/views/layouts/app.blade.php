<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} - @yield('title', 'Store')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
        }
        .navbar {
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.1) !important;
        }
    </style>
</head>
<body>

   <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold" href="/">
            <i class="bi bi-bag-fill me-2"></i>The Mart
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">

            {{-- Left side links --}}
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('products.index') }}">
                        <i class="bi bi-grid me-1"></i>Products
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('categories.index') }}">
                        <i class="bi bi-tag me-1"></i>Categories
                    </a>
                </li>
            </ul>

            {{-- Right side links --}}
            <ul class="navbar-nav ms-auto align-items-center gap-2">

                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Log In</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-primary btn-sm" href="{{ route('register') }}">Register</a>
                    </li>
                @endguest

                @auth
                    @can('admin')
                        <li class="nav-item">
                            <a class="btn btn-success btn-sm" href="{{ route('products.create') }}">
                                <i class="bi bi-plus-circle me-1"></i>Add Product
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-success btn-sm" href="{{ route('categories.create') }}">
                                <i class="bi bi-plus-circle me-1"></i>Add Category
                            </a>
                        </li>
                    @endcan

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('products.cart') }}">
                            <i class="bi bi-cart3 fs-5"></i>
                            <span class="badge bg-primary rounded-pill">
                                {{ \App\Models\CartItem::where('user_id', Auth::id())->sum('quantity') }}
                            </span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <span class="nav-link text-white-50">
                            <i class="bi bi-person-circle me-1"></i>{{ Auth::user()->name }}
                        </span>
                    </li>

                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-outline-light btn-sm">
                                <i class="bi bi-box-arrow-right me-1"></i>Logout
                            </button>
                        </form>
                    </li>
                @endauth

            </ul>
        </div>
    </div>
</nav>

    <main class="container mx-auto py-4">
        @yield('content')
    </main>

    <footer class="bg-dark text-white text-center py-3 mt-5">
        <p class="mb-0">© {{ date('Y') }} The Mart. All rights reserved.</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
