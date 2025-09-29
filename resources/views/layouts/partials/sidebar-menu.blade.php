@if(isset($menus))
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        @foreach($menus->where('parent_id', null) as $menu)
            @php
                //This logic is for AdminLTE. Argon might need different classes.
                //We will handle this in the final step by creating two separate partials.
                $active = request()->routeIs($menu->route) || request()->is(explode('.', $menu->route)[0] . '/*');
            @endphp
            <li class="nav-item">
                <a href="{{ route($menu->route) }}" class="nav-link {{ $active ? 'active' : '' }}">
                    <i class="nav-icon fas {{ $menu->icon ?? 'fa-circle' }}"></i>
                    <p>{{ $menu->name }}</p>
                </a>
            </li>
        @endforeach
        
        {{-- Static Logout for AdminLTE --}}
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
@endif
