<!-- resources/views/partials/navbar.blade.php -->
<nav class="navbar navbar-expand-lg navbar-dark bg-custom-green shadow-sm py-3 navbar-custom">
    <div class="container">
        <!-- Left Nav Items -->
        <div class="navbar-nav me-auto">
            <a class="nav-link" href="{{ url('/') }}">Home</a>
            <a class="nav-link mx-lg-3 mx-2" href="{{ url('/eatery') }}">Eatery</a> 
            <a class="nav-link" href="{{ url('/orderuser') }}">Order</a>      
        </div>

        <!-- Center Section: Logo -->
        <a class="navbar-brand mx-auto" href="{{ url('/') }}">
            <img src="{{ asset('img/logo lastbite putih 1.png') }}" alt="LastBite Logo">
        </a>

        <!-- Right Section: Auth Links (Statis karena belum ada sistem Auth) -->
        <div class="navbar-nav ms-auto">
            <a class="nav-link me-2 me-sm-3" href="{{ url('/login-placeholder') }}">Login</a> 
            <a href="{{ url('/register-restaurant-placeholder') }}" class="btn btn-sm btn-signup rounded-md fw-medium text-nowrap">Restaurant Sign Up</a> 

            
            
        </div>
    </div>
</nav>