@extends('master')


@section('title', $title)
{{-- INCLUIR NAV PARA USER AUTENTICADO --}}
    @section('navbar')

        @include('nav_logged_in')

        @endsection

@section('content')
    <div class="container">
        <h1 class="page-header">
            Pedidos
        </h1>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-10">Filtros
                <form class="form-group form-inline">
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
                <th class="col-md-2">Nº do pedido</th>
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
                    <td class="col-md-2">{{$request->id}}</td>
                    <td class="col-md-2">{{$request->description}}</td>
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
                        <form>
                            <div class="form-group form-inline">
                                <button type="submit" class="btn btn-primary">
                                    Editar
                                </button>
                            </div>
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
                            <form>
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
    @endsection
