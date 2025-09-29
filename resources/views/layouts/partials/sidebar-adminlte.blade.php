@if(isset($menus))
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        @foreach($menus->where('parent_id', null) as $menu)
            @php
                $isActive = request()->routeIs($menu->route) || request()->is(explode('.', $menu->route)[0] . '/*');
            @endphp
            <li class="nav-item">
                <a href="{{ route($menu->route) }}" class="nav-link {{ $isActive ? 'active' : '' }}">
                    <i class="nav-icon fas {{ $menu->icon ?? 'fa-circle' }}"></i>
                    <p>{{ $menu->name }}</p>
                </a>
            </li>
        @endforeach
        
        <li class="nav-item">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="{{ route('logout') }}" class="nav-link"
                   onclick="event.preventDefault(); this.closest('form').submit();">
                    <i class="nav-icon fas fa-sign-out-alt"></i>
                    <p>Log Out</p>
                </a>
            </form>
        </li>
    </ul>
</nav>
@endif
