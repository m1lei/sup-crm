@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Редактировать активность</h1>
        <form action="{{route('activity.update',$activity)}}" method="POST">
            @csrf
            @method("PUT")

            <div class="mb-3">
                <label for="type">Тип</label>
                <select name="type" class="form-select" required>
                    <option value="call" @selected($activity->type == 'call')>Звонрок</option>
                    <option value="email" @selected($activity->type == 'email')>email</option>
                    <option value="meeting" @selected($activity->type == 'meeting')>сообщение</option>
                    <option value="note" @selected($activity->type == 'note')>Заметка</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="note">описание</label>
                <textarea class="form-textarea" name="note">{{old('note',$activity->note)}} </textarea>
            </div>
            <button type="submit" class="btn btn-primary">Сохранить изменениея</button>
            <a href="{{ route('deal.show', $activity->deal_id) }}" class="btn btn-secondary">Назад</a>
        </form>
        <form action="{{ route('activity.destroy', $activity) }}" method="POST" class="mt-3">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger"
                    onclick="return confirm('Удалить активность?')">
                Удалить
            </button>
        </form>
    </div>
@endsection
