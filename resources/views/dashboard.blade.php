@extends('master')

@section('title', $title)

@section('navbar')
    <div class="container">
        <button type="button" class="btn btn-danger navbar-btn navbar-right" href="home.html">Login</button>
    </div>
@endsection

@section('content')
    <div class="container">
        <h1 class="page-header">
            Página inicial
        </h1>
    </div>
    <div class="container text-center">
        <div class="row">
            <div class="col-md-3">Total de impressões</div>
            <div class="col-md-1">P/B</div>
            <div class="col-md-1">Cor</div>
            <div class="col-md-3">300 Impressoes hoje</div>
        </div>
        <div class="row">
            <div class="col-md-3">1280371</div>
            <div class="col-md-1">77%</div>
            <div class="col-md-1">23%</div>
            <div class="col-md-3">Média imp. diárias Abril: 100</div>
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
                        <td class="text-left">{{$department->name}}</td>
                        <td class="text-right">100</td>
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

        </div>
    </div>
@endsection

