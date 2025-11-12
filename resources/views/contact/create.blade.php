@extends('layouts.app')
@section('content')
    <div class="container">
    <h1>Новый клиент</h1>
    <form action="{{route('contact.store')}}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="first_name">Имя</label>
            <input type="text" name="first_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="last_name">Фамилия</label>
            <input type="text" name="last_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control">
        </div>

        <div class="mb-3">
            <label for="phone">Телефон</label>
            <input type="text" name="phone" class="form-control">
        </div>

        <div class="mb-3">
            <label for="company">Компания</label>
            <input type="text" name="company" class="form-control">
        </div>

        <div class="mb-3">
            <label for="note">Заметка</label>
            <textarea name="note" class="form-control" rows="3"></textarea>
        </div>

        <button type="submit" class="btn btn-success">Сохранить</button>
        <a href="{{ route('contact.index') }}">Назад</a>
    </form>
    </div>
@endsection
