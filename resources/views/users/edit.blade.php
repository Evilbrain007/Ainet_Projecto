@extends('layouts.master')

@section('title')

    <h1>{{$title}}</h1>

@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Editar</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST"
                              action="{{ route('user.update', ['id' => $user->id]) }}" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Nome</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name"
                                           placeholder="Nome do Utilizador"
                                           value="@if(old('name')){{ old('name') }}@else{{$user->name}}@endif" required
                                           autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">Email</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email"
                                           placeholder="Email do Utilizador"
                                           value="@if(old('email')){{ old('email') }}@else{{$user->email}}@endif"
                                           required>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                <label for="inputPhone" class="col-md-4 control-label">Telefone</label>

                                <div class="col-md-6">
                                    <input type="number" class="form-control" name="phone" id="inputPhone"
                                           placeholder="Telefone"
                                           value="@if(old('phone')){{ old('phone') }}@else{{$user->phone}}@endif"
                                           required/>

                                    @if ($errors->has('phone'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('department') ? ' has-error' : '' }}">
                                <label for="inputDepartment" class="col-md-4 control-label">Departamento</label>

                                <div class="col-md-6">
                                    <select name="department_id" class="form-control" id="inputDepartment">
                                        @foreach($departments as $department)
                                            <option value="{{$department->id}}"
                                                    @if($department->id==$user->department_id)
                                                    selected
                                                    @endif
                                            >{{$department->name}}
                                            </option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('department'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('department') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{$errors->has('file') ? 'has-error' : ''}}">
                                <label for="file" class="col-md-4 control-label">Seleccione uma fotografia</label>
                                <div class="col-md-3" align="center">
                                    <img alt="User Pic" src="{{ route("user.image", ['user_id' => $user->id]) }}" class="img-responsive">
                                </div>
                                <div class="col-md-3">
                                    <input id="file" type="file" name="file" required>
                                    {{--*****AKI VAI TER K VERIFICAR FORMATO VALIDO: IMAGEM(JPG, TIFF, PNG ...)
                              WORD, EXCEL, ODT, PDF --}}
                                </div>
                                @if($errors->has('file'))
                                    <span class="help-block">
                                        <strong>{{$errors->first('file')}}</strong>
                                    </span>
                                @endif

                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Editar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
