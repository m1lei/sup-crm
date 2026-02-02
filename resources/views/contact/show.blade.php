@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-3">
            {{ $contact->first_name }} {{ $contact->last_name }}
        </h1>

        <div class="row">
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-header">Информация</div>
                    <div class="card-body">
                        <p><strong>Компания:</strong> {{ $contact->company }}</p>
                        <p><strong>Email:</strong> {{ $contact->email }}</p>
                        <p><strong>Телефон:</strong> {{ $contact->phone }}</p>
                        <p><strong>Комментарий:</strong><br>{{ $contact->note }}</p>
                    </div>
                </div>

                <a href="{{ route('contact.edit', $contact) }}" class="btn btn-primary mb-2">Редактировать</a>
                <a href="{{ route('contact.index') }}" class="btn btn-secondary mb-2">К списку контактов</a>
            </div>

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Сделки клиента</div>
                    <div class="card-body">
                        @if($contact->deals->isEmpty())
                            <p class="text-muted">Сделок пока нет.</p>
                        @else
                            <ul class="list-group">
                                @foreach($contact->deals as $deal)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <strong>{{ $deal->title }}</strong><br>
                                            <small>Сумма: {{ $deal->amount ?? '—' }}</small>
                                        </div>
                                        <a href="{{ route('deal.show', $deal) }}" class="btn btn-sm btn-outline-secondary">
                                            Открыть сделку
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
            <x-widgets.activity-widgets :subject="$contact"/>
            <x-widgets.quick-action-activity :sudject="$contact"/>
        </div>
    </div>
@endsection
