@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Мои задачи</h1>

        <form method="GET" action="{{ route('task.index') }}" class="row mb-4">

            {{-- Фильтр по статусу --}}
            <div class="col-md-4">
                <label class="form-label">Статус</label>
                <select name="status" class="form-select" onchange="this.form.submit()">
                    <option value="all" {{ request('status')=='all' ? 'selected' : '' }}>Все</option>
                    <option value="open" {{ request('status')=='open' ? 'selected' : '' }}>Открытые</option>
                    <option value="done" {{ request('status')=='done' ? 'selected' : '' }}>Завершённые</option>
                </select>
            </div>

            {{-- Фильтр по сроку --}}
            <div class="col-md-4">
                <label class="form-label">Срок выполнения</label>
                <select name="date" class="form-select" onchange="this.form.submit()">
                    <option value="all" {{ request('date')=='all' ? 'selected' : '' }}>Все</option>
                    <option value="overdue" {{ request('date')=='overdue' ? 'selected' : '' }}>Просроченные</option>
                    <option value="today" {{ request('date')=='today' ? 'selected' : '' }}>Сегодня</option>
                    <option value="future" {{ request('date')=='future' ? 'selected' : '' }}>Будущие</option>
                </select>
            </div>

        </form>

        {{-- список задач --}}
        @forelse ($task as $t)
            <div class="card mb-2 p-3">
                <div class="d-flex justify-content-between">
                    <div>
                        <strong>{{ $t->title }}</strong><br>

                        {{-- статус --}}
                        @php
                            $deadline = \Carbon\Carbon::parse($t->deadline_at);
                            $today = \Carbon\Carbon::today();

                            $badgeText = "Без даты";
                            // В Bootstrap 5 используется bg-* вместо badge-*
                            $badgeClass = "bg-secondary";

                            if ($t->status == "done") {
                                $badgeClass = "bg-success";
                                $badgeText = "Выполнено";
                            } else {
                                // Логика для незавершенных задач

                                // 1. Проверяем, просрочена ли задача (дата в прошлом и это не сегодня)
                                if ($deadline->isPast() && !$deadline->isToday()) {
                                    $badgeClass = "bg-danger";
                                    $badgeText = "Просрочено";

                                // 2. Проверяем, дедлайн сегодня
                                } elseif ($deadline->isToday()) {
                                    // Используем text-dark, чтобы текст был читаемым на желтом фоне
                                    $badgeClass = "bg-warning text-dark";
                                    $badgeText = "Сегодня";

                                // 3. Если ни одно из вышеперечисленных, значит дедлайн в будущем
                                } else {
                                    $badgeClass = "bg-info";
                                    $badgeText = 'Будущее';
                                }
                            }
                        @endphp

                        <span class="badge {{ $badgeClass }}">{{ $badgeText }}</span>

                        <div class="text-muted">
                            Дедлайн: {{ $t->deadline_at }}
                        </div>

                        <div class="btn btn-outline-secondary">
                            <a href="{{ route('deal.show', $t->deal_id) }}">
                                Сделка: №{{ $t->deal_id }}
                            </a>
                        </div>
                    </div>
                    <div class="mt-4">
                        {{ $task->links() }}
                    </div>

                    {{-- кнопки --}}
                    <div class="text-end">
                        <a href="{{ route('task.edit', $t) }}" class="btn btn-sm btn-outline-primary">Редактировать</a>

                        <form action="{{ route('task.destroy', $t) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Удалить задачу?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">Удалить</button>
                        </form>
                    </div>
                </div>
            </div>

        @empty
            <p class="text-muted">Нет задач по выбранным фильтрам.</p>
        @endforelse

    </div>
@endsection
