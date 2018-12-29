<?php

namespace Tests\Unit;

use Mockery;
use Tests\TestCase;
use Illuminate\View\Factory;
use App\Events\MessageWasReceived;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\MessagesController;
use Illuminate\Contracts\View\Factory as FactoryContract;


class MessagesControllerTest extends TestCase
{ 
    

    //Será ejecutado al inicio
    public function setUp(){

        $this->messagesRepo = Mockery::mock('App\Repositories\MessagesInterface');
        $this->view = Mockery::mock('Illuminate\Contracts\View\Factory');
        $this->redirect = Mockery::mock('Illuminate\Routing\Redirector');
        $this->request = Mockery::mock('App\Http\Requests\CreateMessageRequest');
        $this->controller = new MessagesController($this->messagesRepo, $this->view, $this->redirect);
    }

    //Será ejecutado al final cuando se use el test
    public function tearDown()
    {
        Mockery::close();
    }

       public function testIndex()
    {

        
        //Asegurarnos que a través del metodo se lla al metodo getPaginated

        $this->messagesRepo->shouldReceive('getPaginated')->once()->andReturn('paginated_messages');

    //Asegurarnos que a través del metodo se lla al metodo viewfactory
    // y que por parametro reciba la vista messages.index y l avariable messages
        $this->view->shouldReceive('make')
        ->with('mensajes.index', ['messages' => 'paginated_messages'])
        ->once();
       
        //Se llama al metodo
        $this->controller->index();
        $this->assertTrue(true);
    }


    public function testCreate(){
        $this->view->shouldReceive('make')
        ->with('mensajes.create')
        ->once();
       

        $this->controller->create();
        $this->assertTrue(true);
    }

    function testStore(){
       
        $event = Mockery::mock('Illuminate\Contracts\Events\Dispatcher');
        // $messageEvent = Mockery::type('App\Events\MessageWasReceived');

        $this->messagesRepo
        ->shouldReceive('store')
        ->with($this->request)
        ->once()->andReturn('saved_message'); //Simula lo que se recive

        //$messageEvent instanceOf App\Events\MessageWasReceived
        $event->shouldReceive('dispatch')->once()->with(Mockery::on(function($param){
            return $param instanceof MessageWasReceived && $param->message == 'saved_message';

        }));
        $this->redirect
        ->shouldReceive('route')
        ->with('mensajes.create')
        ->once()
        ->andReturn($this->redirect);
        $this->redirect
        ->shouldReceive('with')
        ->once()
        ->with('info', 'Hemos recibido tu mensaje');
        

        $this->controller->store($this->request, $event);

        $this->assertTrue(true);
    }

    public function testShow(){

        $id = 1;

        $this->messagesRepo->shouldReceive('findById')->once()->with($id)->andReturn('finded_message');
        $this->view->shouldReceive('make')->once()->with('mensajes.show', ['message' => 'finded_message']);

        $this->controller->show($id);

        $this->assertTrue(true);
    }

    public function testEdit(){

        $id = 1;

        $this->messagesRepo->shouldReceive('findById')->once()->with($id)->andReturn('finded_message');
        $this->view->shouldReceive('make')->once()->with('mensajes.edit', ['message' => 'finded_message']);

        $this->controller->edit($id);

        $this->assertTrue(true);
    }

    public function testUpdate(){

        $id = 1;

        $this->messagesRepo->shouldReceive('update')->once()->with($this->request, $id)->andReturn('finded_message');
        $this->redirect->shouldReceive('route')->once()->with('mensajes.index');

        $this->controller->update($this->request, $id);

        $this->assertTrue(true);
    }

    public function testDestroy(){

        $id = 1;

        $this->messagesRepo->shouldReceive('destroy')->once()->with($id);
        $this->redirect->shouldReceive('route')->once()->with('mensajes.index');

        $this->controller->destroy($id);

        $this->assertTrue(true);
    }
}
