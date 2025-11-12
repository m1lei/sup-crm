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
        </tr>
    @endforeach
    </tbody>
</table>
@endsection

