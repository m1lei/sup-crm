{{--Компонент создание задачи, принимает в себя Deal $deal--}}
<div>
    <div class="card mb-4">
        <div class="card-header">Создать задачу</div>
        <div class="card-body">
            <form action="{{ route('task.store') }}" method="POST">
                @csrf
                <input type="hidden" name="deal_id" value="{{ $deal->id }}">
                <input type="hidden" name="assignee_id" value="{{$deal->user_id}}">

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
