<div>
    <!-- Life is available only in the present moment. - Thich Nhat Hanh -->
    <div class="card shadow-sm">
        <div class="card-header">Задачи на сегодня ({{ $tasks['today']->count() }})</div>

        <div class="card-body">
            {{-- Просроченные --}}
            <h5 class="card-title text-danger">Просроченные</h5>
            @forelse($tasks['overdue'] as $task)
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
            @forelse($tasks['today'] as $task)
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
            @forelse($tasks['future'] as $task)
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
