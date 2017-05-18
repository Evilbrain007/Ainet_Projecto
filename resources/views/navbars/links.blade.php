@if(Auth::check())
    <li><a href="{{ route('requests.dashboard') }}">Ver Pedidos</a></li>
    <li><a href="{{ route('createRequest') }}">Criar Pedido</a></li>
@endif