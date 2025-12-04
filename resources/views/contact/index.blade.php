@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Контакты</h1>
            <a href="{{ route('contact.create') }}" class="btn btn-primary">Новый контакт</a>
        </div>

        @if($contacts->isEmpty())
            <p class="text-muted">Контактов пока нет.</p>
        @else
            <table class="table table-hover align-middle">
                <thead>
                <tr>
                    <th>Имя</th>
                    <th>Компания</th>
                    <th>Email</th>
                    <th>Телефон</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($contacts as $c)
                    <tr>
                        <td>{{ $c->first_name }} {{ $c->last_name }}</td>
                        <td>{{ $c->company }}</td>
                        <td>{{ $c->email }}</td>
                        <td>{{ $c->phone }}</td>
                        <td class="text-end">
                            <a href="{{ route('contact.show', $c->id) }}" class="btn btn-sm btn-outline-secondary">
                                Открыть
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
