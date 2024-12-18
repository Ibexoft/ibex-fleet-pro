@if (Auth::user()->hasPermissionTo('view-booking') && Auth::user()->hasPermissionTo('create-booking'))
<li class="nav-item menu-open btn">
    <a href="{{ route('booking.create') }}"
        class="btn btn-primary btn-block">
        <i class="fa fa-plus-circle"></i>
        <span>New Booking</span>
    </a>
</li>
@endif
<li class="nav-item">
    <a href="{{ route('dashboard') }}" class="nav-link {{ Route::currentRouteName() == 'dashboard' ? 'topnav' : '' }}">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>
            Dashboard
        </p>
    </a>
</li>
@if (Auth::user()->hasPermissionTo('view-booking'))
    <li class="nav-item ">
        <a href="{{ route('bookings') }}" class="nav-link {{ Route::currentRouteName() == 'bookings' || Route::currentRouteName() == 'booking.create' || Route::currentRouteName() == 'booking.edit' || Route::currentRouteName() == 'booking.show' ? 'topnav' : '' }}">
            <i class="nav-icon fas fa-calendar-alt"></i>
            <p>
                Bookings
            </p>
        </a>
@endif
@if (Auth::user()->hasPermissionTo('view-vehicle'))
    <li class="nav-item">
        <a href="{{ route('vehicles') }}" class="nav-link {{ Route::currentRouteName() == 'vehicles' || Route::currentRouteName() == 'vehicle.create' || Route::currentRouteName() == 'vehicle.edit' || Route::currentRouteName() == 'vehicle.show' ? 'topnav' : '' }}">
            <i class="nav-icon fas fa-car"></i>
            <p>

                Fleet
            </p>
        </a>
    </li>
@endif
@if (Auth::user()->hasPermissionTo('view-driver'))
    <li class="nav-item">
        <a href="{{ route('drivers') }}" class="nav-link {{ Route::currentRouteName() == 'drivers' || Route::currentRouteName() == 'driver.create' || Route::currentRouteName() == 'driver.edit' || Route::currentRouteName() == 'driver.show' ? 'topnav' : '' }}">
            <i class="nav-icon fas fa-user-circle"></i>
            <p>
                Drivers
            </p>
        </a>
    </li>
@endif
@if (Auth::user()->hasPermissionTo('view-fine'))
    <li class="nav-item">
        <a href="{{ route('fines') }}" class="nav-link {{ Route::currentRouteName() == 'fines' || Route::currentRouteName() == 'fine.create' || Route::currentRouteName() == 'fine.edit' || Route::currentRouteName() == 'fine.show' ? 'topnav' : '' }}">
            <i class="nav-icon fas fa-gavel"></i>
            <p>
                Fine
            </p>
        </a>
    </li>
@endif
@if (Auth::user()->hasPermissionTo('view-maintenance'))
    <li class="nav-item">
        <a href="{{ route('maintenance') }}" class="nav-link {{ Route::currentRouteName() == 'maintenance' || Route::currentRouteName() == 'maintenance.create' || Route::currentRouteName() == 'maintenance.edit' || Route::currentRouteName() == 'maintenance.show' ? 'topnav' : '' }}">
            <i class="fa fa-wrench nav-icon"></i>
            <p>
                Maintenance
            </p>
        </a>
    </li>
@endif
