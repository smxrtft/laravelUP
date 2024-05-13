@extends('layouts.admin')

@section('content')
    <h1>Объявления</h1>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Заголовок</th>
                <th>Описание</th>
                <th>Категория</th>
                <th>Статус</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($advertisements as $advertisement)
                <tr>
                    <td>{{ $advertisement->AdID }}</td>
                    <td>{{ $advertisement->Title }}</td>
                    <td>{{ $advertisement->Description }}</td>
                    <td>{{ $advertisement->category->CategoryName }}</td>
                    <td>{{ $advertisement->Status }}</td>
                    <td>
                        <form action="{{ route('admin.approve', $advertisement->AdID) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-success btn-sm">Одобрить</button>
                        </form>
                        <form action="{{ route('admin.reject', $advertisement->AdID) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-danger btn-sm">Отклонить</button>
                        </form>
                            <a href="{{ route('admin.advertisements.edit', $advertisement->AdID) }}" class="btn btn-primary btn-sm">Редактировать</a>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h1>Список пользователей</h1>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Имя</th>
                <th>Email</th>
                <th>Роль</th>
                <th>Действие</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->UserID }}</td>
                    <td>{{ $user->Username }}</td>
                    <td>{{ $user->Email }}</td>
                    <td>{{ $user->Role }}</td>
                    <td>
                        <a href="{{ route('admin.users.edit', $user->UserID) }}" class="btn btn-primary btn-sm">Редактировать</a>
                    </td>
                    <td>
                        <!-- Добавьте здесь действия для пользователя, если это необходимо -->
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection