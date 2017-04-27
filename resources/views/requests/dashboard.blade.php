@extends('layouts/app')

{{-- INCLUIR NAV PARA USER AUTENTICADO --}}

@section('content')
    <div class="container">
        <h1 class="page-header">
            Pedidos
        </h1>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-3">Filtros
                <form>
                    <div class="form-group form-inline">
                        <select id="filterByStatus" class="form-control" name="filterByStatus">
                            <option value="" selected>Escolha um estado</option>
                            <option value="1">Concluido</option>
                            <option value="2">Em espera</option>
                        </select>

                        <select id="filterByopenDate" class="form-control" name="filterByopenDate">
                            <option value="" selected>Escolha uma data de pedido</option>
                            <option value="1">{{-- IR BUSCAR AS VARIAS DATAS --}}</option>

                        </select>

                        <select id="filterBydueDate" class="form-control" name="filterBydueDate">
                            <option value="" selected>Escolha uma data de conclusão</option>
                            <option value="1">{{-- IR BUSCAR AS VARIAS DATAS --}}</option>

                        </select>

                        <button type="submit" class="btn btn-primary">
                            Filtrar
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>

   <div class="table-responsive col-md-10">
        <table class="table table-hover">
            <thead>
            <tr>
                <th class="col-md-1">Nº do pedido</th>
                <th class="col-md-2">Descrição</th>
                <th class="col-md-1">Data do pedido</th>
                <th class="col-md-1">Data de conclusão</th>
                <th class="col-md-1">Estado</th>
                <th class="col-md-2">Acção</th> {{--mudar o nome desta coluna? --}}
            </tr>
            </thead>

            <tbody>

            {{--Preencher as colunas da tabela --}}

            @foreach($requests as $request)
                <tr>
                    <td class="col-md-1">{{$request->id}}</td>
                    <td class="col-md-2">{{$request->description}}</td>
                    <td class="col-md-1">{{$request->openDate}}</td>
                    <td class="col-md-1">{{$request->dueDate}}</td>

                    @if($request->status==0)
                        <td class="col-md-1">Em espera</td>
                    @endif

                    {{--else: imprimir Concluido --}}

                    {{--<td class="col-md-1">{{$request->status}}</td> --}}


                    @if($request->status==0){
                        {{-- apresentar botao para editar e remover--}}
                    @endif
                    {{--else : apresentar o botao avaliar --}}
                    <td class="col-md-4"> {{--Se o status for Concluido, apresenta Avaliar, se não, apresenta botoes editar/remover --}}

                        {{--fazer o if--}}

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
                </tr>
            @endforeach


            </tbody>
        </table>

    </div>
    @endsection
