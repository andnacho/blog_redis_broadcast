<?php

namespace App\Listeners;

use Mail;
use App\Events\MessageWasReceived;
use App\Mail\TuMensajeFueRecibido;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendAutoresponder implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    

    /**
     * Handle the event.
     *
     * @param  MessageWasReceived  $event
     * @return void
     */
    public function handle(MessageWasReceived $event) //Se ejecuta automaticamente
    {
        //
        // var_dump('Envia el correo al usuarios');
        $message = $event->message;
        if(auth()->check())
        {
            $message->nombre = auth()->user()->name;
            $message->email = auth()->user()->email;
        }


       
        //  Mail::send('emails.contact', ['msg' => $message], function($m) use ($message){ //FUncion para enviar correos
        //         $m->to($message->email, $message->nombre)->subject('Tu mensaje fue recibido');
        //     });

        //Esta es la versiòn con la clase mail
        Mail::to($message->email)->send(new TuMensajeFueRecibido($message));
    }
}
