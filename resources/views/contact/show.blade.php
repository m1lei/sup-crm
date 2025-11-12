@extends('layouts.app')

@section('content')
    <h1>Детали контакта: {{ $contact->first_name }}</h1>

    <div>
        <p><strong>Имя:</strong> {{ $contact->first_name }}</p>
        <p><strong>Фамилия:</strong> {{ $contact->last_name }}</p>
        <p><strong>Email:</strong> {{ $contact->email }}</p>
        <p><strong>Телефон:</strong> {{ $contact->phone }}</p>
        <p><strong>Компания:</strong> {{ $contact->company }}</p>
        <p><strong>Описание:</strong> {{ $contact->Note }}</p>
    </div>

    <a href="{{ route('contact.index') }}">Вернуться к списку</a>
    <a href="{{ route('contact.edit', $contact->id) }}">Редактировать контакт</a>
@endsection
