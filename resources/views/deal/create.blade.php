@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Создать сделку</h1>
    <form action="{{route('deal.store')}}" method="POST">
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

        @csrf
        <div class="mb-3">
            <label for="title">описание</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="md-3">
            <label for="contact_id">Выберите клиента
            <select name="contact_id" class="form-select" required>
                    <option value="">Выберите клиента..</option>
                @foreach($contacts as $contact)
                    <option value="{{$contact->id}}">{{$contact->first_name}} {{$contact->last_name}}{{$contact->company}}</option>
                @endforeach
            </select>
            </label>
        </div>
        <div class="mb-3">
            <label for="status">статус</label>
            <select name="status" id="status" class="form-select">
                <option value="Todo">Todo</option>
                <option value="in_progress">в прогрессе</option>
                <option value="Done">Завершен</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="amount">цена</label>
            <input type="number" name="amount" class="form-control">
        </div>

        <div class="mb-3">
            <label for="deadline">срок</label>
            <input type="date" name="deadline" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Сохранить</button>
        <a href="{{ route('contact.index') }}">Назад</a>
    </form>
</div>
@endsection
