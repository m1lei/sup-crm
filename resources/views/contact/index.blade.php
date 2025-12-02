@extends('layouts.app')
@section('content')
<table>
    <thead>
    <tr>
        <th>имя</th>
        <th>фамелия</th>
        <th>email</th>
        <th>номер</th>
        <th>компания</th>
        <th>Описание</th>
    </tr>
    </thead>
    <tbody>
    @foreach($contacts as $contact)
        <tr>
            <td>{{$contact->first_name}}</td>
            <td>{{$contact->last_name}}</td>
            <td>{{$contact->email}}</td>
            <td>{{$contact->phone}}</td>
            <td>{{$contact->company}}</td>
            <td>{{$contact->note}}</td>
            <td><a href="{{ route('contact.edit',$contact->id) }}">Редактировать</a></td>
            <td><a href="{{route('contact.show', $contact->id)}}"> Подробнее</a></td>
            <td><a href="{{route('contact.destroy', $contact->id)}}"> Удалить TODO починить</a></td>
        </tr>
    @endforeach
    </tbody>
</table>
    <a href="{{route('contact.create')}}">Создать новый контак</a>
@endsection

