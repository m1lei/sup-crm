@extends('layouts.app')
@section('content')
<h1>форма просмотра дела клиентов</h1>
<table>
    <thead>
    <tr>
        <th>Описание</th>
        <th>статус</th>
        <th>цена</th>
        <th>срок</th>
    </tr>
    </thead>
    <tbody>
    @foreach($deal as $d)
        <tr>
            <td>{{$d->title}}</td>
            <td>{{$d->status}}</td>
            <td>{{$d->amount}}</td>
            <td>{{$d->deadline_at}}</td>
            <td><a href="{{ route('deal.edit',$d->id) }}">Редактировать</a></td>
            <td><a href="{{route('deal.show', $d->id)}}"> Подробнее</a></td>
            <td><a href="{{route('deal.destroy', $d->id)}}"> Удалить</a></td>
        </tr>
    @endforeach
    </tbody>
    <a href="{{route('deal.create')}}" class="btn btn-primary">создать сделку</a>
</table>

@endsection
