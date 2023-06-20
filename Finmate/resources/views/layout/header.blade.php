<header>
@guest
    <div class="headerlogo" onclick="location.href='{{ route('main') }}'">
        <img src="{{ asset('/img/logo1.png') }}" alt="로고">
        <p>FinMate:GoToMain</p>
    </div>
    <div class="headerMain">
        <h1>@yield('header', 'header')</h1>
        <nav class="nav">
        <a href="{{ route('main') }}" class="nav-item {{ Request::is('/') ? 'is-active' : '' }}" active-color="#FF7676">main</a>
        <a href="{{ route('users.registration') }}" class="nav-item {{ Request::is('users/registration') ? 'is-active' : '' }}" active-color="#FF7676">sign up</a>
        <a href="{{ route('users.login') }}" class="nav-item {{ Request::is('users/login') ? 'is-active' : '' }}" active-color="#FF7676">login</a>
        <span class="nav-indicator"></span>
        </nav>     
    </div>
    @endguest

    @auth
    <div class="headerlogo" onclick="location.href='{{ url('/assets'.'/'.auth()->user()->userid) }}'">

        <img src="{{ asset('/img/logo1.png') }}" alt="로고">
        <p>FinMate:MyAssets</p>
    </div>
    <div class="headerMain">
        <h1>@yield('header', 'header')</h1>

    <nav class="nav">
        <a href="{{ url('/assets'.'/' . auth()->user()->userid) }}" class="nav-item {{ Request::is('assets/*') ? 'is-active' : '' }}" active-color="#FF7676">자산</a>
        <a href="{{ url('/mofin'.'/' . auth()->user()->userno) }}" class="nav-item {{ Request::is('mofin/*') ? 'is-active' : '' }}" active-color="#FF7676">모핀</a>
        <a href="{{ url('/goal'.'/' . auth()->user()->userno) }}" class="nav-item {{ Request::is('goal/*') ? 'is-active' : '' }}" active-color="#FF7676">목표</a>
        <a href="{{ url('/budget'.'/' . auth()->user()->userid) }}" class="nav-item {{ Request::is('budget/*') ? 'is-active' : '' }}" active-color="#FF7676">예산</a>
        <a href="{{ route('users.myinfo') }}" class="nav-item {{ Request::is('users/myinfo') ? 'is-active' : '' }}" active-color="#FF7676">Myinfo</a>
        <a href="{{ route('users.logout') }}" class="nav-item {{ Request::is('users/logout') ? 'is-active' : '' }}" active-color="#FF7676">logout</a>
        <span class="nav-indicator"></span>
    </nav>
    </div>

    @endauth

</header>


<script src="{{ asset('/js/app.js') }}"></script>
