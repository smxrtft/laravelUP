<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Админ-панель</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Общие стили */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
        }

        .container1 {
            margin-bottom: 70px;
        }

        .header {
            background-color: #007bff;
            color: #fff;
            padding: 1rem 0;
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .nav-link {
            color: #fff !important;
        }

        .nav-link:hover {
            color: #f8f9fa !important;
        }

        .footer {
            background-color: #343a40;
            color: #fff;
            padding: 1rem 0;
            position: fixed;         
            bottom: 0;
            width: 100%;
        }

        .card {
            border: none;
            border-radius: 0;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            margin-bottom: 20px;
            transition: all 0.3s ease-in-out;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: bold;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
            transition: all 0.3s ease-in-out;
        }

        .btn-success:hover {
            background-color: #218838;
            border-color: #1e7e34;
            transform: scale(1.05);
        }

        .btn-danger {
            transition: all 0.3s ease-in-out;
        }

        .btn-danger:hover {
            transform: scale(1.05);
        }

        /* Стили для мобильных устройств */
        @media (max-width: 767px) {
            .footer {
                position: static;
            }
        }
    </style>
</head>
<body>
    <header class="header">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="d-block mx-auto">
                        <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
                    </svg>
                    neAvito
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Войти</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">Зарегистрироваться</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('home') }}">Главная</a>
                            </li>
                            @if (Auth::user()->Role === 'Администратор')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin.index') }}">Админ панель</a>
                                </li>
                            @endif
                            @if (Auth::check() && !Auth::user()->is_banned)
                                <li class="nav-item">
                                    <a href="{{ route('advertisements.create') }}" class="btn nav-link">Создать
                                        объявление</a>
                                </li>
                            @endif
                            <li class="nav-item">
                                <a href="{{ route('cart.index') }}" class="btn nav-link btn-success">Корзина</a>
                            </li>
                            <li class="nav-item">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-link nav-link btn-danger">Выйти</button>
                                </form>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div class="container container1 mt-5">
        <!-- Здесь должен быть ваш код для контента админ-панели -->
        @yield('content')
    </div>

    <footer class="footer mt-auto py-3">
        <div class="container">
            <p class="text-center mb-0">&copy; 2024 neAvito. Все права защищены.</p>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>