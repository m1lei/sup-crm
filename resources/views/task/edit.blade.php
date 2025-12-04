@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Редактировать задачу: {{$task->title}}</h1>

        <form action="{{route('task.update', $task->id)}}" method="POST">
            @csrf
            @method("PUT")
            <input type="hidden" name="deal_id" value="{{$task->deal_id}}">

            <div class="mb-3">
                <label for="title" class="form-label">Название</label>
                <input class="form-control" id="title" name="title" value="{{old('title',$task->title)}}">
            </div>

            <div class="md-3">
                <label for="deadline_at" class="form-label">Закончить до</label>
                <input type="date" id="deadline_at" name="deadline_at"
                       value="{{old('deadline_at', \Carbon\Carbon::parse($task->deadline_at)->format('Y-m-d'))}}"
                       class="form-control">
            </div>

            <div class="md-3">
                <label for="status" class="form-label">Статус</label>
                <select class="form-select" id="status" name="status">
                    <option value="open">Открыто</option>
                    <option value="done">Закрыто</option>
                </select>
            </div>
                <button class="btn btn-primary mt-2" type="submit">Сохранить</button>
            <a href="{{ route('deal.show', $task->deal_id) }}" class="btn btn-secondary mt-2">Отменить</a>
        </form>
    </div>
@endsection
