@if(Auth::check())
    <li><a href="{{ route('requests.dashboard') }}">Ver pedidos</a></li>
    <li><a href="{{ route('request.create') }}">Criar pedido</a></li>
    @if (Auth::user()->admin == true)
        <li><a href="{{ route('comments.blocked') }}">Ver comentários bloqueados</a></li>
    @endif
@endif