@extends('layouts.master')

@section('title')

    <h1>{{ $title }}</h1>
@endsection

@section('content')
    <div class="table-responsive col-md-12">
        <table class="table table-hover">
            <thead>
            <tr>
                <th class="col-md-1">N.º</th>
                <th class="col-md-2">Data de criação</th>
                <th class="col-md-2">Utilizador</th>
                <th class="col-md-1">N.º de pedido</th>
                <th class="col-md-5">Comentário</th>
                <th class="col-md-1">Resposta ao n.º</th>
                <th class="col-md-1"></th>

            </tr>
            </thead>

            <tbody>
            @foreach($blockedComments as $blockedComment)
                <tr>
                    <td>{{$blockedComment->id}}</td>
                    <td>{{$blockedComment->created_at}}</td>
                    <td>
                        <a href="{{route('user.detail', ['id' => $blockedComment->user_id])}}">
                            {{$blockedComment->user->name}}
                        </a>
                    </td>
                    <td>
                        <a href="{{route('request.details', ['id' => $blockedComment->request_id])}}">
                        {{$blockedComment->request_id}}
                        </a>
                    </td>
                    <td>{{$blockedComment->comment}}</td>
                    <td>{{$blockedComment->parent_id}}</td>
                    <td>
                        <form action="{{route('comment.unblock', ['id' => $blockedComment->id])}}" class="col-md-4" method="POST">
                            {{csrf_field()}}
                            <input type="number" hidden value="{{$blockedComment->request_id}}" name="request_id">
                            <button type="submit" class="btn btn-danger">
                                Desbloquear
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
@endsection