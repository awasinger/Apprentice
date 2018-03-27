<header class="nav-header">
    <nav class="navbar">
        @if (!\Request::is('/'))
            <a href="/"><img class="navbar-logo" src="/logo-white.png"></a>
        @endif
        <a class="mobile-open" href="javascript:void(0)">&#9776;</a>
        
        <div class="nav-list-container">
            <a class="mobile-close">&larr;</a>
            <ul class="nav-list">
                @auth
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                    @if (!Auth::user()->business)
                        <li class="nav-item"><a class="nav-link" href="{{ route('courses') }}">Courses</a></li>
                    @endif
                    @if (Auth::user()->business)
                        <li class="nav-item"><a class="nav-link" href="/courses/create">Create</a></li>
                    @endif
                    <li class="nav-item"><a class="nav-link" href="/settings">Settings</a></li>
                    <li class="nav-item">
                        <a class="nav-link" id="logout-button">Logout</a>
                        <form id="logout-form" action=" {{ route('logout') }}" method="post">
                            {{ csrf_field() }}
                        </form>
                    </li>
                @else
                    <li class="nav-item"><a class="nav-link" href="{{ route('courses') }}">Courses</a></li>
                    <li class="nav-item"><a class="nav-link" href="/login">Log&nbsp;In</a></li>
                    <li class="nav-item"><a class="nav-link" href="/register">Sign&nbsp;Up</a></li>
                @endauth
            </ul>
        </div>
    </nav>
</header>