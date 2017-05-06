@extends('layouts.master')

@section('title')

    <h1>Pedido {{$printRequest->id}}
        <small>{{$printRequest->open_date}}</small>
    </h1>
    <h5 class="text-muted"><strong>POR IMPRIMIR</strong></h5>
    <h5 class="text-muted">Concluir até: 10/05/2017</h5>

@endsection

@section('content')

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Administração</h3>
        </div>
        <div class="panel-body">
            <a class="btn btn-primary" href="home.html">Concluir Pedido</a>
            <a class="btn btn-danger" href="home.html">Recusar Pedido</a>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Detalhes do pedido</h3>
        </div>
        <table class="table">
            <tbody class="text-center">
            <tr>
                <td class="col-sm-1">Preto e branco</td>
                <td class="col-sm-1">Frente e verso</td>
                <td class="col-sm-1">Não agrafado</td>
                <td class="col-sm-1">A4</td>
                <td class="col-sm-1">Papel de fotografia</td>
                <td class="col-sm-1"><a href="">Ficheiro a imprimir</a></td>
                <td class="col-sm-1"><strong>POR IMPRIMIR</strong></td>
            </tr>
            </tbody>
        </table>
        <div class="panel-body">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Requerente</h3>
        </div>
        <div class="panel-body">
            Francisco de Valle<br>
            Departamento de Ortodentia<br>
            dentistaARRobamundosdosmedicos.dom<br>
            Telefone: 991712312
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Comentários</h3>
        </div>

        <div class="panel-body">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Deixe o seu comentário</h3>
                </div>
                <div class="panel-body">
                    {{-- FALTA A ROTA NO ACTION--}}
                    <form action="{{route('createComment')}}" method="post">
                        {{--<input type="number" hidden value={{$request->id}}> --}}

                        <textarea name="message" rows="10" cols="200"></textarea>
                        <div class="pull-right">
                            <button type="submit" class="btn btn-danger">Comentar</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        <div class="panel-body">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">João Fonseca</h3>
                </div>
                <div class="panel-body">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <div class="pull-right">
                        <a class="btn btn-danger" href="home.html">Bloquear</a>
                        <a class="btn btn-primary" href="home.html">Responder</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Mariana Marques</h3>
                </div>
                <div class="panel-body">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <div class="pull-right">
                        <a class="btn btn-danger" href="home.html">Bloquear</a>
                        <a class="btn btn-primary" href="home.html">Responder</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    </div>

    @endsection