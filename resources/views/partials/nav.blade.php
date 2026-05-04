<nav>
    <ul>
        <li><a href="{{ route('advertisements.index') }}">Home</a></li>
        @if (Auth::check())
        <li><a href="{{ route('advertisements.create') }}">Post new advertisement</a></li>
        <li><a href="{{ route('users.account') }}">My Account</a></li>
        <li><a href="{{ route('users.logout') }}">Logout</a></li>
        @else
        <li><a href="{{ route('users.create') }}">Register</a></li>
        <li><a href="{{ route('users.login') }}">Login</a></li>
        @endif
       
    </ul>
</nav>