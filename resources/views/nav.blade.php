@if(Auth::check())
    <p class="navbar-text">
        {{ Auth::user()->name }},
        @if (Auth::user()->admin === true)
            Administrador
        @else
            Funcionário
        @endif
    </p>
    <div class="form-inline">
        <a class="btn btn-default navbar-btn" href="www.facebook.com">Ver Perfil</a>
        <form class="form-group" action={{ route('logout') }} method="POST">
            {{csrf_field()}}
            <button class="btn btn-danger navbar-btn" type="submit">Logout</button>
        </form>
    </div>
@else
    <a class="btn btn-danger navbar-btn" href="{{ route('login') }}">Login</a>
    <a class="btn btn-default navbar-btn" href="{{ route('register') }}">Criar conta</a>
@endif



