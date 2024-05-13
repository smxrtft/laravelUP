@extends('layouts.admin')

@section('content')
    <h1>Редактирование пользователя</h1>

    <form action="{{ route('admin.users.update', $user->UserID) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="Username">Имя пользователя</label>
            <input type="text" class="form-control" id="Username" name="Username" value="{{ $user->Username }}">
        </div>
        <div class="form-group">
            <label for="Email">Email</label>
            <input type="email" class="form-control" id="Email" name="Email" value="{{ $user->Email }}">
        </div>
        <div class="form-group">
            <label for="Role">Роль</label>
            <select class="form-control" id="Role" name="Role">
                <option value="Пользователь" {{ $user->Role == 'Пользователь' ? 'selected' : '' }}>Пользователь</option>
                <option value="Администратор" {{ $user->Role == 'Администратор' ? 'selected' : '' }}>Администратор</option>
                <!-- Добавьте другие роли, если они есть -->
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>
@endsection