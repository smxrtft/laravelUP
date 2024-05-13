@extends('layouts.admin')

@section('content')
    <h1>Редактирование объявления</h1>

    <form action="{{ route('admin.advertisements.update', $advertisement->AdID) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="Title">Заголовок</label>
            <input type="text" class="form-control" id="Title" name="Title" value="{{ $advertisement->Title }}">
        </div>
        <div class="form-group">
            <label for="Description">Описание</label>
            <textarea class="form-control" id="Description" name="Description">{{ $advertisement->Description }}</textarea>
        </div>
        <div class="form-group">
            <label for="CategoryID">Категория</label>
            <select class="form-control" id="CategoryID" name="CategoryID">
                @foreach ($categories as $category)
                    <option value="{{ $category->CategoryID }}" {{ $category->CategoryID == $advertisement->CategoryID ? 'selected' : '' }}>
                        {{ $category->CategoryName }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="Status">Статус</label>
            <select class="form-control" id="Status" name="Status">
                <option value="На рассмотрении" {{ $advertisement->Status == 'На рассмотрении' ? 'selected' : '' }}>Ожидает проверки</option>
                <option value="Одобрено" {{ $advertisement->Status == 'Одобрено' ? 'selected' : '' }}>Одобрено</option>
                <option value="Отклонено" {{ $advertisement->Status == 'Отклонено' ? 'selected' : '' }}>Отклонено</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary animate-button">Сохранить</button>
    </form>
@endsection

@section('styles')
    <style>
        /* Добавляем анимацию при наведении на кнопку "Сохранить" */
        .animate-button {
            transition: transform 0.3s ease-in-out;
        }

        .animate-button:hover {
            transform: scale(1.05);
        }
    </style>
@endsection