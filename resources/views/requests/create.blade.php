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
                        <form class="form-horizontal" role="form" method="POST" action='/requests/create'
                        enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                <label for="description" class="col-md-4 control-label">Descição</label>
                                <div class="col-md-6">

                                    <textarea id="description" class="form-control" name="description" rows="5" cols="70"
                                              placeholder="Descrição do pedido" required>
                                        {{$printRequest->description}}
                                    </textarea>
                                    {{-- <input id="description" type="textarea" class="form-control" name="description" placeholder="Descrição do pedido"
                                           value="{{$printRequest->description}}" required> --}}

                                    @if($errors->has('description'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>

                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{$errors->has('due_date') ? 'has-error' : ''}}">
                                <label for="due_date" class="col-md-4 control-label">Data limite para concluir pedido </label>
                                <div class="col-md-6">
                                    <input id="due_date" type="date" class="form-control" name="due_date"
                                           value="{{substr($printRequest->due_date, 0, 10)}}">
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

                            <div class="form-group{{$errors->has('quantity') ? 'has-error' : ''}}">
                                <label for="quantity" class="col-md-4 control-label">Número de cópias</label>
                                <div class="col-md-6">
                                    <input id="quantity" type="number" class="form-control" name="quantity"
                                           value="{{$printRequest->quantity}}" required>
                                </div>


                                @if($errors->has('quantity'))
                                    <span class="help-block">
                                        <strong>{{$errors->first('quantity')}}</strong>
                                    </span>
                                    @endif
                            </div>

                            <div class="form-group{{$errors->has('paper_type') ? 'has-error' : ''}}">
                                <label for="paper_type" class="col-md-4 control-label">Tipo de papel</label>
                                <div class="col-md-6">
                                    <select id="paper_type" class="form-control" name="paper_type" required>

                                        <option value="" {{isset($printRequest->paper_type) ? '' : 'selected'}} >Escolha um tipo de papel</option>
                                        <option value="0" {{$printRequest->paper_type == 0 ? 'selected' : ''}} >Rascunho</option>
                                        <option value="1" {{$printRequest->paper_type == 1 ? 'selected' : ''}} >Normal</option>
                                        <option value="2" {{$printRequest->paper_type == 2 ? 'selected' : ''}} >Fotográfico</option>
                                    </select>
                                </div>

                                @if($errors->has('paper_type'))
                                    <span class="help-block">
                                        <strong>{{$errors->first('paper_type')}}</strong>
                                    </span>
                                @endif

                            </div>

                            <div class="form-group{{$errors->has('colored') ? 'has-error' : ''}}">
                                <label for="colored" class="col-md-4 control-label">Seleccione a cor</label>
                                <div class="col-md-6">
                                    <div class="radio">
                                        <input id="colored" type="radio"  name="colored" value="0"
                                               {{$printRequest->colored == 0 ? 'checked' : ''}} required>Preto e branco
                                    </div>
                                    <div class="radio">
                                        <input id="colored" type="radio"  name="colored" value="1"
                                            {{$printRequest->colored == 1 ? 'checked' : ''}}>Cores
                                    </div>
                                </div>

                                @if($errors->has('colored'))
                                    <span class="help-block">
                                        <strong>{{$errors->first('colored')}}</strong>
                                    </span>
                                    @endif
                            </div>

                            <div class="form-group{{$errors->has('stapled') ? 'has-error' : ''}}">
                                <label for="stapled" class="col-md-4 control-label">Com ou sem agrafo</label>
                                <div class="col-md-6">
                                    <div class="radio">
                                        <input id="stapled" type="radio"  name="stapled" value="1"
                                               {{$printRequest->stapled == 1 ? 'checked' : ''}}required>Com agrafo
                                    </div>
                                    <div class="radio">
                                        <input id="stapled" type="radio"  name="stapled" value="0"
                                        {{$printRequest->stapled == 0 ? 'checked' : ''}}>Sem agrafo
                                    </div>
                                </div>

                                @if($errors->has('stapled'))
                                    <span class="help-block">
                                        <strong>{{$errors->first('stapled')}}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group{{$errors->has('paper_size') ? 'has-error' : ''}}">
                                <label for="paper_size" class="col-md-4 control-label">Tamanho do papel</label>
                                <div class="col-md-6">
                                    <div class="radio">
                                        <input id="paper_size" type="radio"  name="paper_size" value="3"
                                               {{$printRequest->paper_size == 3 ? 'checked' : ''}} required>A3
                                    </div>
                                    <div class="radio">
                                        <input id="paper_size" type="radio"  name="paper_size" value="4"
                                                {{$printRequest->paper_size == 4 ? 'checked' : ''}}>A4
                                    </div>
                                </div>

                                @if($errors->has('paper_size'))
                                    <span class="help-block">
                                        <strong>{{$errors->first('paper_size')}}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group{{$errors->has('file') ? 'has-error' : ''}}">
                                <label for="file" class="col-md-4 control-label">Seleccione um ficheiro</label>
                                <div class="col-md-6">
                                    <input id="file" type="file"  name="file" required>
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
                                        Criar
                                    </button>
                                </div>
                            </div>

{{--
 <div class="form-group{{$errors->has('colour') ? 'has-error' : ''}}">
                                <label for="colour" class="col-md-4 control-label">Seleccione a cor</label>
                                <div class="col-md-6">
                                    <select id="colour" class="form-control" required>
                                        <option value="" selected>Escolha a opção</option>
                                        <option value="cores">Impressão a cores</option>
                                        <option value="pb">Impressão a preto e branco</option>
                                    </select>
                                </div>

                                @if($errors->has('colour'))
                                    <span class="help-block">
                                        <strong>{{$errors->first('colour')}}</strong>
                                    </span>
                                    @endif
                            </div>

 --}}


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection