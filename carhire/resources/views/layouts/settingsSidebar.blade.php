<li class="nav-item menu-open btn">
    <a href="{{ route('dashboard') }}" class="btn btn-primary btn-block ">
        <i class="fas fa-arrow-left"></i>
        <span>Back to Dashboard</span>
    </a>
</li>

@if (Auth::user()->hasPermissionTo('view-insurance-company'))
    <li class="nav-item">
        <a href="{{ route('insurance-companies') }}"
            class="nav-link {{ Route::currentRouteName() == 'insurance-companies' || Route::currentRouteName() == 'insurance-company.create' || Route::currentRouteName() == 'insurance-company.edit' || Route::currentRouteName() == 'insurance-company.show' ? 'topnav' : '' }}">
            <i class="fas fa-handshake nav-icon"></i>
            <p>Insurance Companies</p>
        </a>
    </li>
@endif
@if (Auth::user()->hasPermissionTo('view-owner'))
    <li class="nav-item">
        <a href="{{ route('owners') }}"
            class="nav-link {{ Route::currentRouteName() == 'owners' || Route::currentRouteName() == 'owner.create' || Route::currentRouteName() == 'owner.edit' || Route::currentRouteName() == 'owner.show' ? 'topnav' : '' }}">
            <i class="nav-icon fas fa-users"></i>
            <p>
                Owners
            </p>
        </a>
    </li>
@endif
@if (Auth::user()->hasPermissionTo('view-user'))
    <li class="nav-item">
        <a href="{{ route('users') }}"
            class="nav-link {{ Route::currentRouteName() == 'users' || Route::currentRouteName() == 'user.create' || Route::currentRouteName() == 'user.edit' || Route::currentRouteName() == 'user.show' ? 'topnav' : '' }}">
            <i class="nav-icon fas fa-user"></i>
            <p>
                Users
            </p>
        </a>
    </li>
@endif
@if (Auth::user()->hasPermissionTo('view-role'))
    <li class="nav-item">
        <a href="{{ route('roles') }}"
            class="nav-link {{ Route::currentRouteName() == 'roles' || Route::currentRouteName() == 'role.create' || Route::currentRouteName() == 'role.edit' || Route::currentRouteName() == 'role.show' ? 'topnav' : '' }}">
            <i class="nav-icon fas fa-tasks"></i>
            <p>
                Roles
            </p>
        </a>
    </li>
@endif
@if (Auth::user()->hasPermissionTo('view-workshop'))
    <li class="nav-item">
        <a href="{{ route('workshops') }}"
            class="nav-link {{ Route::currentRouteName() == 'workshops' || Route::currentRouteName() == 'workshop.create' || Route::currentRouteName() == 'workshop.edit' || Route::currentRouteName() == 'workshop.show' ? 'topnav' : '' }}">
            <i class="nav-icon fas fa-warehouse"></i>
            <p>Workshops</p>
        </a>
    </li>
@endif
@if (Auth::user()->hasPermissionTo('view-workshop-type'))
    <li class="nav-item">
        <a href="{{ route('workshop-types') }}"
            class="nav-link {{ Route::currentRouteName() == 'workshop-types' || Route::currentRouteName() == 'workshop-type.create' || Route::currentRouteName() == 'workshop-type.edit' || Route::currentRouteName() == 'workshop-type.show' ? 'topnav' : '' }}">
            <i class="fa fa-tools nav-icon"></i>
            <p>Workshop Types</p>
        </a>
    </li>
@endif

@if (Auth::user()->hasPermissionTo('view-maintenance-type'))
    <li class="nav-item">
        <a href="{{ route('maintenance-types') }}"
            class="nav-link  {{ Route::currentRouteName() == 'maintenance-types' || Route::currentRouteName() == 'maintenance-type.create' || Route::currentRouteName() == 'maintenance-type.edit' || Route::currentRouteName() == 'maintenance-type.show' ? 'topnav' : '' }}">
            <i class="fa fa-wrench nav-icon"></i>

            <p>Maintenance Types</p>
        </a>
    </li>
@endif
