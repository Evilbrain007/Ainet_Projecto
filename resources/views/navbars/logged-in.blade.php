<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
        {{ Auth::user()->name }},
        @if (Auth::user()->admin == true)
            Administrador
        @else
            Funcionário
        @endif
        <span class="caret"></span>
    </a>

    <ul class="dropdown-menu" role="menu">
        <li>
            <a href="{{route('user.detail', ['id' => Auth::id()])}}">Ver Perfil</a>
        </li>
        <li>
            <a href="{{route('user.edit', ['id' => Auth::id()])}}">Editar Perfil</a>
        </li>
        <li>
            <a href="{{ route('logout') }}"
               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                Logout
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </li>
    </ul>

</li>