@extends('layouts.master')


@section('title')

    <h1>{{$title}}</h1>

@endsection


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">Filtros
                <form class="form-group form-inline" action="{{route('requests.dashboard')}}" method="get">
                    <div>
                        <select id="filterByStatus" class="form-control" name="filterByStatus">
                            <option value=""
                                    @if ($filters['status'] === '')
                                    selected
                                    @endif >Escolha um estado
                            </option>
                            {{--  mostra os pedidos em espera --}}
                            <option value="0"
                                    @if ($filters['status'] === '0')
                                    selected
                                    @endif>Em espera
                            </option>
                            {{--  mostra os pedidos concluidos --}}
                            <option value="1"
                                    @if ($filters['status'] === '1')
                                    selected
                                    @endif
                            >Concluido
                            </option>
                            {{--  mostra os pedidos recusados --}}
                            <option value="2"
                                    @if ($filters['status'] === '2')
                                    selected
                                    @endif
                            >Recusado
                            </option>
                        </select>

                        <select id="filterByopenDate" class="form-control" name="filterByopenDate">
                            <option value=""
                                    @if ($filters['openDate'] === '')
                                    selected
                                    @endif >Por data criação
                            </option>
                            {{--  apresenta os dados na tabela por ordem crescente --}}
                            <option value="cresc"
                                    @if ($filters['openDate'] === 'cresc')
                                    selected
                                    @endif>Mais antigos primeiro
                            </option>
                            {{--  apresenta os dados na tabela por ordem decrescente --}}
                            <option value="desc"
                                    @if ($filters['openDate'] === 'desc')
                                    selected
                                    @endif>Mais recentes primeiro
                            </option>
                        </select>

                        <select id="filterByClosedDate" class="form-control" name="filterByClosedDate">
                            <option value=""
                                    @if ($filters['closedDate'] === '')
                                    selected
                                    @endif>Por data de conclusão
                            </option>
                            {{--  apresenta os dados na tabela por ordem crescente --}}
                            <option value="cresc"
                                    @if ($filters['closedDate'] === 'cresc')
                                    selected
                                    @endif>Mais antigos primeiro
                            </option>
                            {{--  apresenta os dados na tabela por ordem decrescente --}}
                            <option value="desc"
                                    @if ($filters['closedDate'] === 'desc')
                                    selected
                                    @endif>Mais recentes primeiro
                            </option>

                        </select>
                        <select id="filterBydueDate" class="form-control" name="filterBydueDate">
                            <option value=""
                                    @if ($filters['dueDate'] === '')
                                    selected
                                    @endif> Por data limite
                            </option>
                            {{--  apresenta os dados na tabela por ordem crescente --}}
                            <option value="cresc"
                                    @if ($filters['dueDate'] === 'cresc')
                                    selected
                                    @endif>Mais antigos primeiro
                            </option>
                            {{--  apresenta os dados na tabela por ordem decrescente --}}
                            <option value="desc"
                                    @if ($filters['dueDate'] === 'desc')
                                    selected
                                    @endif>Mais recentes primeiro
                            </option>

                        </select>

                        {{--se o user autenticado for o admin apresentar mais opçoes de filtros --}}
                        @if(Auth::user()->admin == true)
                            <select id="filterByUserName" class="form-control" name="filterByUserName">
                                <option value=""
                                @if(!isset($filters['user']))
                                    selected
                                @endif
                                >Filtrar utilizador</option>
                                @foreach($users as $user)
                                    <option value="{{$user->id}}"
                                    @if($filters['user'] == $user->id)
                                        selected
                                    @endif
                                    >{{$user->name}}</option>
                                @endforeach

                            </select>
                        @endif

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
                <th class="col-md-2">Data de criação</th>
                <th class="col-md-2">Concluir até</th>
                <th class="col-md-2">Data de conclusão</th>
                <th class="col-md-1">Acção</th> {{--mudar o nome desta coluna? --}}
            </tr>
            </thead>

            <tbody>

            {{--Preencher as colunas da tabela --}}

            @foreach($requests as $request)
                <tr>
                    <td>
                        <a href="{{route('request.details', ['id' => $request->id])}}">{{$request->id}}</a>
                    </td>
                    <td>
                        <a href="{{route('request.details', ['id' => $request->id])}}">{{substr($request->description, 0, 20)}}</a>
                    </td>
                    <td>{{substr($request->created_at, 0, 10)}}</td>
                    <td>
                        @if($request->due_date === null)
                                N/A
                        @else
                            {{substr($request->due_date, 0, 10)}}
                        @endif
                    <td>
                        @if ($request->status !== "0")
                            {{substr($request->closed_date, 0, 10)}}
                    @endif
                    </td>

                    <td>
                        @if($request->status === 0)
                            Em espera
                        @elseif($request->status === 1)
                            Concluído
                        @elseif ($request->status === 2)
                            Recusado
                        @endif
                    </td>

                    <td>
                        @if (Auth::id() === $request->owner_id)
                            @if($request->status === 0)
                                {{-- apresentar botao para editar e remover--}}

                                <a class="col-md-4 btn btn-primary"
                                   href="{{ route('request.edit', ['printRequest'=>$request->id]) }}">Editar</a>
                                {{-- FALTA A ROTA NO ACTION--}}
                                <form action="{{route('request.remove')}}" class="col-md-4" method="POST">
                                    {{csrf_field()}} {{--usamos o field e nao o token pk o field gera um input hidden com o token --}}
                                    <div class="form-group form-inline">
                                        {{--quando usamos um link passa-se as variaveis pela rota como na linha acima
                                         quando é um form get ou post temos que criar um input  para podermos depois aceder as variaveis no controlador
                                         se o form for post esse campo tem k ser hiden para nao aparecer nada no link do browser--}}
                                        <input type="number" hidden value="{{$request->id}}" name="request_id">
                                        <button type="submit" class="btn btn-danger">
                                            Remover
                                        </button>
                                    </div>
                                </form>
                            @else
                                {{--else : apresentar opcoes para avaliar --}}
                                @if ($request->satisfaction_grade == 0)
                                    <form action="{{route('request.assess', ['id' => $request->id])}}" method="post">
                                        {{ csrf_field() }}
                                        <div class="form-group form-inline">
                                            <select id="satisfactionGrade" class="form-control"
                                                    name="satisfaction_grade">
                                                <option value="" selected>Qualidade do serviço</option>
                                                <option value="1">Mau</option>
                                                <option value="2">Médio</option>
                                                <option value="3">Bom</option>
                                            </select>
                                            <input class="btn btn-primary" type="submit" value="Avaliar">
                                        </div>
                                    </form>
                                @else
                                    @if ($request->satisfaction_grade === 1)
                                        Má qualidade do serviço
                                    @elseif($request->satisfaction_grade === 2)
                                        Média qualidade do serviço
                                    @elseif($request->satisfaction_grade === 3)
                                        Boa qualidade do serviço
                                    @else
                                        N/D
                                    @endif
                                @endif
                        @endif
                    @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{-- appends($_GET) mantém a lista filtrada --}}
        {{ $requests->appends($_GET)->links() }}

    </div>


    {{--FILTRAR COMENTARIOS --}}

    <div class="container">
        <div class="row">
            <div class="col-md-12">Filtros
                <form class="form-group form-inline">
                    <div>
                        <select id="orderByDate" class="form-control" name="orderByDate">
                            <option value="0" selected>Ordem</option>
                            <option value="1">Mais antigos</option>
                            {{--  mostra comentarios do mais antigo para o mais recente --}}
                            <option value="2">Mais recentes</option>
                            {{--  mostra comentarios do mais recente para o mais antigo --}}
                        </select>
                        <select id="filterByReplys" class="form-control" name="filterByReplys">
                            <option value="" selected>Filtrar por respostas</option>
                            <option value="0">Todos os comentários</option>
                            {{--  mostra comentarios do mais antigo para o mais recente --}}
                            <option value="1">Com respostas não lidas</option>
                            {{--  mostra comentarios do mais antigo para o mais recente --}}
                            <option value="2">Sem respostas</option>
                            {{--  mostra comentarios do mais recente para o mais antigo --}}
                        </select>
                        <button type="submit" class="btn btn-primary">
                            Filtrar
                        </button>
                    </div>

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
                    <th class="col-md-1">Nº de Respostas</th>
                </tr>
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


