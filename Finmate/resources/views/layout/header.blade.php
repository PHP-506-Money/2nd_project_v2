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
            <div class="dropdown nav-item {{ Request::is('assets/*') || Request::is('assets/transactions/*') ? 'is-active' : '' }}" active-color="#FF7676">
                <a href="{{ url('/assets'.'/' . auth()->user()->userid) }}"> 자산 </a>
                <div class="dropdown-content">
                    <a href="{{ url('/assets'.'/' . auth()->user()->userid) }}" class="nav-item">자산목록</a>
                    <a href="{{url('/assets/transactions'.'/'.auth()->user()->userid)}}" class="nav-item">자산내역</a>
                </div>
            </div>
            <div class="dropdown nav-item {{ Request::is('mofin/*') || Request::is('users/profile/*') ? 'is-active' : '' }}" active-color="#FF7676">
                <a href="{{ url('/users/profile'.'/' . auth()->user()->userid) }}"> 모핀 </a>
                <div class="dropdown-content">
                    <a href="{{ url('/users/profile'.'/' . auth()->user()->userid) }}" class="nav-item">모핀</a>
                    <a href="{{url('/mofin'.'/' . auth()->user()->userid)}}" class="nav-item">뽑기</a>
                </div>
            </div>
            <a href="{{ url('/goal'.'/' . auth()->user()->userid) }}" class="nav-item {{ Request::is('goal/*') ? 'is-active' : '' }}" active-color="#FF7676">목표</a>
            <a href="{{ url('/rank'.'/' . auth()->user()->userid) }}" class="nav-item {{ Request::is('rank/*') ? 'is-active' : '' }}" active-color="#FF7676">랭킹</a>
            <a href="{{ url('/budget'.'/' . auth()->user()->userid) }}" class="nav-item {{ Request::is('budget/*') || Request::is('budgetset') || Request::is('budget') ? 'is-active' : '' }}" active-color="#FF7676">예산</a>



            <a href="{{ url('/static'.'/' . auth()->user()->userid) }}" class="nav-item {{ Request::is('static/*') ? 'is-active' : '' }}" active-color="#FF7676">통계</a>
            <a href="{{ url('/achievements') }}" class="nav-item {{ Request::is('achievements') ? 'is-active' : '' }}" active-color="#FF7676">업적</a>
            <span class="nav-indicator"></span>
        </nav>
    </div>
    <div class="logout">
        <a href="{{route('users.modify')}}">Myinfo</a>
        <a href="{{ route('users.logout') }}">Logout</a>
    </div>
    @endauth


</header>

<script src="{{ asset('/js/app.js') }}"></script>

