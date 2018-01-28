<header id="nav-header">
    <nav id="navbar">
        <div>
            @if (!\Request::is('/'))
                    <img id="navbar-logo" src="/logo-white.png">
            @endif
            <ul>
                @auth
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('courses') }}">Courses</a></li>
                    <li><a>Settings</a></li>
                    <li>
                        <a id="logout-button">Logout</a>
                        <form id="logout-form" action=" {{ route('logout') }}" method="post">
                            {{ csrf_field() }}
                        </form>
                    </li>
                @else
                    <li><a href="/login">Log In</a></li>
                    <li><a href="/register">Sign Up</a></li>
                @endauth
            </ul>
        </div>
    </nav>
</header>