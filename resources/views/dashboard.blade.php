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
            <div class="col-md-1">{{$statistics['bwColoredPrintsRatio']}}</div>
            <div class="col-md-1">{{$statistics['coloredBWPrintsRatio']}}</div>
            <div class="col-md-3">Média imp. diárias deste
                mês: {{number_format($statistics['printAvgCurrentMonth'],2)}}</div>
        </div>

        <div class="table-responsive col-md-6">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Departamento</th>
                    <th>Total impressões</th>
                </tr>
                </thead>

                <tbody>


                @foreach($departments as $department)
                    <tr>
                        <td class="text-left">
                            <a href="{{route('departmentDetail', ['id' => $department->id])}}">
                                {{$department->name}}
                            </a></td>
                        <td class="text-right">{{$department->totalPrints}}</td>
                    </tr>
                @endforeach

                </tbody>
            </table>

        </div>

        <div class="table-responsive col-md-6">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Telefone</th>
                </tr>
                </thead>

                <tbody>

                @foreach($users as $user)
                    <tr>
                        <td class="text-left">{{$user->name}}</td>
                        <td class="text-right">{{$user->email}}</td>
                        <td class="text-right">{{$user->phone}}</td>
                    </tr>
                @endforeach

                </tbody>
            </table>
            {{ $users->links() }}
                <form action= {{route('home')}} method="get">
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

