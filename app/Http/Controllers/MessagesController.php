<?php

namespace App\Http\Controllers;

use DB;
use Mail;
use App\User;
use App\Message;
use Carbon\Carbon;
use Illuminate\Http\Request;
// use App\Repositories\Messages;
// use App\Repositories\CacheMessages;
use App\Events\MessageWasReceived;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Cache;
use App\Repositories\MessagesInterface;
use App\Http\Requests\CreateMessageRequest;
use Illuminate\Contracts\Events\Dispatcher as Event;
use Illuminate\Contracts\View\Factory as ViewFactory;


class MessagesController extends Controller
{
    protected $messages;
    protected $view;
    protected $redirect;

    public function __construct(MessagesInterface $messages, ViewFactory $view, Redirector $redirect){

        $this->view = $view;
        $this->redirect = $redirect;
        $this->messages = $messages;
        $this->middleware('auth', ['except' => ['create', 'store']]); //Como segundo parametro se pasa un array para las exepciones ['only'] y ['except']
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(/*Messages $messages*/)
    {
        //


        // $messages = DB::table('messages')->get();



    //    return $messages = Message::with(['user', 'note', 'tags'])->get();
//          o para paginar usar el metodo paginate()
    //  $messages = Message::with(['user', 'note', 'tags'])->paginate(10);
    // o
    // $messages = Message::with(['user', 'note', 'tags'])->simplePaginate(10);
        // o de menor a mayor

        // $key = "messages.page." . request('page', 1); // La llave sera messages.page.1

        // //Verifica si la llave existe y devuelve el valor, si no realiza la función y la devuelbe
        // $messages = Cache::tags('messages')->rememberForever($key, function(){ 
        //     return   $messages = Message::with(['user', 'note', 'tags'])
        //     // ->latest()
        //     ->orderBy('created_at', request('sorted', 'DESC'))
        //      //ASC
        //     ->paginate(10);
        // });
        
        // if (Cache::has($key))
        // {
        //     $messages = Cache::get($key);
        // }
        // else
        // {
            // $messages = Message::with(['user', 'note', 'tags'])
            // // ->latest()
            // ->orderBy('created_at', request('sorted', 'DESC'))
            //  //ASC
            // ->paginate(10);
    
        //     Cache::put($key, $messages, 5);
    
        // }

               // $messages = Message::all();


        $messages = $this->messages->getPaginated();

        return $this->view->make('mensajes.index', compact('messages'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        // dd(config('services.2checkout.key'));
        return $this->view->make('mensajes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateMessageRequest $request, Event $event)
    {
        //guardar mensaje de tres maneras diferentes
        //Usando pdo
            // DB::table('messages')->insert([
            //     "nombre" => $request->input('nombre'),
            //     "email" => $request->input('email'),
            //     "mensaje" => $request->input('mensaje'),
            //     "created_at" => Carbon::now(), //Carbon es una clase para manejar fechas de laravel
            //     "updated_at" => Carbon::now(),
                 
            // ]);

        //Usando eloquent con una nueva clase
            // $message = new Message;

            // $message->nombre = $request->input('nombre');
            // $message->email = $request->input('email');
            // $message->mensaje = $request->input('mensaje');
            // $message->save();
            
        //Usando el metodo create de la clase

        //     Message::create([ "nombre" => $request->input('nombre'),
        //     "email" => $request->input('email'),
        //     "mensaje" => $request->input('mensaje'),
        //     "created_at" => Carbon::now(), //Carbon es una clase para manejar fechas de laravel
        //     "updated_at" => Carbon::now(),
             
        // ]);
        
        // o
            // $message = Message::create($request->all());

            // // if(auth()->check())
            //     // {
            //     // auth()->user()->messages()->save($message);
            //     // } 
            //     // o

            //     // auth()->user()->messages()->create($request->all());

            // $message->user_id = auth()->id();
            // $message->save();

            // Cache::tags('messages')->flush();
            $message = $this->messages->store($request);
            $event->dispatch(new MessageWasReceived($message));

          
            //No es necesario parasar el created_at y el updated_at, con el eloquent se incluyen automaticamente

        // redireccionar
        return $this->redirect->route('mensajes.create')
        ->with('info', 'Hemos recibido tu mensaje')
        ;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

        $message = $this->messages->findById($id);

        // $message = DB::table('messa q    ges')->where('id', $id)->first();
        // $message = Message::find($id);

        //Suponiendo que se intenta buscar un id que no existe se usa el siguiente metodo
        // $message = Message::findOrFail($id);
        return $this->view->make('mensajes.show', compact('message'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        // $message = DB::table('messages')->where('id', $id)->first();
        $message =  $this->messages->findById($id);

        return $this->view->make('mensajes.edit', compact('message'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Actualizar en la base de datos
        // DB::table('messages')->where('id', $id)->update([
        //     "nombre" => $request->input('nombre'),
        //     "email" => $request->input('email'),
        //     "mensaje" => $request->input('mensaje'),
        //     "updated_at" => Carbon::now(),
        // ]);

        $message = $this->messages->update($request, $id);

        //Redirecciona
        return $this->redirect->route('mensajes.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Eliminar
    //    DB::delete('delete from messages where id = :id', ['id' => $id]);
    //      o
    // DB::table('messages')->where('id', $id)->delete();
        
        $this->messages->destroy($id);

        //Redireccionar
        return $this->redirect->route('mensajes.index');
    }
}
