<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between mb-5" style="display: flex;
                                                  justify-content: space-between;
                                                  align-items: center;">
        <nav id="navbar-example2" class="navbar navbar-light bg-light px-3">
            <div class="card text-center">
                <div class="card-header">
                    <ul class="nav nav-pills card-header-pills">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('/') ? 'active' : null }}"
                               href="{{route('index')}}">
                                {{ __('Список отелей') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('create') ? 'active' : null }}"
                               href="{{route('create')}}">
                                {{ __('Создать новое правило') }}
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</div>
<hr>
