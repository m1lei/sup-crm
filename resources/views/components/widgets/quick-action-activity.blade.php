{{--Форма создание активностей принимает в себя Deal $deal--}}
<div>
    <form action="{{ route('activity.store') }}" method="POST" class="mb-4">
        @csrf
        <input type="hidden" name="subject_id" value="{{ $sudject->id }}">
        <input type="hidden" name="subject_type" value="{{$sudject->getMorphClass()}}">

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
</div>
