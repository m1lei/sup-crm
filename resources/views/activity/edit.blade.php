@extends('layouts.app')
@section('content')
    <div class="container">
        <h1 class="mb-4">Редактировать активность</h1>
        <form action="{{route('activity.update',$activity)}}" method="POST">
            @csrf
            @method("PUT")

            <div class="mb-3">
                <label for="type" class="form-label">Тип</label>
                <select name="type" class="form-select" id="type"required>
                    <option value="call" @selected($activity->type == 'call')>Звонок</option>
                    <option value="email" @selected($activity->type == 'email')>email</option>
                    <option value="meeting" @selected($activity->type == 'meeting')>сообщение</option>
                    <option value="note" @selected($activity->type == 'note')>Заметка</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="note" class="form-label">описание</label>
                <textarea class="form-control" rows="3" name="note" id="note">{{old('note',$activity->note)}} </textarea>
            </div>

            <div>
                <label for="happened_at" class="form-label">Когда случилось</label>
                <input name="happened_at" id="happened_at" class="form-control" type="datetime-local" value="{{old('happened_at', $activity->happened_at)}}" >
            </div>
            <button type="submit" class="btn btn-primary mt-3">Сохранить изменениея</button>
            <a href="{{ route('deal.show', $activity->deal_id) }}" class="btn btn-secondary mt-3">Назад</a>
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
