<div class="p-3">
    {{--<h5>Title</h5>
    <p>Sidebar content</p>--}}

    <ul class="nav nav-pills flex-column">
        {{--@livewire('dolar-component')--}}
        {{--<li class="dropdown-divider"></li>--}}
        <li class="nav-item">
            <span class="text-small text-muted float-right">Right-Sidebar</span>
        </li>
        <li class="nav-item">
            <a href="{{ route('web.index') }}" class="nav-link" target="_blank">
                <i class="fas fa-house-user"></i> Inicio
            </a>
        </li>
        @if(auth()->user()->role == 100)
            <li class="nav-item">
                <a href="{{ route('chat.directo', auth()->user()->rowquid) }}" class="nav-link" target="_blank">
                    <i class="fas fa-comments"></i> Chat Directo
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('fcm.index') }}" class="nav-link">
                    <i class="fas fa-bell"></i> Cloud Messaging (FCM)
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ env('APP_URL_ANDROID', '/android') }}" class="nav-link" target="_blank">
                    <i class="fas fa-mobile-alt mr-2"></i> API Android
                </a>
            </li>
        @endif
    </ul>

</div>

