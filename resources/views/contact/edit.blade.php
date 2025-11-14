@extends('layouts.app')

@section('content')
    <h1>Редактировать контакт: {{ $contact->first_name }}</h1>
    <form action="{{route('contact.update',$contact->id )}}" method="POST">
        @csrf
        @method("PUT")
        <div class="mb-3">
            <label for="first_name">Имя</label>
            <input type="text" name="first_name" class="form-control"
                   value="{{ old('first_name', $contact->first_name) }}" required>
            @error('first_name')
            <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="ms-3">
            <label for="last_name">Фамелия</label>
            <input type="text" name="last_name" class="form-input"
            value="{{old('last_name', $contact->last_name)}}" required>
        </div>

        <div class="ms-3">
            <label for="email">Email</label>
            <input type="text" name="email" class="form-input"
            value="{{old('email', $contact->email)}}" required>
        </div>

        <div class="ms-3">
            <label for="phone">phone</label>
            <input type="number" name="phone" class="form-input"
            value="{{old('email', $contact->phone)}}" required>
        </div>

        <div class="ms-3">
            <label for="company">company</label>
            <input type="text" name="company" class="form-input"
            value="{{old('email', $contact->company)}}" required>
        </div>

        <div class="ms-3">
            <label for="note">описание</label>
            <textarea name="note" class="form-textarea" rows="3">{{ old('note', $contact->note) }}</textarea>
        </div>
        <button type="submit">Редактировать</button>
        <form action="{{ route('contact.destroy', $contact) }}" method="POST" style="display:inline">
            @csrf
            @method('DELETE')
            <button class="border-t-neutral-900" onclick="return confirm('Удалить контакт?')">
                Удалить
            </button>
        </form>

        <a href="{{ route('contact.index') }}">Вернуться к списку</a>
    </form>

@endsection
