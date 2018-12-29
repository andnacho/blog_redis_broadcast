<?php

use App\Message;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class MessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Se escribe la logica
        Message::truncate();
        for ($i=1; $i < 101; $i++) { 
            # code...
            Message::create([
                'nombre' => "Usuario {$i}" ,
                'email' => "prueba{$i}@correo.com" ,
                'mensaje' => "Este es el mensaje del usuario {$i}",
                'created_at' => Carbon::now()->subDays(100)->addDays($i),
           ]);
        }
      

    }
}
