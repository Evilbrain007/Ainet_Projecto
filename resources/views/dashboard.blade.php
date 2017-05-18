@extends('layouts.master')

@section('title')

    <h1>{{$title}}</h1>

@endsection

@section('content')
    <div class="container text-center">
        <div class="row">
            <div class="col-md-3">Total de impressões</div>
            <div class="col-md-1">P/B</div>
            <div class="col-md-1">Cor</div>
            <div class="col-md-3">
                @if($statistics['totalPrintsToday'] === 1)
                    {{$statistics['totalPrintsToday']}} impressão hoje
                @else
                    {{$statistics['totalPrintsToday']}} impressões hoje
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">{{$statistics['totalPrints']}}</div>
            <div class="col-md-1">{{number_format((float)$statistics['bwColoredPrintsRatio'],2)}} %</div>
            <div class="col-md-1">{{number_format((float)$statistics['coloredBWPrintsRatio'],2)}} %</div>
            <div class="col-md-3">Média imp. diárias deste
                mês: {{number_format($statistics['printAvgCurrentMonth'],2)}}</div>
        </div>

        <div class="table-responsive col-md-3">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Departamento</th>
                    <th>Impressões</th>
                </tr>
                </thead>

                <tbody>


                @foreach($departments as $department)
                    <tr>
                        <td class="text-left">
                            <a href="{{route('department.detail', ['id' => $department->id])}}">
                                {{$department->name}}
                            </a></td>
                        <td class="text-right">{{$department->totalPrints}}</td>
                    </tr>
                @endforeach

                </tbody>
            </table>

        </div>

        <div class="table-responsive col-md-9">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th th class="col-md-2">Telefone</th>
                    @if(Auth::check() && Auth::user()->admin == true)
                        <th class="col-md-2">
                            Bloqueado
                        </th>
                        <th th class="col-md-2">
                            Administrador
                        </th>
                    @endif

                </tr>
                </thead>

                <tbody>

                @foreach($users as $user)
                    <tr>
                        <td class="text-left">
                            <a href="{{route('user.detail', ['id' =>$user->id])}}">
                                {{$user->name}}
                            </a></td>
                        <td class="text-right">{{$user->email}}</td>
                        <td class="text-right">{{$user->phone}}</td>
                        @if(Auth::check() && Auth::user()->admin == true)
                            <td>
                                @if($user->blocked == true)
                                    <form class="form-inline"
                                          action={{route('user.unblock', ['id' =>$user->id])}} method="post">
                                        {{ csrf_field() }}
                                        <input class="btn btn-danger disabled" type="button" value="Sim"/>
                                        @unless(Auth::user() == $user)
                                            <input class="btn btn-default" type="submit" value="Não">
                                        @else
                                            <input class="btn btn-default disabled" type="button" value="Não"/>
                                        @endunless
                                    </form>
                                @else
                                    <form class="form-inline"
                                          action={{route('user.block', ['id' =>$user->id])}} method="post">
                                        {{ csrf_field() }}
                                        @unless(Auth::user() == $user)
                                            <input class="btn btn-default" type="submit" value="Sim">
                                        @else
                                            <input class="btn btn-default disabled" type="button" value="Sim"/>
                                        @endunless
                                        <input class="btn btn-danger disabled" type="button" value="Não"/>
                                    </form>
                                @endif
                            </td>
                            <td>
                                @if($user->admin == true)
                                    <form class="form-inline"
                                          action={{route('user.employee', ['id' =>$user->id])}} method="post">
                                        {{ csrf_field() }}
                                        <input class="btn btn-primary disabled" type="button" value="Sim"/>
                                        @unless(Auth::user() == $user)
                                            <input class="btn btn-default" type="submit" value="Não">
                                        @else
                                            <input class="btn btn-default disabled" type="button" value="Não"/>
                                        @endunless
                                    </form>
                                @else
                                    <form class="form-inline"
                                          action={{route('user.admin', ['id' =>$user->id])}} method="post">
                                        {{ csrf_field() }}
                                        @unless(Auth::user() == $user)
                                            <input class="btn btn-default" type="submit" value="Sim">
                                        @else
                                            <input class="btn btn-default disabled" type="button" value="Sim"/>
                                        @endunless
                                        <input class="btn btn-primary disabled" type="button" value="Não"/>
                                    </form>
                                @endif
                            </td>
                        @endif
                    </tr>
                @endforeach

                </tbody>
            </table>
            {{ $users->links() }}
            <form action={{route('home')}} method="get">
                <label class="radio-inline">
                    <input type="radio" name="userOrder" value="asc" @if($selectedUserAsc === true) checked @endif>
                    Ascendente</label>
                <label class="radio-inline">
                    <input type="radio" name="userOrder" value="desc" @if($selectedUserAsc === false) checked @endif>
                    Descendente</label>
                &nbsp&nbsp
                <input type="submit" value="Ordenar" class="btn btn-default">
            </form>

        </div>
    </div>
@endsection

