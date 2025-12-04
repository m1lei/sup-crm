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
                    <p><strong>Ответственный (user_id):</strong> {{ $deal->user_id }}</p>
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
                <div class="card-header d-flex justify-content-between">
                    <span>Задачи по сделке</span>
                </div>
                <div class="card-body">
                    @forelse($deal->tasks as $task)
                        @php
                            $deadline = \Carbon\Carbon::parse($task->deadline_at);
                            $today = \Carbon\Carbon::today();
                        @endphp

                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div>
                                <strong>{{ $task->title }}</strong><br>
                                    Срок: {{ $deadline->format('d.m.Y') }}

                                    @php
                                        $deadline = \Carbon\Carbon::parse($task->deadline_at);
                                        $today = \Carbon\Carbon::today();

                                        $badgeText = "Без даты";
                                        $badgeClass = "primary";

                                        if ($task->status == "done"){
                                            $badgeClass = "success";
                                            $badgeText = "Выполнено";
                                        } else{
                                            if ($deadline < $today){
                                                $badgeClass = "danger";
                                                $badgeText = "Просроченно";
                                            }elseif ($deadline == $today){
                                                $badgeClass = "warning";
                                                $badgeText = "Сегодня";
                                            }elseif ($deadline > $today){
                                                $badgeClass = "info";
                                                $badgeText = 'Будущее';
                                            };
                                        }@endphp

                                    <span class="badge bg-{{$badgeClass}}">{{$badgeText}}</span>
                            </div>

                            <div>
                                {{-- Быстро отметить как выполненную --}}
                                @if($task->status === 'open')
                                    <form action="{{ route('task.update', $task) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="title" value="{{ $task->title }}">
                                        <input type="hidden" name="deadline_at" value="{{ $task->deadline_at }}">
                                        <input type="hidden" name="status" value="done">
                                        <button class="btn btn-sm btn-outline-success">Готово</button>
                                    </form>
                                @endif

                                {{-- Удалить --}}
                                <form action="{{ route('task.destroy', $task) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('Удалить задачу?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger">✕</button>
                                </form>
                            </div>
                        </div>
                        <hr>
                    @empty
                        <p class="text-muted mb-0">Задач пока нет.</p>
                    @endforelse
                </div>
            </div>

            {{-- Форма создания новой задачи --}}
            <div class="card mb-4">
                <div class="card-header">Создать задачу</div>
                <div class="card-body">
                    <form action="{{ route('task.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="deal_id" value="{{ $deal->id }}">

                        <div class="mb-3">
                            <label for="title" class="form-label">Описание</label>
                            <input type="text" class="form-control" name="title" id="title"
                                   value="{{ old('title') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="deadline_at" class="form-label">Закончить до</label>
                            <input type="date" class="form-control" name="deadline_at" id="deadline_at"
                                   value="{{ old('deadline_at') }}">
                        </div>

                        <input type="hidden" name="status" value="open">

                        <button type="submit" class="btn btn-primary">Сохранить задачу</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- TIMELINE АКТИВНОСТЕЙ --}}
    <div class="card">
        <div class="card-header">История активности</div>
        <div class="card-body">
            {{-- Форма создания активности --}}
            <form action="{{ route('activity.store') }}" method="POST" class="mb-4">
                @csrf
                <input type="hidden" name="deal_id" value="{{ $deal->id }}">

                <div class="row g-2 align-items-end">
                    <div class="col-md-2">
                        <label for="type" class="form-label">Тип</label>
                        <select name="type" id="type" class="form-select" required>
                            <option value="call">Звонок</option>
                            <option value="email">Письмо</option>
                            <option value="meeting">Встреча</option>
                            <option value="note">Заметка</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label for="happened_at" class="form-label">Когда</label>
                        <input type="datetime-local" name="happened_at" id="happened_at"
                               class="form-control"
                               value="{{ now()->format('Y-m-d\TH:i') }}" required>
                    </div>

                    <div class="col-md-5">
                        <label for="note" class="form-label">Комментарий</label>
                        <input type="text" name="note" id="note" class="form-control"
                               value="{{ old('note') }}">
                    </div>

                    <div class="col-md-2">
                        <button type="submit" class="btn btn-success w-100">Добавить</button>
                    </div>
                </div>
            </form>

            {{-- Список активностей (timeline) --}}
            @forelse($deal->activities as $activity)
                <div class="mb-3 pb-3 border-bottom">
                    <div class="d-flex justify-content-between">
                        <div>
                            <span class="badge
                                @if($activity->type === 'call') bg-primary
                                @elseif($activity->type === 'email') bg-info text-dark
                                @elseif($activity->type === 'meeting') bg-warning text-dark
                                @else bg-secondary
                                @endif
                            ">
                                @switch($activity->type)
                                    @case('call') Звонок @break
                                    @case('email') Письмо @break
                                    @case('meeting') Встреча @break
                                    @case('note') Заметка @break
                                @endswitch
                            </span>

                            <strong class="ms-2">
                                {{ optional($activity->happened_at)->format('d.m.Y H:i') }}
                            </strong>

                            @if($activity->user)
                                <span class="text-muted small ms-2">
                                    ({{ $activity->user->name }})
                                </span>
                            @endif
                        </div>

                        <div>
                            <a href="{{ route('activity.edit', $activity) }}"
                               class="btn btn-sm btn-outline-primary">Редактировать</a>

                            <form action="{{ route('activity.destroy', $activity) }}"
                                  method="POST" class="d-inline"
                                  onsubmit="return confirm('Удалить активность?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger">✕</button>
                            </form>
                        </div>
                    </div>

                    @if($activity->note)
                        <div class="mt-2">{{ $activity->note }}</div>
                    @endif
                </div>
            @empty
                <p class="text-muted mb-0">Пока нет активности по сделке.</p>
            @endforelse
        </div>
    </div>
@endsection
