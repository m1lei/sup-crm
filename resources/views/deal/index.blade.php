@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Сделки</h1>
            <a href="{{ route('deal.create') }}" class="btn btn-primary">Новая сделка</a>
        </div>

        @if($deal->isEmpty())
            <p class="text-muted">Сделок пока нет.</p>
        @else
            <table class="table table-hover align-middle">
                <thead>
                <tr>
                    <th>Название</th>
                    <th>Клиент</th>
                    <th>Статус</th>
                    <th>Сумма</th>
                    <th>Дедлайн</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($deal as $d)
                    @php
                        $deadline = $d->deadline_at ? \Carbon\Carbon::parse($d->deadline_at) : null;
                        $badgeClass = 'bg-secondary';
                        $badgeText = $d->status;

                        switch ($d->status) {
                            case 'New':
                                $badgeClass = 'bg-primary';
                                $badgeText = 'Новая';
                                break;
                            case 'Todo':
                                $badgeClass = 'bg-info text-dark';
                                $badgeText = 'В работе';
                                break;
                            case 'in_progress':
                                $badgeClass = 'bg-warning text-dark';
                                $badgeText = 'В процессе';
                                break;
                            case 'Done':
                                $badgeClass = 'bg-success';
                                $badgeText = 'Завершена';
                                break;
                        }
                    @endphp

                    <tr>
                        <td>
                            <a href="{{ route('deal.show', $d->id) }}">
                                {{ $d->title }}
                            </a>
                        </td>
                        <td>
                            @if($d->contact)
                                <a href="{{ route('contact.show', $d->contact_id) }}">
                                    {{ $d->contact->first_name }} {{ $d->contact->last_name }}
                                </a>
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>
                        <td>
                            <span class="badge {{ $badgeClass }}">{{ $badgeText }}</span>
                        </td>
                        <td>{{ $d->amount ?? '—' }}</td>
                        <td>
                            {{ $deadline ? $deadline->format('d.m.Y') : '—' }}
                        </td>
                        <td class="text-end">
                            <a href="{{ route('deal.show', $d->id) }}" class="btn btn-sm btn-outline-secondary">
                                Открыть
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
