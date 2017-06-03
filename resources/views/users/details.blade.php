@extends('layouts.master')

@section('title')

    <h1>{{$title}}</h1>

@endsection

@section('content')
    @if(Auth::check() && Auth::user()->admin == true)
    <div class="panel panel-danger">
        <div class="panel-heading">
            <h3 class="panel-title">Painel de administração</h3>
        </div>
        @endif
        <div class="panel-body">
            <div class="col-md-6">
                @if(Auth::check() && Auth::user()->admin == true)
                    @if($user->blocked == true)
                        <form class="form-inline" name="blocked"
                              action={{route('user.unblock', ['id' =>$user->id])}} method="post">
                            {{ csrf_field() }}
                            <label>Bloqueado &nbsp;
                                <input class="btn btn-danger disabled" type="button" value="Sim"/>
                            @unless(Auth::user() == $user)
                            </label>
                                <input class="btn btn-default" type="submit" value="Não">
                            @else
                                <input class="btn btn-default disabled" type="button" value="Não"/>
                            @endunless
                        </form>
                    @else
                        <form class="form-inline" name="blocked"
                              action={{route('user.block', ['id' =>$user->id])}} method="post">
                            {{ csrf_field() }}
                            <label>Bloqueado &nbsp;
                            @unless(Auth::user() == $user)
                                <input class="btn btn-default" type="submit" value="Sim">
                            @else
                                <input class="btn btn-default disabled" type="button" value="Sim"/>
                            @endunless
                            </label>
                            <input class="btn btn-danger disabled" type="button" value="Não"/>
                        </form>
                    @endif
            </div>
            <div class="col-md-6">
                @if($user->admin == true)
                    <form class="form-inline" name="admin"
                          action={{route('user.employee', ['id' =>$user->id])}} method="post">
                        {{ csrf_field() }}
                        <label>Administrador</label>
                        <input class="btn btn-primary disabled" type="button" value="Sim"/>
                        @unless(Auth::user() == $user)
                            <input class="btn btn-default" type="submit" value="Não">
                        @else
                            <input class="btn btn-default disabled" type="button" value="Não"/>
                        @endunless
                    </form>
                @else
                    <form class="form-inline" name="admin"
                          action={{route('user.admin', ['id' =>$user->id])}} method="post">
                        {{ csrf_field() }}
                        <label>Administrador
                        @unless(Auth::user() == $user)
                            <input class="btn btn-default" type="submit" value="Sim">
                        @else
                            <input class="btn btn-default disabled" type="button" value="Sim"/>
                        @endunless
                        </label>
                        <input class="btn btn-primary disabled" type="button" value="Não"/>
                    </form>
                @endif
            </div>
            @endif
        </div>
    </div>

    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title">{{$user->name}}</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-3 col-lg-3 ">{{--
                    <img alt="User Pic" src="http://babyinfoforyou.com/wp-content/uploads/2014/10/avatar-300x300.png" class="img-circle img-responsive">
                --}}
                    <img alt="User Pic" src="{{ route("user.image", ['user_id' => $user->id]) }}"
                         class="img-responsive">
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