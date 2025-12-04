@extends('layouts.app')
@section('content')
    <div class="container">
    <h1 class="mb-4">Новый клиент</h1>
    <form action="{{route('contact.store')}}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="first_name" class="form-label">Имя</label>
            <input id="first_name" type="text" name="first_name" class="form-control" required>
        </div>

            <div class="mb-3">
                <label class="form-label" for="last_name">Фамилия</label>
                <input id="last_name" type="text" name="last_name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input id="email" type="email" name="email" class="form-control">
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Телефон</label>
                <input type="text" id="phone" name="phone" class="form-control">
            </div>

            <div class="mb-3">
                <label for="company" class="form-label">Компания</label>
                <input id="company" type="text" name="company" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label" for="note">Заметка</label>
                <textarea id="note" name="note" class="form-control" rows="3"></textarea>
            </div>

            <button type="submit" class="btn btn-success">Сохранить</button>
            <a class="btn btn-secondary" href="{{ route('contact.index') }}">Назад</a>
        </form>
    </div>
@endsection
