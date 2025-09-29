@if(isset($menus))
<div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
    <ul class="navbar-nav">
        @foreach($menus->where('parent_id', null) as $menu)
            @php
                $isActive = request()->routeIs($menu->route) || request()->is(explode('.', $menu->route)[0] . '/*');
                // Argon uses different icon sets, we will map them or use a default
                $icon = str_replace('fa-', 'ni ni-', $menu->icon); // Basic conversion
            @endphp
            <li class="nav-item">
                <a class="nav-link {{ $isActive ? 'active' : '' }}" href="{{ route($menu->route) }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="{{ $icon ?? 'ni-app' }} text-secondary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">{{ $menu->name }}</span>
                </a>
            </li>
        @endforeach
        <li class="nav-item">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-button-power text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Log Out</span>
                </a>
            </form>
        </li>
    </ul>
</div>
@endif
