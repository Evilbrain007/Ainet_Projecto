@extends('layouts.master')

@section('title')

    <h1>{{$title}}</h1>

@endsection

@section('content')

    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title">{{$user->name}}</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-3 col-lg-3 " align="center">
                    <img alt="User Pic" src="{{ route("getUserImage", ['user_id' => $user->id]) }}" class="img-responsive">
                </div>

                <div class=" col-md-9 col-lg-9 ">
                    <table class="table table-user-information">
                        <tbody>
                        <tr>
                            <td>E-Mail:</td>
                            <td>{{$user->email}}</td>
                        </tr>
                        <tr>
                            <td>Departamento:</td>
                            <td>{{$department->name}}</td>
                        </tr>
                        <tr>
                            <td>Telefone:</td>
                            <td>{{$user->phone}}</td>
                        </tr>
                        <tr>
                            <td>Quantidade de Impressões</td>
                            <td>{{$user->print_counts}}</td>
                        </tr>
                        <tr>
                            <td>Quantidade de Avaliações</td>
                            <td>{{$user->print_evals}}</td>
                        </tr>
                        <tr>
                            <td>Data de Criação do Utilizador:</td>
                            <td>{{$user->created_at}}</td>
                        </tr>
                        <tr>
                            <td>Perfil Externo:</td>
                            <td>{{$user->profile_url}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <h4>Apresentação:</h4>
            <p>{{$user->presentation}}</p>
        </div>
    </div>

@endsection