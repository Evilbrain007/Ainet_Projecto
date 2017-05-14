@if($comment->blocked != 1)
    <div class="panel-body">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><strong>{{\App\User::find($comment->user_id)->name}}</strong></h3>
            </div>
            <div class="panel-body">
                <p>{{$comment->comment}}</p>
                <div class="pull-right">
                    @if(Auth::user()->admin == true)<a class="btn btn-danger" href="home.html">Bloquear</a>@endif
                    <a class="btn btn-primary" href="home.html">Responder</a>
                </div>
            </div>
            <div class="panel-body">
                @foreach($comment->comment_children as $comment_child)
                    @include('requests.comment', ['comment' => $comment_child])
                @endforeach
            </div>
        </div>
    </div>
@endif