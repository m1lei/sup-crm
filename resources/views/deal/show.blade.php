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

    <div class="contain-inline-size">
        @if ($errors->any())
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
    <h2>Активности</h2>

    @if($deal->activities->isEmpty())
        <p>Пока нет активностей.</p>
    @else
        <ul class="list-group mb-3">
            @foreach($deal->activities as $activity)
                <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div>
                        <strong>
                            @switch($activity->type)
                                @case('call') Звонок @break
                                @case('email') Письмо @break
                                @case('meeting') Встреча @break
                                @case('note') Заметка @break
                            @endswitch
                        </strong>
                        @if($activity->note)
                            <div>{{ $activity->note }}</div>
                        @endif
                    </div>

                    <div class="ms-3">
                        <a href="{{ route('activity.edit', $activity) }}" class="btn btn-sm btn-outline-primary">
                            Редактировать
                        </a>

                        <form action="{{ route('activity.destroy', $activity) }}"
                              method="POST" class="d-inline"
                              onsubmit="return confirm('Удалить активность?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">Удалить</button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    @endif
    <div class="container">
        <h1>Просмотреть задачи</h1>
        <ul>
            @if($deal->tasks->isEmpty())
                <p>Пока нет Задач.</p>
            @else
                @foreach($deal->tasks as $t)
                    <li>
                        <div>
                            @switch($t->status)
                                    @case('open') Открыта @break
                                    @case('done') закрыта @break
                            @endswitch
                            @if($t->title)
                                <div>{{$t->title}}</div>
                            @endif
                            <div>
                                До {{$t->deadline_at}}
                            </div>
                        </div>
                        <a class="btn btn-primary" href="{{route('task.edit', $t->id)}}">Редактировать</a>
                    </li>
                @endforeach
            @endif
        </ul>
    </div>
    <h3>Добавить активность</h3>

    <form action="{{ route('activity.store') }}" method="POST">
        @csrf
        <input type="hidden" name="deal_id" value="{{ $deal->id }}">

        <div class="mb-3">
            <label for="type" class="form-label">Тип</label>
            <select name="type" id="type" class="form-select" required>
                <option value="call">Звонок</option>
                <option value="email">Письмо</option>
                <option value="meeting">Встреча</option>
                <option value="note">Заметка</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="note" class="form-label">Комментарий</label>
            <textarea name="note" id="note" rows="3" class="form-control">{{ old('note') }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Сохранить активность</button>
    </form>

    <div class="container">
        <h1>Создать задачу</h1>

        <form action="{{route('task.store')}}" method="POST">
            @csrf
            <input type="hidden" name="deal_id" value="{{ $deal->id }}">
        <div class="mb-3">
            <label for="title">Описание</label>
            <textarea class="form-textarea" name="title" id="title"></textarea>
        </div>
        <div class="mb-3">
            <label for="deadline">Закончить до</label>
            <input type="date" name="deadline_at" class="form-input" id="deadline">
        </div>
        <div class="mb-3">
            <label for="status">Статус</label>
            <select class="form-select" name="status" id="status">
                <option value="open">Открыта</option>
                <option value="done">Завершина</option>
            </select>
        </div>
            <button type="submit" class="btn btn-primary">Сохранить задачу</button>
        </form>
    </div>

@endsection
