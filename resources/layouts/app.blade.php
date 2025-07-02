<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Eatery</title>

    {{-- Bootstrap CSS CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Font Awesome for social icons --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    {{-- Optional custom styling --}}
    <style>
        body {
            background-color: #1e1e1e;
            color: #333;
        }

        .navbar {
            background-color: #f3b000;
        }

        .navbar-brand, .nav-link {
            color: white !important;
            font-weight: bold;
        }

        .navbar .nav-link:hover {
            color: #eee !important;
        }
    </style>
</head>
<body>

    {{-- Navigation Bar --}}
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">🍽 Last Bite</a>
            <div class="ms-auto d-flex gap-3">
                <a class="nav-link" href="#">Order</a>
                <a class="nav-link" href="#">Stocks</a>
                <a class="nav-link" href="#">Profile</a>
            </div>
        </div>
    </nav>

    {{-- Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Bootstrap JS CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
