@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Редактировать контакт: {{ $contact->first_name }}</h1>
    <form action="{{route('contact.update',$contact->id )}}" method="POST">
        @csrf
        @method("PUT")
        <div class="mb-3">
            <label for="first_name" class="form-label">Имя</label>
            <input id="first_name" type="text" name="first_name" class="form-control"
                   value="{{ old('first_name', $contact->first_name) }}" required>
        </div>

        <div class="md-3">
            <label for="last_name">Фамелия</label>
            <input id="last_name" type="text" name="last_name" class="form-control"
            value="{{old('last_name', $contact->last_name)}}" required>
        </div>

        <div class="md-3">
            <label for="email" class="form-label">Email</label>
            <input id="email" type="text" name="email" class="form-control"
            value="{{old('email', $contact->email)}}" required>
        </div>

        <div class="md-3">
            <label for="phone">phone</label>
            <input id="phone" type="number" name="phone" class="form-control"
            value="{{old('email', $contact->phone)}}" required>
        </div>

        <div class="md-3">
            <label for="company">company</label>
            <input id="company" type="text" name="company" class="form-control"
            value="{{old('email', $contact->company)}}" required>
        </div>

        <div class="md-3">
            <label for="note">описание</label>
            <textarea id="note" name="note" class="form-control" rows="3">{{ old('note', $contact->note) }}</textarea>
        </div>
        <button type="submit" class="btn btn-success mt-3">Редактировать</button>

        <a class="btn btn-secondary mt-3" href="{{ route('contact.index') }}">Вернуться к списку</a>
    </form>
        <form action="{{ route('contact.destroy', $contact) }}" method="POST">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger mt-3" onclick="return confirm('Удалить контакт?')">
                Удалить
            </button>
        </form>
    </div>
@endsection
