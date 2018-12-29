<?php

namespace Tests\Feature;

use App\User;
use App\Message;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Http\Request;
use App\Repositories\Messages;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class RepositoriesMessagesTest extends TestCase
{

    use DatabaseMigrations;

    /** @before */
    public function setUp()
    {
        $this->repo = new Messages;
        parent::setUp();
    }
        
    /** @test */
    public function it_return_paginated_messages()
    {
        //Given - Teniendo mas de 10 mensajes

            //Con eloquent
            // $this->seed('MessagesTableSeeder');
           $messages = factory(Message::class, 15)->create(['created_at' => Carbon::yesterday()]);
           $latestMessage = factory(Message::class)->create(['created_at' => Carbon::now()]);


        //When - Cuando ejecutamos el metodo getPaginated
            $result = $this->repo->getPaginated();
           
        //Then - Encontces debemos obtener 10 mensajes solamente

        $this->assertEquals($result->count(), 10);

        //debemos recibir una instancia del paginato de Laravel
        $this->assertTrue($result instanceof Paginator);

        //los mensajes deben estar creados en forma de creación
        $this->assertEquals($result->first()->id, $latestMessage->id);

        //Verificar que se carguen las relaciones
        $this->assertTrue($result->first()->relationLoaded('user'));
        $this->assertTrue($result->first()->relationLoaded('note'));
        $this->assertTrue($result->first()->relationLoaded('tags'));

    }

 /** @test */
    function it_stores_a_message_in_the_database()
    {
         //teniendo un mensaje para guardar

             $request = new Request([
                'nombre' => 'Andres',
                'email' => 'medue@correo.com',
                'mensaje' => 'Hola soy andres'
             ]);

         //cuando ejecute el metodo store
         $this->repo->store($request);
         //entonces el mensaje debe aparece en la base de datos
         $this->assertDatabaseHas('messages', [  
        'nombre' => 'Andres',
         'email' => 'medue@correo.com',
         'mensaje' => 'Hola soy andres']);

        

    }   

 
    function test_a_registered_user_can_store_a_message()
    {
        //teniendo un usuario registrado y un mensaje para guardar
            $user = factory(User::class)->create();
            
            
            $request = new Request([
                'nombre' => 'andres',
                'email' => 'algo@correo.com',
                'mensaje' => 'Hola soy andres' ]);
                
                //Login del usuario
                
             $this->actingAs($user, 'api');

        //cuando ejecute el metodo store
            $this->repo->store($request);
        //entonces el mensaje debe aparecer
        $this->assertDatabaseHas('messages',[
            'nombre' => 'andres',
            'email' => 'algo@correo.com',
            'mensaje' => 'Hola soy andres',
            'user_id' => $user->id
        ]);
    }

    public function test_it_returns_a_message_by_id(){
        //teniendo un mensaje en la base de datos
        $message = factory(Message::class)->create();

        //cuando ejecuta el metodo findByID
       $result = $this->repo->findById($message->id);

        //Entonces debo obtener el mensaje corecto
        $this->assertEquals($result->id, $message->id);

    }

    public function test_it_updates_a_message(){
        //teniendo un mensaje en la base de datos para modificar
        $message = factory(Message::class)->create();
        $request = new Request( ['mensaje' => 'Mensaje actualizado']);


        $this->assertDatabaseHas('messages',[
            'nombre' => $message->nombre,
            'email' =>  $message->email,
            'mensaje' => $message->mensaje
        ]);

        //cuando ejecuta el metodo update
       $result = $this->repo->update($request, $message->id);

        //Entonces debe estar en la ase de datos el mensaje actualizado
        $this->assertDatabaseHas('messages',[
            'nombre' => $message->nombre,
            'email' =>  $message->email,
            'mensaje' => 'Mensaje actualizado'
        ]);

    }

    public function test_it_deletes_a_message(){
        //teniendo un mensaje en la base de datos
        $message = factory(Message::class)->create();

        $this->assertDatabaseHas('messages',[
            'nombre' => $message->nombre,
            'email' =>  $message->email,
            'mensaje' => $message->mensaje
        ]);

        //cuando ejecuta el metodo destroy
       $result = $this->repo->destroy($message->id);

        //Entonces no debemos ver el mensaje en la base de datos
        $this->assertDatabaseMissing('messages', [
            'nombre' => $message->nombre,
            'email' =>  $message->email,
            'mensaje' => $message->mensaje
        ]);

    }

}
