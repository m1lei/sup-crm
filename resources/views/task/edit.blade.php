@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Редактировать задачу: {{$task->title}}</h1>

        <form action="{{route('task.update', $task->id)}}" method="POST">
            @csrf
            @method("PUT")
            <input type="hidden" name="deal_id" value="{{$task->deal_id}}">

            <div class="mb-3">
                <label for="title">Название</label>
                <input id="title" name="title" value="{{old('title',$task->title)}}">
            </div>

            <div class="md-3">
                <label for="deadline_at">Закончить до</label>
                <input type="date" id="deadline_at" name="deadline_at" value="{{old('deadline_at',$task->deadline_at)}}">
            </div>

            <div class="md-3">
                <label for="status">Статус</label>
                <select class="form-select" id="status" name="status">
                    <option value="open">Открыто</option>
                    <option value="done">Закрыто</option>
                </select>
            </div>
                <button class="btn-primary" type="submit">Сохранить</button>
        </form>
        <a href="{{ route('deal.show', $task->deal_id) }}" class="btn btn-secondary">Отменить</a>
    </div>
@endsection
