<?php

namespace Tests\Browser;

use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Support\Facades\App;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CreateMessageTest extends DuskTestCase
{

    // use DataBaseMigrations;

    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function test_user_can_send_messages()
    {
        $this->browse(function (Browser $browser) {
            //teniendo
            //cuando visitamos 'mensajes/create y llenamos el formulario
            $browser->visit('mensajes/create')
                    ->type('nombre', 'Jorge')
                    ->type('email', 'jorge@email.com')
                    ->type('mensaje', 'Mensaje de prueba')
                    ->press('b');
        });
            //Entoncesel mensaje debe estar en la base de datos
        $this->assertDatabaseHas('messages',[

            'nombre' => 'Jorge',
            'email' => 'jorge@email.com',
            'mensaje'=> 'Mensaje de prueba'
        ]);
    }

    public function test_a_registered_user_can_send_messages()
    {

        // $user = new User;
        // $user->name = 'Andres';
        // $user->email = 'medue@hotmail.com';
        // $user->password = bcrypt('123123');
        // $user->save();


        $this->browse(function (Browser $browser) {
            //teniendo
            //cuando visitamos 'mensajes/create y llenamos el formulario
            $browser->visit('/')
                    ->clickLink('Login')
                    ->type('email', 'prueba@correo.com')
                    ->type('password', '123123')
                   
                   ->press('entrar')
                   ->clickLink('Contactos')
                    ->type('mensaje', 'Mensaje de prueba')
                    ->press('b')
                    ->clickLink('Mensajes')              
                    ->assertSee('Mensaje de prueba');

                    
                    
                    //->driver->takeScreenshot(base_path('tests/Browser/screenshots/mensajeEnviado.png'));
      
        });

        $this->assertDatabaseHas('messages',[
            'nombre' => 'Andres',
            'email' => 'prueba@correo.com',
            'mensaje'=> 'Mensaje de prueba'
        ]);
        // $this->assertTrue(True);
     
    
           
    }
}
