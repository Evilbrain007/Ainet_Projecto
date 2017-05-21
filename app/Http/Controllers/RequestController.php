<?php

namespace App\Http\Controllers;

use App\Department;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use App\PrintRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Comment;

class RequestController extends Controller
{
    public function create()
    {
        $title = 'Criar Pedido';
        $printRequest = new PrintRequest();


        return view('requests/create', compact('title', 'printRequest'));
    }

    public function store(Request $request)
    {
        //dd($request);
        //$request->input('description');
        $owner_id = Auth::id();
        $full_path = $request->file('file')->store('print-jobs/' . $owner_id);
        $path = explode('/', $full_path)[2];


        $attributes = ['status' => 0,
            'description' => $request->input('description'),
            'quantity' => $request->input('quantity'),
            'paper_type' => $request->input('paper_type'),
            'colored' => $request->input('colored'),
            'stapled' => $request->input('stapled'),
            'paper_size' => $request->input('paper_size'),
            'file' => $path];
        if ($request->exists('due_date')) { //fazemos o if porque o utilizador pode ou não ter indicado uma data de conclusao
            $attributes ['due_date'] = $request->input('due_date');
        }

        $printRequest = PrintRequest::create($attributes);
        PrintRequest::store($printRequest);

        return redirect()->route('requestsDashboard');
    }

    /*public function details($id)
    {
        $title = 'Detalhes do produto';
        $printRequest = PrintRequest::find($id);

        return view('requests/details', compact('title', 'printRequest'));
    }*/


    public function details(PrintRequest $id)//O ID vai ser transformado no respectivo PrintRequest, se existir
    {
        $title = 'Detalhes do produto';

        $printRequest = $id;
        $user = User::find($printRequest->owner_id);
        $department = Department::find($user->department_id);
        // $user = $printRequest->  tenho que ir buscar o user a partir do request e depois o departamento
        //a partir do user. e tenho que devolver no return
        //deveria passar um array de parametros?
        $comments = $this->getComments($printRequest->id);
        return view('requests/details', compact('title', 'printRequest', 'user', 'department', 'comments'));
    }

    public function getComments($printRequestId)
    {
        $comments = Comment::where('request_id', $printRequestId)->where('parent_id', null)->get();

        if(!empty($comments)){
            $this->getChildren($comments);
        }

        return $comments;
    }

    private function getChildren($comments)
    {
        foreach ($comments as $comment) {
            $comment_children = Comment::where('parent_id', $comment->id)->get();
            if(!empty($comment_children)){
                $this->getChildren($comment_children);
                $comment ['comment_children'] = $comment_children;
            }
        }
    }

    public function edit(PrintRequest $id)
    {
        $printRequest = $id;

        $title = "Editar pedido nº $printRequest->id";
        $file_extension = pathinfo(storage_path() . '/print-jobs/' . $printRequest->owner_id . '/' . $printRequest->file, PATHINFO_EXTENSION);
        $path = null;

        if ($file_extension == 'odt' || $file_extension == 'pdf' || $file_extension == 'pptx'
            || $file_extension == 'xlsx'
        ) {
            $path = asset('images/' . $file_extension . '.png');
        } else {
            //aqui vai buscar a imagem à storage
            // $path=asset('images/printit.png');
            //asset(storage_path().'/print-jobs/'.$printRequest->owner_id. '/'. $printRequest->file)
            $path = route('getImageRequest', ['id' => $printRequest->id]);
        }

        return view('requests/create', compact('title', 'printRequest', 'path'));
    }

    public function getImageRequest(PrintRequest $id)
    {

        $printRequest = $id;

        $file_name = $printRequest->file;

        return response()->file(storage_path('app/print-jobs/' . $printRequest->owner_id . '/' . $file_name));
    }

    public function dashboard(Request $request)
    {
        $title = 'Pedidos';
        $owner_id = Auth::id();

        //verificar se o utilizador logado é admin ou nao

        //se for admin mostro todos os pedidos de todos os users

        //se for funcionadio mostra so os pedidos do proprio funcionario - feito
        //filtrar os pedidos do proprio funcionario

        $filters = ['status' => $request->input('filterByStatus'), //o input vai buscar o que foi inputado no formulario da dashboard nos respectivos campos
            'openDate' => $request->input('filterByopenDate'),
            'dueDate' => $request->input('filterBydueDate'),
            'user' => $request->input('filterByUserName')];

        //dd($filters);

        $requests = null; //PrintRequest::where('owner_id', $owner_id);
        $users = null;
        $comments = [];

        if(Auth::user()->admin == true){
           $requests = PrintRequest::paginate(5);
        //fazer um arry com todos os users que depois vai ser passado no return para na vista o admin poder escolher o utilizador
            $users = User::all();
          //  dd($users);
        } else{
            $requests = PrintRequest::where('owner_id', $owner_id);
            $requests = $requests->paginate(5);
        }

        //se nao houver filtros seleccionados, mostra todos os pedidos normalmente

        //verifica os pedidos filtrando os campos
        //falta filtrar por utilizador no caso de ser admin
        if (isset($filters['status'])) {
            $requests = $requests->where('status', $filters['status']);
        }

        if (isset($filters['openDate'])) {
            // $requests = $requests->orderBy('created_at', $filters['openDat    e'])->get();
            if ($filters['openDate'] == 'cresc') {
                $requests = $requests->where('owner_id', $owner_id)->oldest();
            } else {
                $requests = $requests->where('owner_id', $owner_id)->latest();
            }
        }

        if (isset($filters['dueDate'])) {
            // $requests = $requests->orderBy('due_date', $filters['dueDate'])->get();
            if ($filters['dueDate'] == 'cresc') {
                $requests = $requests->where('owner_id', $owner_id)->oldest('due_date');
            } else {
                $requests = $requests->where('owner_id', $owner_id)->latest('due_date');
            }
        }

        //$requests = $requests->paginate(5);


        foreach ($requests as $request) {
            $aux = Comment::where('request_id', $request->id)->get();
            foreach ($aux as $comment) {
                $numberReplies = Comment::where('parent_id', $comment->id)->count();
                if (!isset($comment->parent_id)) {
                    $comment['numberReplies'] = $numberReplies;
                    $comments [] = $comment;
                }

            }
        }

        return view('requests/dashboard', compact('title', 'requests', 'users', 'comments'));
    }

   /* public function createComment(Request $request)
    {
        $attributes = ['request_id'=>$request->input('request_id') ];

        $comment = Comment::create($attributes);
        Comment::store($comment);

        return redirect()->route('requestDetails', $attributes['request_id']);
    }*/

    //o Request é um objecto que é passado automaticamente quando se faz post
    public function update(Request $request, PrintRequest $id)
    {

        //recebemos o printRequest que vai ser alterado
        $printRequest = $id;
        //dd($request);

        $attributes = ['status' => 0,
            'description' => $request->input('description'),
            'quantity' => $request->input('quantity'),
            'paper_type' => $request->input('paper_type'),
            'colored' => $request->input('colored'),
            'stapled' => $request->input('stapled'),
            'paper_size' => $request->input('paper_size')];
        if ($request->exists('due_date')) { //fazemos o if porque o utilizador pode ou não ter indicado uma data de conclusao
            $attributes ['due_date'] = $request->input('due_date');
        }
        //chamamos o update (que é da superclasse Model e o $printRequest extende de Model)
        $printRequest->update($attributes);

        return redirect()->route('requestsDashboard');

    }

    public function remove(Request $request){

        $requestId = $request->input('request_id');


        $printRequest = PrintRequest::find($requestId);

        //TODO
        $printRequest->comment()->delete();
        $printRequest->delete();

    }

}
