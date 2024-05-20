<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $category->CategoryName }}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }

        .header {
            background-color: #007bff;
            color: white;
            padding: 1rem 0;
        }

        .card-img-top {
            height: 200px;
            /* Фиксированная высота для изображения */
            object-fit: cover;
            /* Масштабирование изображения, чтобы оно полностью заполнило контейнер */
        }

        .card {
            height: 100%;
            /* Карточка должна занимать всю доступную высоту */
        }

        .card-body {
            display: flex;
            flex-direction: column;
        }

        .card-text {
            flex-grow: 1;
            /* Разрешить тексту занимать всю доступную высоту */
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .nav-link {
            color: white !important;
        }

        .nav-link:hover {
            color: #f8f9fa !important;
        }

        .footer {
            background-color: #343a40;
            color: white;
            padding: 1rem 0;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease-in-out;
            margin-bottom: 20px;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.175);
        }

        .card-img-top {
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            height: 200px;
            object-fit: cover;
        }

        .card-body {
            padding: 1.25rem;
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: bold;
        }

        .card-text {
            color: #6c757d;
        }

        .text-muted {
            color: #6c757d !important;
        }

        .btn-danger {
            transition: all 0.3s ease-in-out;
        }

        .btn-danger:hover {
            transform: scale(1.05);
        }

        .container1 {
            margin-bottom: 70px;
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
                        
                        <form class="form-inline my-2 my-lg-0" action="{{ route('search') }}" method="GET">
                            <input class="form-control mr-sm-2" type="search" placeholder="Поиск" aria-label="Поиск" name="query">
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Поиск</button>
                        </form>
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





    @if (Auth::check() && Auth::user()->is_banned)
        <h1 class="text-center" style="margin-top: 50px">Вы забанены!</h1>
    @else
        <div class="container container1 mt-5">
            <h1 class="text-center mb-4">{{ $category->CategoryName }}</h1>

            <div class="row">
                @foreach ($advertisements as $advertisement)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="{{ asset('images/' . $advertisement->AdPhoto) }}" class="card-img-top"
                                alt="{{ $advertisement->Title }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $advertisement->Title }}</h5>
                                <p class="card-text">{{ $advertisement->Description }}</p>
                                <p class="card-text"><small class="text-muted">Автор:
                                        {{ $advertisement->user->Username }}</small></p>
                                <form action="{{ route('advertisements.add-to-cart', $advertisement->AdID) }}"
                                    method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Добавить в корзину</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

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
