<?php

namespace App\Listeners;

use Mail;
use App\Events\MessageWasReceived;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendNotificationToTheOwner implements ShouldQueue
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
    public function handle(MessageWasReceived $event)
    {
        //

        // var_dump('Notificar al dueño');

        $message = $event->message;

        
        if(auth()->check())
        {
            $message->nombre = auth()->user()->name;
            $message->email = auth()->user()->email;
        }


        Mail::send('emails.recibido', ['msg' => $message], function($m) use ($message){ //FUncion para enviar correos
               $m->from($message->email, $message->nombre)
               ->to('anddesarrolloysoluciones@gmail.com', 'Andres')
               ->subject('Tu mensaje fue recibido');
           });
    }
}
