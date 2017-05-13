<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
        {{ Auth::user()->name }},
        @if (Auth::user()->admin === true)
            Administrador
        @else
            Funcionário
        @endif
        <span class="caret"></span>
    </a>

    {{-- COMO O LARAVEL VEM--}}

    <ul class="dropdown-menu" role="menu">
        <li>
            <a href="{{route('userDetail', ['id' => Auth::id()])}}">Ver Perfil</a>
        </li>
        <li>
            <a href="{{route('editUser', ['id' => Auth::id()])}}">Editar Perfil</a>
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

    {{--TENTATIVA DO MIGUEL

     <ul class="dropdown-menu" role="menu">
        <li>
            <a href="www.facebook.com">Ver Perfil</a>
        </li>
        <li>
            <form class="form-group" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{csrf_field()}}
                <button class="btn btn-link" type="submit">Logout</button>
            </form>
        </li>
    </ul>

     --}}

</li>