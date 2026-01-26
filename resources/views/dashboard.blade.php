@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Dashboard</h1>

        <div class="row mb-4">
            {{-- ЛЕВАЯ КОЛОНКА: Задачи --}}
            <x-widgets.task-widgets/>

            {{-- ПРАВАЯ КОЛОНКА: Статистика по сделкам --}}
            <div class="col-md-4 mb-3">
                <x-widgets.deal-widgets/>
            </div>
            <div class="col-md-4 mb-3">
                <x-widgets.quick-action-deal/>
            </div>

        {{-- НИЖНИЙ БЛОК: Последние активности --}}
        <x-widgets.activity-widgets/>
        </div>
    </div>
@endsection
