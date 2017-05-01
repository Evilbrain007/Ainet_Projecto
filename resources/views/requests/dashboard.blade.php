@extends('master')

@section('content')
    <div class="container">
        <h1 class="page-header">
            Pedidos
        </h1>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12">Filtros
                {{-- FALTA A ROTA NO ACTION--}}
                <form class="form-group form-inline" action="" method="get">
                    <div >
                        <select id="filterByStatus" class="form-control" name="filterByStatus">
                            <option value="" selected>Escolha um estado</option>
                            <option value="1">Concluido</option>
                            {{--  mostra os pedidos concluidos --}}
                            <option value="2">Em espera</option>
                            {{--  mostra os pedidos em espera --}}
                        </select>

                        <select id="filterByopenDate" class="form-control" name="filterByopenDate">
                            <option value="" selected>Ordenar por data</option>
                            <option value="0">Crescente</option>
                            {{--  apresenta os dados na tabela por ordem crescente --}}
                            <option value="1">Decrescente</option>
                            {{--  apresenta os dados na tabela por ordem decrescente --}}

                        </select>

                        <select id="filterBydueDate" class="form-control" name="filterBydueDate">
                            <option value="" selected>Ordenar por data de conclusão</option>
                            <option value="0">Crescente</option>
                            {{--  apresenta os dados na tabela por ordem crescente --}}
                            <option value="1">Decrescente</option>
                            {{--  apresenta os dados na tabela por ordem decrescente --}}

                        </select>

                        <button type="submit" class="btn btn-primary">
                            Filtrar
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>

   <div class="table-responsive col-md-12">
        <table class="table table-hover">
            <thead>
            <tr>
                <th class="col-md-1">Nº do pedido</th>
                <th class="col-md-2">Descrição</th>
                <th class="col-md-2">Data do pedido</th>
                <th class="col-md-2">Data de conclusão</th>
                <th class="col-md-1">Estado</th>
                <th class="col-md-2">Acção</th> {{--mudar o nome desta coluna? --}}
            </tr>
            </thead>

            <tbody>

            {{--Preencher as colunas da tabela --}}

            @foreach($requests as $request)
                <tr>
                    <td class="col-md-1">{{$request->id}}</td>
                    <td class="col-md-2">{{substr($request->description, 0, 20)}}</td>
                    <td class="col-md-2">{{$request->openDate}}</td>
                    <td class="col-md-2">{{$request->dueDate}}</td>

                    @if($request->status==0)
                        <td class="col-md-1">Em espera</td>
                    @else
                        <td class="col-md-1">Concluído</td>
                    @endif


                    @if($request->status === 0){
                        {{-- apresentar botao para editar e remover--}}
                    <td class="col-md-4">

                        {{-- <form action="{{ route('requestDetails') }}" method="get">
                            <div class="form-group form-inline">
                                <button type="submit" class="btn btn-primary">
                                    Editar
                                </button>
                            </div>
                        </form>--}}


                        <a class="btn btn-primary" href="{{ route('editRequest', ['id'=>$request->id]) }}">Editar</a>
                        {{-- FALTA A ROTA NO ACTION--}}
                            <form action="" method="get">
                            <div class="form-group form-inline">
                                <button type="submit" class="btn btn-primary">
                                    Remover
                                </button>
                            </div>
                        </form>
                    </td>
                    @else
                    {{--else : apresentar opcoes para avaliar --}}
                        <td class="col-md-4">

                            {{-- FALTA A ROTA NO ACTION--}}
                            <form action="" method="post">
                                <div class="form-group form-inline">
                                    <select id="satisfactionGrade" class="form-control" name="satisfactionGrade">
                                        <option value="" selected>Avalie a qualidade do serviço</option>
                                        <option value="1">Mau</option>
                                        <option value="2">Médio</option>
                                        <option value="3">Bom</option>
                                    </select>
                                    <button type="submit" class="btn btn-primary">
                                        Avaliar
                                    </button>
                                </div>
                            </form>
                        </td>

                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>


    {{--FILTRAR COMENTARIOS --}}

    <div class="container">
        <div class="row">
            <div class="col-md-12">Filtros
                <form class="form-group form-inline">
                        <div >
                            <select id="orderByDate" class="form-control" name="orderByDate">
                                <option value="0" selected>Ordem</option>
                                <option value="1">Mais antigos</option>
                                {{--  mostra comentarios do mais antigo para o mais recente --}}
                                <option value="2">Mais recentes</option>
                                {{--  mostra comentarios do mais recente para o mais antigo --}}
                            </select>
                        </div>


                        <div >
                            <select id="filterByReplys" class="form-control" name="filterByReplys">
                                <option value="" selected>Filtrar por respostas</option>
                                <option value="0">Todos os comentários</option>
                                {{--  mostra comentarios do mais antigo para o mais recente --}}
                                <option value="1">Com respostas não lidas</option>
                                {{--  mostra comentarios do mais antigo para o mais recente --}}
                                <option value="2">Sem respostas</option>
                                {{--  mostra comentarios do mais recente para o mais antigo --}}
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            Filtrar
                        </button>
                </form>
            </div>
        </div>

    </div>


    {{--COMENTARIOS DOS UTILIZADORES --}}

    <div class="container">

        <div class="table-responsive col-md-12">
            <table class="table table-hover">

                <thead>
                <tr>
                    <th class="col-md-3">Nº do Comentário</th>
                    <th class="col-md-3">Descrição</th>
                    <th class="col-md-3">Data da última resposta</th>
                    {{--mudar a cor se tiver respostas nao lidas e por nº de respos
                     tas clicavel para poder ver as respostas--}}
                    <th class="col-md-1">Nº de Respostas</tr>
                </thead>

                <tbody>
                {{--so mostra comentarios se nao estiverem bloqueados --}}
                {{--filtrar e ordenar comentarios --}}

                @foreach($comments as $comment)
                    @if($comment->blocked != 1)
                        <tr>
                            <td class="col-md-3">{{$comment->id}}</td>
                            <td class="col-md-3">{{$comment->comment}}</td>
                            <td class="col-md-3">{{$comment->updated_at}}</td>

                            <td class="col-md-1">
                                <button type="submit" class="btn btn-primary">
                                    {{-- contar o numero de respostas e mostrar o numero como nome do botao --}}
                                    {{$comment['numberReplies']}}
                                </button>
                            </td>

                        </tr>
                    @endif


                @endforeach


                </tbody>



            </table>
        </div>

    </div>
    @endsection


