@extends('layouts.app')

@section('content')
    <h1 class="mb-3">Сделка: {{ $deal->title }}</h1>

    <div class="row">
        {{-- ЛЕВАЯ КОЛОНКА: свойства сделки и клиента --}}
        <div class="col-md-4 mb-4">
            <div class="card mb-3">
                <div class="card-header">Информация о сделке</div>
                <div class="card-body">
                    <p><strong>Статус:</strong> {{ $deal->status }}</p>
                    <p><strong>Сумма:</strong> {{ $deal->amount ?? '—' }}</p>
                    <p><strong>Закончить до:</strong> {{ $deal->deadline_at ?? '—' }}</p>
                    <p><strong>Ответственный (user_id):</strong> {{ $deal->user->name}}</p>
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-header">Клиент</div>
                <div class="card-body">
                    @if($deal->contact)
                        <p>{{ $deal->contact->first_name }} {{ $deal->contact->last_name }}</p>
                        <p>{{ $deal->contact->company }}</p>
                        <p>{{ $deal->contact->email }}</p>
                        <p>{{ $deal->contact->phone }}</p>
                        <a href="{{ route('contact.show', $deal->contact_id) }}" class="btn btn-sm btn-outline-primary">
                            Открыть карточку клиента
                        </a>
                    @else
                        <p>Клиент не привязан</p>
                    @endif
                </div>
            </div>

            <a href="{{ route('deal.index') }}" class="btn btn-secondary mb-2">← К списку сделок</a>
            <a href="{{ route('deal.edit', $deal->id) }}" class="btn btn-primary mb-2">Редактировать сделку</a>
        </div>

        {{-- ПРАВАЯ КОЛОНКА: задачи + создание задач --}}
        <div class="col-md-8 mb-4">
            {{-- Задачи по сделке --}}
            <div class="card mb-3">
                <x-widgets.task-widgets :deal="$deal"/>
            </div>

            {{-- Форма создания новой задачи --}}
            <x-widgets.quick-action-task-create :deal="$deal"/>
        </div>
    </div>

    {{-- TIMELINE АКТИВНОСТЕЙ --}}
    <div class="card">
        <div class="card-header">История активности</div>
        <div class="card-body">
            {{-- Форма создания активности --}}
            <x-widgets.quick-action-activity :sudject="$deal"/>

            {{-- Список активностей (timeline) --}}
            <x-widgets.activity-widgets :subject="$deal"/>
    </div>
@endsection
