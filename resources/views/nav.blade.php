@if(Auth::check())
    <a class="btn btn-danger navbar-btn" href= {{ route(Auth::logout()) }}>Logout</a>
    <a class="btn btn-default navbar-btn" href="www.facebook.com">Ver Perfil</a>
    <p class="navbar-text">
        {{ Auth::user()->name }},
        @if (Auth::user()->admin === true)
    Administrador
@else
    Funcionário
    @endif
    </p>
@else
    <a class="btn btn-danger navbar-btn" href="{{ route('login') }}">Login</a>
    <a class="btn btn-default navbar-btn" href="{{ route('register') }}">Criar conta</a>
@endif



