{{--статический компонент для отображение быстрых действий для пользователя--}}
<div>
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
