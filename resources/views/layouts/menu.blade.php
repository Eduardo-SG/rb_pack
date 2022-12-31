{{-- <li class="side-menus {{ Request::is('home') ? 'active' : '' }}">
    <a class="nav-link" href="/">
        <i class=" fas fa-building"></i><span>Dashboard</span>
    </a>
</li> --}}
<li class="side-menus {{ Request::is('clients') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('clients.index') }}">
        <i class="fa fa-users"></i><span>Clientes</span>
    </a>
</li> 
<li class="side-menus {{ Request::is('parts') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('parts.index') }}">
        <i class="fa fa-archive"></i><span>Números de parte</span>
    </a>
</li> 
<li class="side-menus {{ Request::is('processes') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('processes.index') }}">
        <i class="fa fa-cogs"></i><span>Procesos</span>
    </a>
</li> 
<li class="side-menus {{ Request::is('orders') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('orders.index') }}">
        <i class="fa fa-clipboard"></i><span>Ordenes</span>
    </a>
</li> 
{{-- @can('view-role') --}}
<li class="side-menus {{ Request::is('roles') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('roles.index') }}">
        <i class="fa fa-id-badge"></i><span>Roles</span>
    </a>
</li>  
{{-- @endcan --}}
{{-- @can('view-user') --}}
<li class="side-menus {{ Request::is('users') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('users.index') }}">
        <i class="fa fa-user-circle"></i><span>Usuarios</span>
    </a>
</li>
{{-- @endcan --}}