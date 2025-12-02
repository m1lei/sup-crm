@extends('layouts.app')

@section('content')
    <h1>Детали сделки: {{ $deal->title }}</h1>

    <div>
        <p><strong>Наввание:</strong> {{ $deal->title }}</p>
        <p><strong>Статус:</strong> {{ $deal->status }}</p>
        <p><strong>цена:</strong> {{ $deal->amount }}</p>
        <p><strong>Закончить до:</strong> {{ $deal->deadline_at }}</p>
        <p><strong>Ответственный:</strong> {{ $deal->user_id }}</p>
        <p><strong>Клиент:</strong> <a href="{{ route('contact.show', $deal->contact_id) }}">Клиент</a></p>
    </div>

    <a href="{{ route('deal.index') }}">Вернуться к списку</a>
    <a href="{{ route('deal.edit', $deal->id) }}">Редактировать сделку</a>
@endsection
