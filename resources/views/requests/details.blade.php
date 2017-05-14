@extends('layouts.master')

@section('title')

    <h1>Pedido {{$printRequest->id}}
        <small>{{$printRequest->open_date}}</small>
    </h1>
    <h5 class="text-muted"><strong>POR IMPRIMIR</strong></h5>
    <h5 class="text-muted">Concluir até: 10/05/2017</h5>

@endsection

@section('content')

    @if(Auth::user()->admin == true)
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Administração</h3>
        </div>
        <div class="panel-body">
            <a class="btn btn-primary" href="home.html">Concluir Pedido</a>
            <a class="btn btn-danger" href="home.html">Recusar Pedido</a>
        </div>
    </div>
    @endif

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Detalhes do pedido</h3>
        </div>
        <table class="table">
            <tbody class="text-center">
            <tr>
                <td class="col-sm-1">{{$printRequest->colored ? 'A Cores' : 'Preto e branco'}}</td>
                <td class="col-sm-1">{{$printRequest->front_back ? 'Frente e verso' : 'Só frente'}}</td>
                <td class="col-sm-1">{{$printRequest->front_back ? 'Agrafado' : 'Não agrafado'}}</td>
                <td class="col-sm-1">A{{$printRequest->paper_size}}</td>
                <td class="col-sm-1">{{$printRequest->paper_type == 2 ? 'Papel de fotografia' :
                 $printRequest->paper_type == 1 ? 'Normal' : 'Rascunho'}}</td>
                <td class="col-sm-1"><a href="{{-- //TODO ROTA DA SORAIA --}}">Ficheiro a imprimir</a></td>
                <td class="col-sm-1"><strong>{{$printRequest->closed_user_id == null ? 'POR IMPRIMIR' : 'CONCLUIDO'}}</strong></td>
            </tr>
            </tbody>
        </table>
        <div class="panel-body">
            <div class="col-sm-4">{{-- //TODO ROTA DA SORAIA --}}</div>
            <div class="col-sm-8">{{$printRequest->description}}</div>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Requerente</h3>
        </div>
        <div class="panel-body">
            {{$user->name}}<br>
            {{$department->name}}<br>
            Email: {{$user->email}}<br>
            Telefone: {{$user->phone == null ? 'Sem número.' : $user->phone}}
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
                    <form action="{{route('createComment')}}" method="post">
                        {{csrf_field()}}
                        <input type="number" hidden value="{{$printRequest->id}}" name="requestId">
                        <textarea name="comment" rows="9" cols="120"></textarea>
                        <div class="pull-right">
                            <button type="submit" class="btn btn-danger">Comentar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>



        @foreach($comments as $comment)
            @include('requests.comment', ['comment' => $comment])
        @endforeach

    </div>

    @endsection