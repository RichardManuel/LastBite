<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign In | LastBite</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> <!-- Bootstrap or your custom CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .signin-container {
            min-height: 100vh;
            display: flex;
        }
        .signin-left {
            flex: 1;
            background: url('/images/PolloBruto.png') no-repeat center center;
            background-size: cover;
        }
        .signin-right {
            flex: 1;
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .mt-3{
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="signin-container">
        <div class="signin-left"></div>
        <div class="signin-right">
            <h1 class="display-4">My Eatery</h1>
            <h3 class="text-warning mt-2">Sign in</h3>
            <p class="mt-3">
                Let’s Get in Touch! 🤝 <br>
                Whether you need a daily surprise bag or a bulk order for your restaurant,<br>
                we’re ready to support your culinary journey.
            </p>

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group mt-3">
                    <input type="email" class="form-control" name="email" placeholder="Email" required autofocus>
                </div>
                <div class="form-group mt-2">
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                    <small class="text-muted float-right mt-1">
                        <a href="#">Forget password?</a>
                    </small>
                </div>
                <button type="submit" class="btn btn-warning w-100 mt-3">Let’s start!</button>
            </form>

            <div class="mt-3 text-center">
                <button class="btn btn-light border"><i class="fab fa-facebook"></i></button>
                <button class="btn btn-light border"><i class="fab fa-google"></i></button>
            </div>

            <div class="mt-4 text-center">
                Don’t have an account?
                {{-- <a href="{{ route('register') }}">Sign up</a> --}}
            </div>
        </div>
    </div>
</body>
</html>
