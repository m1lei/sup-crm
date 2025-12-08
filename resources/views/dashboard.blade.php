@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Dashboard</h1>

        <div class="row mb-4">
            {{-- ЛЕВАЯ КОЛОНКА: Задачи --}}
            <div class="col-md-8 mb-3">
                <div class="card">
                    <div class="card-header">
                        Задачи
                    </div>
                    <div class="card-body">
                        {{-- Просроченные --}}
                        <h5 class="card-title text-danger">Просроченные</h5>
                        @forelse($taskOverdue as $task)
                            <div class="mb-2 d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>{{ $task->title }}</strong><br>
                                    <small class="text-muted">
                                        Дедлайн: {{$task->deadline_at}}
                                        @if($task->deal)
                                            • Сделка:
                                            <a href="{{ route('deal.show', $task->deal_id) }}">
                                                {{ $task->deal->title }}
                                            </a>
                                        @endif
                                    </small>
                                </div>
                                <div>
                                    {{-- Быстро отметить выполненной --}}
                                    <form action="{{ route('task.update', $task) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="title" value="{{ $task->title }}">
                                        <input type="hidden" name="deadline_at" value="{{ $task->deadline_at }}">
                                        <input type="hidden" name="status" value="done">
                                        <button class="btn btn-sm btn-outline-success">Готово</button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <p class="text-muted">Просроченных задач нет</p>
                        @endforelse

                        <hr>

                        {{-- На сегодня --}}
                        <h5 class="card-title text-warning">На сегодня</h5>
                        @forelse($taskToday as $task)
                            <div class="mb-2 d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>{{ $task->title }}</strong><br>
                                    <small class="text-muted">
                                        Дедлайн: {{ \Carbon\Carbon::parse($task->deadline_at)->format('d.m.Y') }}
                                        @if($task->deal)
                                            • Сделка:
                                            <a href="{{ route('deal.show', $task->deal_id) }}">
                                                {{ $task->deal->title }}
                                            </a>
                                        @endif
                                    </small>
                                </div>
                                <div>
                                    <form action="{{ route('task.update', $task) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="title" value="{{ $task->title }}">
                                        <input type="hidden" name="deadline_at" value="{{ $task->deadline_at }}">
                                        <input type="hidden" name="status" value="done">
                                        <button class="btn btn-sm btn-outline-success">Готово</button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <p class="text-muted">На сегодня задач нет.</p>
                        @endforelse

                        <hr>

                        {{-- Будущие --}}
                        <h5 class="card-title text-info">Ближайшие задачи</h5>
                        @forelse($taskFuture as $task)
                            <div class="mb-2">
                                <strong>{{ $task->title }}</strong><br>
                                <small class="text-muted">
                                    До: {{ \Carbon\Carbon::parse($task->deadline_at)->format('d.m.Y') }}
                                    @if($task->deal)
                                        • Сделка:
                                        <a href="{{ route('deal.show', $task->deal_id) }}">
                                            {{ $task->deal->title }}
                                        </a>
                                    @endif
                                </small>
                            </div>
                        @empty
                            <p class="text-muted">Нет будущих задач</p>
                        @endforelse

                        <div class="mt-3">
                            <a href="{{ route('task.index') }}" class="btn btn-outline-secondary btn-sm">
                                Перейти ко всем задачам
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ПРАВАЯ КОЛОНКА: Статистика по сделкам --}}
            <div class="col-md-4 mb-3">
                <div class="card mb-3">
                    <div class="card-header">Сделки</div>
                    <div class="card-body">
                        <p><strong>Всего сделок:</strong> {{$dealsTotal }}</p>

                        <ul class="list-unstyled mb-2">
                            <li>
                                <span class="badge bg-primary me-2">&nbsp;</span>
                                Новые: {{ $deals['New'] ?? 0 }}
                            </li>
                            <li>
                                <span class="badge bg-info text-dark me-2">&nbsp;</span>
                                В работе (Todo): {{ $deals['Todo'] ?? 0 }}
                            </li>
                            <li>
                                <span class="badge bg-warning text-dark me-2">&nbsp;</span>
                                В процессе: {{ $deals['in_progress'] ?? 0 }}
                            </li>
                            <li>
                                <span class="badge bg-success me-2">&nbsp;</span>
                                Завершены: {{ $deals['Done'] ?? 0 }}
                            </li>
                        </ul>



                        <a href="{{ route('deal.index') }}" class="btn btn-outline-secondary btn-sm">
                            Открыть список сделок
                        </a>
                    </div>
                </div>

                {{-- Быстрые действия --}}
                <div class="card">
                    <div class="card-header">Быстрые действия</div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <a href="{{ route('deal.create') }}" class="btn btn-primary btn-sm">
                                + Новая сделка
                            </a>
                            <a href="{{ route('contact.create') }}" class="btn btn-outline-primary btn-sm">
                                + Новый контакт
                            </a>
                            <a href="{{ route('task.index') }}" class="btn btn-outline-secondary btn-sm">
                                Открыть задачи
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- НИЖНИЙ БЛОК: Последние активности --}}
        <div class="card">
            <div class="card-header">Последние активности</div>
            <div class="card-body">
                @forelse($recentActivities as $activity)
                    <div class="mb-3 pb-2 border-bottom">
                        <div class="d-flex justify-content-between">
                            <div>
                                @php
                                    $typeLabel = match($activity->type) {
                                        'call' => 'Звонок',
                                        'email' => 'Письмо',
                                        'meeting' => 'Встреча',
                                        'note' => 'Заметка',
                                        default => $activity->type
                                    };
                                @endphp

                                <span class="badge
                                    @if($activity->type === 'call') bg-primary
                                    @elseif($activity->type === 'email') bg-info text-dark
                                    @elseif($activity->type === 'meeting') bg-warning text-dark
                                    @else bg-secondary
                                    @endif
                                ">
                                    {{ $typeLabel }}
                                </span>

                                <strong class="ms-2">
                                    {{ optional($activity->happened_at)->format('d.m.Y H:i') }}
                                </strong>

                                @if($activity->user)
                                    <span class="text-muted small ms-2">
                                        ({{ $activity->user->name }})
                                    </span>
                                @endif

                                @if($activity->deal)
                                    <div class="small mt-1">
                                        Сделка:
                                        <a href="{{ route('deal.show', $activity->deal_id) }}">
                                            {{ $activity->deal->title }}
                                        </a>
                                        @if($activity->deal->contact)
                                            • Клиент:
                                            {{ $activity->deal->contact->first_name }}
                                            {{ $activity->deal->contact->last_name }}
                                        @endif
                                    </div>
                                @endif
                            </div>

                            <div>
                                <a href="{{ route('activity.edit', $activity) }}"
                                   class="btn btn-sm btn-outline-primary">Редактировать</a>
                            </div>
                        </div>

                        @if($activity->note)
                            <div class="mt-2">{{ $activity->note }}</div>
                        @endif
                    </div>
                @empty
                    <p class="text-muted mb-0">Активностей пока нет.</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection
