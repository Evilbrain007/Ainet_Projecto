<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Department;
use App\Printer;
use App\PrintRequest;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

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

        $this->validate($request, [
            'description' => 'required|max:255',
            'due_date' => 'date|after:tomorrow',
            'quantity' => 'required|numeric|between:1,1000',
            'paper_type' => 'required|numeric|between:0,2',
            'colored' => 'required|boolean',
            'stapled' => 'required|boolean',
            'paper_size' => 'required|numeric|between:3,4',
            'front_back' => 'required|boolean',
            'file' => 'required|mimes:jpeg,bmp,png,odt,pdf,pptx,xlsx',
        ]);

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

        return redirect()->route('requests.dashboard');
    }

    public function details(PrintRequest $id)//O ID vai ser transformado no respectivo PrintRequest, se existir
    {
        $title = 'Detalhes do pedido';

        $printRequest = $id;
        $user = User::find($printRequest->owner_id);
        $department = Department::find($user->department_id);
        $comments = $this->getComments($printRequest->id);

        if (Auth::user()->admin == true) {
            $printers = Printer::all();
            return view('requests/details', compact('title', 'printRequest', 'user', 'department', 'comments', 'printers'));
        } else {
            return view('requests/details', compact('title', 'printRequest', 'user', 'department', 'comments'));
        }
    }

    public function getComments($printRequestId)
    {
        $comments = Comment::where('request_id', $printRequestId)->where('parent_id', null)->get();

        if (!empty($comments)) {
            $this->getChildren($comments);
        }

        return $comments;
    }

    private function getChildren($comments)
    {
        foreach ($comments as $comment) {
            $comment_children = Comment::where('parent_id', $comment->id)->get();
            if (!empty($comment_children)) {
                $this->getChildren($comment_children);
                $comment ['comment_children'] = $comment_children;
            }
        }
    }

    public function edit(PrintRequest $printRequest)
    {

        // se o utilizador não for o utilizador autenticado, volta para o dashboard de pedidos
        $message = ['message_error' => 'Endereço inválido.'];
        if (Auth::id() !== $printRequest->owner_id){
            return redirect(route('requests.dashboard'))->with($message);
        }

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
            $path = route('request.image', ['id' => $printRequest->id]);
        }

        return view('requests/edit', compact('title', 'printRequest', 'path'));
    }

    public function getFile(PrintRequest $id)
    {
        $printRequest = $id;

        // se o utilizador não for o utilizador autenticado ou admin, volta para o dashboard de pedidos
        $message = ['message_error' => 'Ficheiro não disponível.'];
        if (Auth::user()->admin == true || Auth::id() !== $printRequest->owner_id){
            return redirect(route('requests.dashboard'))->with($message);
        }

        $file_name = $printRequest->file;

        return response()->file(storage_path('app/print-jobs/' . $printRequest->owner_id . '/' . $file_name));
    }

    public function dashboard(Request $request)
    {
        $owner_id = Auth::id();

        $comments = [];
        if (Auth::user()->admin == true) {
            $title = 'Todos os pedidos';
            $requests = DB::table('requests');
        } else {
            $title = 'Pedidos de '.Auth::user()->name;
            $requests = PrintRequest::where('owner_id', $owner_id);
        }

        //se for funcionadio mostra so os pedidos do proprio funcionario - feito
        //filtrar os pedidos do proprio funcionario

        $filters = ['status' => $request->input('filterByStatus'), //o input vai buscar o que foi inputado no formulario da dashboard nos respectivos campos
            'openDate' => $request->input('filterByopenDate'),
            'closedDate' => $request->input('filterBydueDate')];

        //se nao houver filtros seleccionados, mostra todos os pedidos normalmente
        if (isset($filters['status'])) {
            $requests = $requests->where('status', $filters['status']);
        }

        if (isset($filters['openDate'])) {
            if ($filters['openDate'] == 'cresc') {
                $requests = $requests->oldest();
            } elseif ($filters['openDate'] == 'desc') {
                $requests = $requests->latest();
            }
        }

        if (isset($filters['closedDate'])) {
            if ($filters['closedDate'] == 'cresc') {
                $requests = $requests->oldest('closed_date');
            } elseif ($filters['closedDate'] == 'desc') {
                $requests = $requests->latest('closed_date');
            }
        }

        $requests = $requests->paginate(5);

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
        return view('requests.dashboard', compact('title', 'requests', 'comments', 'filters'));
    }

    /* public function createComment(Request $request)
     {
         $attributes = ['request_id'=>$request->input('request_id') ];

         $comment = Comment::create($attributes);
         Comment::store($comment);

         return redirect()->route('request.details', $attributes['request_id']);
     }*/

    //o Request é um objecto que é passado automaticamente quando se faz post
    public function update(Request $request, PrintRequest $printRequest)
    {

        $this->validate($request, [
            'description' => 'required|max:255',
            'due_date' => 'nullable|date|after:tomorrow',
            'quantity' => 'required|numeric|between:1,1000',
            'paper_type' => 'required|numeric|between:0,2',
            'colored' => 'required|boolean',
            'stapled' => 'required|boolean',
            'paper_size' => 'required|numeric|between:3,4',
            'front_back' => 'required|boolean',
        ]);


        // se o utilizador não for o utilizador autenticado, volta para o dashboard de pedidos
        $message = ['message_error' => 'Endereço inválido.'];
        if (Auth::id() !== $printRequest->owner_id){
            return redirect(route('requests.dashboard'))->with($message);
        }

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

        return redirect()->route('requests.dashboard');

    }

    public function remove(Request $request)
    {
        $requestId = $request->input('request_id');

        $printRequest = PrintRequest::find($requestId);

        // se o utilizador não for o utilizador autenticado, volta para o dashboard de pedidos
        $message = ['message_error' => 'Endereço inválido.'];
        if (Auth::id() !== $printRequest->owner_id){
            return redirect(route('requests.dashboard'))->with($message);
        }

        //TODO
        $printRequest->comment()->delete();
        $printRequest->delete();

        return redirect()->route('requests.dashboard');
    }

    public function closeRequest(Request $request, PrintRequest $id)
    {
        $printRequest = $this->prepareClosedRequest($id);
        $printer = Printer::find($request->printer);
        if (isset($printer)) {
            $printRequest->printer()->associate($printer);
            if ($printRequest->save()) {
                return redirect(route('requests.dashboard'));
            }
        } else {
            return redirect(route('request.details', ['id' => $printRequest->id]));
        }
    }

    public function prepareClosedRequest(PrintRequest $id)
    {
        $printRequest = $id;
        $printRequest->closed_date = Carbon::now();
        $printRequest->status = 1;
        $printRequest->closingUser()->associate(Auth::user());
        return $printRequest;
    }

    public function refuseRequest(Request $request, PrintRequest $id)
    {
        $printRequest = $this->prepareClosedRequest($id);
        $printRequest->status = 2;
        $reason = trim($request->refused_reason);
        if ($reason !== "") {
            $printRequest->refused_reason = $reason;
            if ($printRequest->save()) {
                return redirect(route('requests.dashboard'));
            }
        } else {
            $message = ['message_error' => 'Deve indicar o motivo de recusa do pedido de impressão'];
            return redirect(route('request.details', ['id' => $printRequest->id]))->with($message);
        }
    }

    public function assessRequest(Request $request, PrintRequest $id)
    {
        $printRequest = $id;

        // se o utilizador não for o utilizador autenticado, volta para o dashboard de pedidos
        $message = ['message_error' => 'Endereço inválido.'];
        if (Auth::id() !== $printRequest->owner_id){
            return redirect(route('requests.dashboard'))->with($message);
        }


        $printRequest->satisfaction_grade = $request->satisfaction_grade;
        $printRequest->save();
        return redirect(route('requests.dashboard'));
    }
}
