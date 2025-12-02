@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Редактировать контакт: {{ $deal->contact_id }}</h1>
        <form action="{{route('deal.update',$deal->id )}}" method="POST">
            @csrf
            @method("PUT")
            <div class="mb-3">
                <label for="title">название</label>
                <input type="text" name="title" class="form-input"
                       value="{{ old('title', $deal->title) }}" required>
                @error('title')
                <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="status">статус</label>
                <select name="status" id="status" class="form-select">
                    <option value="New"         @selected(old('status', $deal->status) === 'New')>Новая</option>
                    <option value="Todo"        @selected(old('status', $deal->status) === 'Todo')>Todo</option>
                    <option value="in_progress" @selected(old('status', $deal->status) === 'in_progress')>В прогрессе</option>
                    <option value="Done"        @selected(old('status', $deal->status) === 'Done')>Завершена</option>
                </select>
            </div>

            <div class="md-3">
                <label for="amount">цена</label>
                <input type="number" name="amount" class="form-input"
                       value="{{old('amount', $deal->amount)}}" required>
            </div>

            <div class="md-3">
                <label for="deadline-at">закончить до</label>
                <input type="date" name="deadline_at" class="form-input"
                       value="{{old('deadline_at', $deal->deadline_at)}}" required>
            </div>

            <a href="{{ route('deal.index') }}">Вернуться к списку</a>
            <button type="submit">сохранить</button>
        </form>
        <form action="{{ route('deal.destroy', $deal) }}" method="POST">
            @csrf
            @method('DELETE')
            <button class="btn btn-delete" onclick="return confirm('Удалить контакт?')">
                Удалить
            </button>
        </form>
    </div>
@endsection
