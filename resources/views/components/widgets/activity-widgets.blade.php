<div>
    <!-- Order your soul. Reduce your wants. - Augustine -->
    <div class="card">
        <div class="card-header">Последние активности</div>
        <div class="card-body">
            @forelse($recentActivities as $activity)
                <div class="mb-3 pb-2 border-bottom">
                    <div class="d-flex justify-content-between">
                        <div>
                            @php
                                $typeLabel = match($activity->type) {
                                    'call' => 'Звонок',
                                    'email' => 'Письмо',
                                    'meeting' => 'Встреча',
                                    'note' => 'Заметка',
                                    default => $activity->type
                                };
                            @endphp

                            <span class="badge
                                    @if($activity->type === 'call') bg-primary
                                    @elseif($activity->type === 'email') bg-info text-dark
                                    @elseif($activity->type === 'meeting') bg-warning text-dark
                                    @else bg-secondary
                                    @endif
                                ">
                                    {{ $typeLabel }}
                                </span>

                            <strong class="ms-2">
                                {{ optional($activity->happened_at)->format('d.m.Y H:i') }}
                            </strong>

                            @if($activity->user)
                                <span class="text-muted small ms-2">
                                        ({{ $activity->user->name }})
                                    </span>
                            @endif

                            @if($activity->deal)
                                <div class="small mt-1">
                                    Сделка:
                                    <a href="{{ route('deal.show', $activity->deal_id) }}">
                                        {{ $activity->deal->title }}
                                    </a>
                                    @if($activity->deal->contact)
                                        • Клиент:
                                        {{ $activity->deal->contact->first_name }}
                                        {{ $activity->deal->contact->last_name }}
                                    @endif
                                </div>
                            @endif
                        </div>

                        <div>
                            <a href="{{ route('activity.edit', $activity) }}"
                               class="btn btn-sm btn-outline-primary">Редактировать</a>
                        </div>
                    </div>

                    @if($activity->note)
                        <div class="mt-2">{{ $activity->note }}</div>
                    @endif
                </div>
            @empty
                <p class="text-muted mb-0">Активностей пока нет.</p>
            @endforelse
        </div>
    </div>
</div>
