<header class="main-header {{ Route::currentRouteName() == 'home' ? 'landing-page' : '' }}">
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand py-0 fw-bold me-5" href="#">Ibex Fleet Pro</a>
            <button class="navbar-toggler text-white bg-transparent border-0 shadow-none p-0" type="button"
                data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                    class="bi bi-list {{ Route::currentRouteName() == 'home' ? '' : 'text-dark' }}" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5" />
                </svg>
            </button>
            <style>

            </style>
            <div class="collapse navbar-collapse text-right p-lg-0 p-3 navigation-bar" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item me-3">
                        <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Home</a>
                    </li>
                    @auth
                        @if (Auth::user()->hasRole('System-Driver'))
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="{{ route('reservations') }}">My
                                    Reservation</a>
                            </li>
                        @endif
                    @endauth
                </ul>
                <div class="nav-item dropdown d-flex">
                    @if (Auth::user())
                        <a href="#"
                            class="btn btn-outline-rounded btn-sm nav-link dropdown-toggle truncate-text loggedin-user-name"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle"></i>
                            {{ Auth::user()->name }}
                        </a>
                    @else
                        <a href="{{ route('loginRegister') }}"
                            class="btn btn-outline-rounded btn-sm nav-link loggedin-user-name" role="button">
                            <i class="bi bi-person-circle"></i>
                            LOG IN
                        </a>
                    @endif
                    <ul class="dropdown-menu dropdown-menu-end">
                        @if (Auth::user())
                            @if (Auth::user()->hasRole('Super-Admin'))
                                <li><a class="dropdown-item" href={{ route('dashboard') }}>Dashboard</a></li>
                            @endif
                            <li><a class="dropdown-item" href={{ route('profile') }}>Account</a></li>
                            <hr class="dropdown-divider" />
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        @else
                            <li><a class="dropdown-item" href="{{ route('loginRegister') }}">Login</a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>
