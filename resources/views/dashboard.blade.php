@extends('master')

@section('title', $title)

@section('navbar')
    <button type="button" class="btn btn-danger navbar-btn" href="home.html">Login</button>
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

        <div class="table-responsive col-md-5">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Departamento</th>
                    <th>Total impressões</th>
                </tr>
                </thead>

                <tbody>
                <tr>
                    <td class="text-left">Departamento Leiria</td>
                    <td class="text-right">100</td>
                </tr>
                <tr>
                    <td class="text-left">Departamento Abrantes</td>
                    <td class="text-right">100</td>
                </tr>
                <tr>
                    <td class="text-left">Departamento Entroncamento</td>
                    <td class="text-right">100</td>
                </tr>
                </tbody>
            </table>

        </div>

        <div class="col-md-3">
        </div>

        <div class="table-responsive col-md-4">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Telefone</th>
                </tr>
                </thead>

                <tbody>
                <tr>
                    <td class="text-left">Jose Migalha</td>
                    <td class="text-right">jmig@cmosl.com</td>
                    <td class="text-right">91222222</td>
                </tr>
                <tr>
                    <td class="text-left">Jose Migalha</td>
                    <td class="text-right">jmig@cmosl.com</td>
                    <td class="text-right">91222222</td>
                </tr>
                <tr>
                    <td class="text-left">Jose Migalha</td>
                    <td class="text-right">jmig@cmosl.com</td>
                    <td class="text-right">91222222</td>
                </tr>
                </tbody>
            </table>

        </div>
@endsection

