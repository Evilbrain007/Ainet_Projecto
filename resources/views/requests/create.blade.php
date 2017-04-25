@extends('layouts/app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Criar Pedido</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="ainet.project/requests/create">
                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                <label for="description" class="col-md-4 control-label">Descição</label>
                                <div class="col-md-6">
                                    <input id="description" type="text" class="form-control" name="description" placeholder="Descrição do pedido" value="" required>

                                    @if($errors->has('description'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>

                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{$errors->has('request_deadline') ? 'has-error' : ''}}">
                                <label for="request_deadline" class="col-md-4 control-label">Data limite para concluir pedido </label>
                                <div class="col-md-6">
                                    <input id="request_deadline" type="date" class="form-control" name="request_deadline" value="">

                                    @if($errors->has('request_deadline'))
                                        <span class="help-block">
                                            <strong>{{$errors->first('request_deadline')}}</strong>
                                        </span>
                                        @endif
                                </div>
                            </div>

                            <div class="form-group{{$errors->has('copies_num') ? 'has-error' : ''}}">
                                <label for="copies_num" class="col-md-4 control-label">Número de cópias</label>
                                <div class="col-md-6">
                                    <input id="copies_num" type="number" class="form-control" name="copies_num" value="" required>
                                </div>


                                @if($errors->has('copies_num'))
                                    <span class="help-block">
                                        <strong>{{$errors->first('copies_num')}}</strong>
                                    </span>
                                    @endif
                            </div>

                            <div class="form-group{{$errors->has('color') ? 'has-error' : ''}}">
                                <label for="color" class="col-md-4 control-label">Seleccione a cor</label>
                                <div class="col-md-6">
                                    <div class="radio">
                                        <input id="color" type="radio"  name="color" value="pb" required>Preto e branco
                                    </div>
                                    <div class="radio">
                                        <input id="color" type="radio"  name="color" value="colored">Cores
                                    </div>
                                </div>

                                @if($errors->has('color'))
                                    <span class="help-block">
                                        <strong>{{$errors->first('color')}}</strong>
                                    </span>
                                    @endif
                            </div>

                            <div class="form-group{{$errors->has('staple') ? 'has-error' : ''}}">
                                <label for="staple" class="col-md-4 control-label">Com ou sem agrafo</label>
                                <div class="col-md-6">
                                    <div class="radio">
                                        <input id="staple" type="radio"  name="staple" value="with_staple" required>Com agrafo
                                    </div>
                                    <div class="radio">
                                        <input id="staple" type="radio"  name="staple" value="without_staple">Sem agrafo
                                    </div>
                                </div>

                                @if($errors->has('staple'))
                                    <span class="help-block">
                                        <strong>{{$errors->first('staple')}}</strong>
                                    </span>
                                @endif
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