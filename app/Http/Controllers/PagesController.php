<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateMessageRequest;


class PagesController extends Controller
{
    //Inyección del request a traves del constructor

    // public function __construct(Request $request){

    //     $this->request = $request;

    // }

        public function __construct(){
            // $this->middleware('example', ['only' => ['home']]); 
            $this->middleware('example', ['except' => ['home']]);
        }


    public function home(){
        return view('welcome');
    }

    public function contacto(){
        $html = '<h1>Contactos desde variable</h1>';

       return view('contactos', compact('titulo' , 'html')); 
     
    }

    public function mensajes(CreateMessageRequest $request){


        // $this->validate($request,[

        //     // Tambien estan ahora en el CreateMessageRequest en la carpeta Request

        //     // 'nombre' => 'required',
        //     // 'email' => 'required|email',
        //     // 'mensaje' => 'required|min:5',

        // ]);

       

        // if($request->filled('nombre'))
        // {
        //    return 'Tiene nombre es ' . $request->input('nombre');
        // }      

        // return 'No tiene nombre';

//Para una respuesta

        // return response('Contenido de la respuesta', 201) => estado
        //     ->header('X-TOKEN', 'secret')
        //     ->header('X-TOKEN2', 'secret')
        //     ->cookie('X-COOKIE', 'cookie'); 

        $data = $request->all(); //procesar los datos del formulario

        // return redirect('/'); // Redirecciona al home
            // return redirect()
            // ->route('contacto')
            // ->with('info', 'Tu mensaje ha sido enviado correctamente :)');

            return back()->with('info', 'Tu mensaje ha sido enviado correctamente :)'); //Regresa a la pagína anterior

        // return response()->json(['data' => $data], 202)  //202 es el estado
        // ->header('X-TOKEN', 'secret')
        //     ->header('X-TOKEN2', 'secret')
        //     ->cookie('X-COOKIE', 'cookie'); 

    
    }

    public function saludos($nombre = 'Invitado'){$consolas = [
        "Play Station 4",
        "Xbox One",
        "Wii U"];
    
        // $consolas = [];
    
        // $consolas = [
        //         "Play Station 4",
        //     ];
    
        return view('saludos', compact('consolas', 'nombre'));
    
    }
}
