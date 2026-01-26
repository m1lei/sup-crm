<div>
    <!-- Do what you can, with what you have, where you are. - Theodore Roosevelt -->
    <div class="card mb-3">
        <div class="card-header">Сделки</div>
        <div class="card-body">

            <ul class="list-unstyled mb-2">
                <li>
                    <span class="badge bg-primary me-2">&nbsp;</span>
                    Новые: {{ $deals['New'] ?? 0 }}
                </li>
                <li>
                    <span class="badge bg-warning text-dark me-2">&nbsp;</span>
                    В процессе: {{ $deals['in_progress'] ?? 0 }}
                </li>
                <li>
                    <span class="badge bg-success me-2">&nbsp;</span>
                    Завершены: {{ $deals['Done'] ?? 0 }}
                </li>
            </ul>



            <a href="{{ route('deal.index') }}" class="btn btn-outline-secondary btn-sm">
                Открыть список сделок
            </a>
        </div>
    </div>
</div>
