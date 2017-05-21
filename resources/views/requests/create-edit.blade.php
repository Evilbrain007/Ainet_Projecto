@extends('layouts.master')

@section('title')

    <h1>{{$title}}</h1>

@endsection


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">{{$title}}</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{$printRequest->id === null ?
                        route('request.create') : route('request.update', $printRequest->id)}}"
                              enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                                <label for="description" class="col-md-4 control-label">Descrição</label>
                                <div class="col-md-6">

                                    <textarea id="description" class="form-control" name="description" rows="5"
                                              cols="70"
                                              placeholder="Descrição do pedido" required>{{$description}}</textarea>
                                    {{-- <input id="description" type="textarea" class="form-control" name="description" placeholder="Descrição do pedido"
                                           value="{{$printRequest->description}}" required> --}}

                                    @if($errors->has('description'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>

                                    @endif
                                </div>
                            </div>

                            <div class="form-group {{$errors->has('due_date') ? 'has-error' : ''}}">
                                <label for="due_date" class="col-md-4 control-label">Data limite para concluir
                                    pedido </label>
                                <div class="col-md-6">
                                    <input id="due_date" type="date" class="form-control" name="due_date"
                                           value="{{$due_date, 0, 10}}">
                                    {{-- antes de por la a data verificar com o isset pk este campo é opcional
                                    e a data pd nao ter sido seleccionada}}
                            {{--FALTA POR AQUI A DATA DE CONCLUSAO --}}

                                    @if($errors->has('due_date'))
                                        <span class="help-block">
                                            <strong>{{$errors->first('due_date')}}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group {{$errors->has('quantity') ? 'has-error' : ''}}">
                                <label for="quantity" class="col-md-4 control-label">Número de cópias</label>
                                <div class="col-md-6">
                                    <input id="quantity" type="number" class="form-control" name="quantity"
                                           value="{{$quantity}}" required>

                                @if($errors->has('quantity'))
                                    <span class="help-block">
                                        <strong>{{$errors->first('quantity')}}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>

                            <div class="form-group {{$errors->has('paper_type') ? 'has-error' : ''}}">
                                <label for="paper_type" class="col-md-4 control-label">Tipo de papel</label>
                                <div class="col-md-6">
                                    <select id="paper_type" class="form-control" name="paper_type" required>

                                        <option value="" {{!isset($paper_type) ? '' : 'selected'}} >Escolha
                                            um tipo de papel
                                        </option>
                                        <option value="0" {{$paper_type === "0" ? 'selected' : ''}} >
                                            Rascunho
                                        </option>
                                        <option value="1" {{$paper_type === "1" ? 'selected' : ''}} >Normal
                                        </option>
                                        <option value="2" {{$paper_type === "2" ? 'selected' : ''}} >
                                            Fotográfico
                                        </option>
                                    </select>

                                @if($errors->has('paper_type'))
                                    <span class="help-block">
                                        <strong>{{$errors->first('paper_type')}}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>

                            <div class="form-group {{$errors->has('colored') ? 'has-error' : ''}}">
                                <label for="colored" class="col-md-4 control-label">Seleccione a cor</label>
                                <div class="col-md-6">
                                    <div class="radio">
                                        <input id="colored" type="radio" name="colored" value="0"
                                               {{$colored === "0" ? 'checked' : ''}} required>Preto e branco
                                    </div>
                                    <div class="radio">
                                        <input id="colored" type="radio" name="colored" value="1"
                                                {{$colored === "1" ? 'checked' : ''}}>Cores
                                    </div>

                                @if($errors->has('colored'))
                                    <span class="help-block">
                                        <strong>{{$errors->first('colored')}}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>

                            <div class="form-group {{$errors->has('stapled') ? 'has-error' : ''}}">
                                <label for="stapled" class="col-md-4 control-label">Com ou sem agrafo</label>
                                <div class="col-md-6">
                                    <div class="radio">
                                        <input id="stapled" type="radio" name="stapled" value="1"
                                                {{$stapled === "1" ? 'checked' : ''}}>Com agrafo
                                    </div>
                                    <div class="radio">
                                        <input id="stapled" type="radio" name="stapled" value="0"
                                                {{$stapled === "0" ? 'checked' : ''}}>Sem agrafo
                                    </div>

                                @if($errors->has('stapled'))
                                    <span class="help-block">
                                        <strong>{{$errors->first('stapled')}}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>

                            <div class="form-group {{$errors->has('paper_size') ? 'has-error' : ''}}">
                                <label for="paper_size" class="col-md-4 control-label">Tamanho do papel</label>
                                <div class="col-md-6">
                                    <div class="radio">
                                        <input id="paper_size" type="radio" name="paper_size" value="3"
                                               {{$paper_size === "3" ? 'checked' : ''}} required>A3
                                    </div>
                                    <div class="radio">
                                        <input id="paper_size" type="radio" name="paper_size" value="4"
                                                {{$paper_size === "4" ? 'checked' : ''}}>A4
                                    </div>

                                @if($errors->has('paper_size'))
                                    <span class="help-block">
                                        <strong>{{$errors->first('paper_size')}}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>

                            <div class="form-group {{$errors->has('front_back') ? 'has-error' : ''}}">
                                <label for="front_back" class="col-md-4 control-label">Frente e verso</label>
                                <div class="col-md-6">
                                    <div class="radio">
                                        <input id="front_back" type="radio" name="front_back" value="0"
                                               {{$front_back === "0" ? 'checked' : ''}} required>Não
                                    </div>
                                    <div class="radio">
                                        <input id="front_back" type="radio" name="front_back" value="1"
                                                {{$front_back === "1" ? 'checked' : ''}}>Sim
                                    </div>

                                @if($errors->has('front_back'))
                                    <span class="help-block">
                                        <strong>{{$errors->first('front_back')}}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>

                            <div class="form-group {{$errors->has('file') ? 'has-error' : ''}}">
                                @if($printRequest->file == null)
                                    <label for="file" class="col-md-4 control-label">Seleccione um ficheiro</label>
                                    <div class="col-md-6">
                                        <input id="file" type="file" name="file" required>
                                @else
                                    <label for="file" class="col-md-4 control-label">Ficheiro carregado</label>
                                    <div class="col-md-6">
                                            <img alt="imagem" src="{{$path}}" class="img-responsive" {{--width="80" height="80" --}}>
                                    {{-- mostra ficheiro exsitente--}}
                                @endif

                                {{--*****AKI VAI TER K VERIFICAR FORMATO VALIDO: IMAGEM(JPG, TIFF, PNG ...)
                          WORD, EXCEL, ODT, PDF --}}

                                @if($errors->has('file'))
                                    <span class="help-block">
                                        <strong>{{$errors->first('file')}}</strong>
                                    </span>
                                @endif
                                </div>

                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        @if($printRequest->id == null)
                                            Criar
                                        @else
                                            Alterar
                                        @endif
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