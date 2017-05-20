@extends('layouts.master')

@section('title')

    <h1>Pedido {{$printRequest->id}}
        <small>{{substr($printRequest->created_at, 0, 10)}}</small>
    </h1>
    <h5 class="text-muted"><strong>
            @if($printRequest->status === 0)
                POR IMPRIMIR
            @elseif ($printRequest->status === 1)
                CONCLUÍDO
            @elseif ($printRequest->status === 2)
                RECUSADO
            @endif
        </strong>
    </h5>
    @if($printRequest->due_date !== null)
        <h5 class="text-muted">Concluir até: {{substr($printRequest->due_date, 0, 10)}}</h5>
    @endif

@endsection

@section('content')

    @if(Auth::user()->admin == true && $printRequest->status === 0)
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Administração</h3>
            </div>
            <div class="panel-body">
                <form class="form-inline"
                      action={{route('request.close', ['id' => $printRequest->id])}} method="post">
                    {{ csrf_field() }}
                    <input class="btn btn-primary" type="submit" value="Concluir pedido">
                    <label for="printers">Impressora usada:</label>
                    <select name="printer">
                        @foreach($printers as $printer)
                            <option value="{{$printer->id}}">{{$printer->name}}</option>
                        @endforeach
                    </select>
                </form>
                <form class="form-inline"
                      action={{route('request.refuse', ['id' => $printRequest->id])}} method="post">
                    {{ csrf_field() }}
                    <input class="btn btn-danger" type="submit" value="Recusar pedido">
                    <div class="form-group">
                        <label for="refused_reason">Motivo de recusa: </label>
                        <input name="refused_reason" id="refused_reason" type="textarea" value="">
                    </div>
                </form>
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
                <td class="col-sm-1">{{$printRequest->colored ? 'A cores' : 'Preto e branco'}}</td>
                <td class="col-sm-1">{{$printRequest->front_back ? 'Frente e verso' : 'Só frente'}}</td>
                <td class="col-sm-1">{{$printRequest->front_back ? 'Agrafado' : 'Não agrafado'}}</td>
                <td class="col-sm-1">A{{$printRequest->paper_size}}</td>
                <td class="col-sm-1">{{$printRequest->paper_type == 2 ? 'Papel de fotografia' :
                 $printRequest->paper_type == 1 ? 'Normal' : 'Rascunho'}}</td>
                <td class="col-sm-1"><a href="{{route('request.file', ['id' => $printRequest->id])}}">Ficheiro a imprimir</a></td>
                <td class="col-sm-1">
                    <strong>
                        @if($printRequest->status === 0)
                            POR IMPRIMIR
                        @elseif ($printRequest->status === 1)
                            CONCLUÍDO
                        @elseif ($printRequest->status === 2)
                            RECUSADO
                        @endif
                    </strong>
                </td>
            </tr>
            </tbody>
        </table>
        <div class="panel-body">
            <div class="col-sm-4">{{-- //TODO ROTA DA SORAIA --}}</div>
            <div class="col-sm-8">{{$printRequest->description}}</div>
        </div>
    </div>

    @if ($printRequest->status === 1)
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">Impressora usada</h3>
            </div>
            <div class="panel-body">
                @if ($printRequest->printer !== null)
                    {{$printRequest->printer->name}}
                @else
                    Não é possível determinar a impressora usada
                @endif
            </div>
        </div>
    @endif


    @if ($printRequest->status === 2)
        <div class="panel panel-danger">
            <div class="panel-heading">
                <h3 class="panel-title">Motivo de recusa do pedido</h3>
            </div>
            <div class="panel-body">
                {{$printRequest->refused_reason}}
            </div>
        </div>
    @endif

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
        @foreach($errors->all() as $error)
            <div class="has-error">
                <span class="help-block text-center">
                    <strong>{{ $error }}</strong>
                </span>
            </div>
        @endforeach
        <div class="panel-body">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Deixe o seu comentário</h3>
                </div>
                <div class="panel-body">
                    <form action="{{route('comment.create')}}" method="post">
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