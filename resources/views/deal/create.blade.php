@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Новая сделка</h1>

        <form action="{{ route('deal.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label">Название сделки</label>
                <input type="text" name="title" id="title"
                       class="form-control"
                       value="{{ old('title') }}" required>
            </div>

            <div class="mb-3">
                <label for="contact_id" class="form-label">Клиент</label>
                <select name="contact_id" id="contact_id" class="form-select" required>
                    <option value="">Выберите клиента</option>
                    @foreach($contacts as $contact)
                        <option value="{{ $contact->id }}"
                            {{ old('contact_id') == $contact->id ? 'selected' : '' }}>
                            {{ $contact->first_name }} {{ $contact->last_name }} ({{ $contact->company }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Статус</label>
                <select name="status" id="status" class="form-select">
                    <option value="New" {{ old('status') == 'New' ? 'selected' : '' }}>Новая</option>
                    <option value="Todo" {{ old('status') == 'Todo' ? 'selected' : '' }}>В работе</option>
                    <option value="in_progress" {{ old('status') == 'in_progress' ? 'selected' : '' }}>В процессе</option>
                    <option value="Done" {{ old('status') == 'Done' ? 'selected' : '' }}>Завершена</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="amount" class="form-label">Сумма</label>
                <input type="number" step="0.01" name="amount" id="amount"
                       class="form-control"
                       value="{{ old('amount') }}">
            </div>

            <div class="mb-3">
                <label for="deadline_at" class="form-label">Закончить до</label>
                <input type="date" name="deadline_at" id="deadline_at"
                       class="form-control"
                       value="{{ old('deadline_at') }}">
            </div>

            <button type="submit" class="btn btn-primary">Сохранить</button>
            <a href="{{ route('deal.index') }}" class="btn btn-secondary">Отмена</a>
        </form>
    </div>
@endsection
