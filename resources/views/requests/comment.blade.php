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

                </div>
                <div class="panel-body">
                    <form action="{{route('comment.response.create')}}" method="post">
                        {{csrf_field()}}
                        <input type="number" hidden value="{{$printRequest->id}}" name="requestId">
                        <input type="number" hidden value="{{$comment->id}}" name="parent"> {{--como ja estamos no comment pai passamos o id do pai e nao
                         o parent_id--}}
                        <textarea  name="comment" rows="9" cols="120"></textarea>
                        <div class="pull-right">
                            <button type="submit" class="btn btn-info">Responder</button>
                        </div>
                    </form>
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