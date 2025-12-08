<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="{{ route('dashboard.index') }}">Mini CRM</a>

        <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" href="{{ route('contact.index') }}">Контакты</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('deal.index') }}">Сделки</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('task.index') }}">Задачи</a></li>
            </ul>

            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><span class="navbar-text align-middle fs-5">{{ auth()->user()->name ?? '' }}</span></li>
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button class="btn btn-sm btn-outline-light ms-2">Выйти</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
