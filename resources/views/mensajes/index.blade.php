@extends('layouts.layout')

@section('contenido')

    <h1>Todos los mensajes</h1>
   
    <table class="table">
        <thead>

            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Mensaje</th>
                <th>Notas</th>
                <th>Tags</th>
                <th>Acciones</th>
            </tr>

        </thead>
        <tbody>

            @foreach ($messages as $message)
                
            <tr>
            <td>{{ $message->id }}</td>

            <td>{{ $message->present()->userName() }}</td>
            <td>{{ $message->present()->userEmail() }}</td>
            <td>{{ $message->present()->link() }}</td>
            <td>{{ $message->present()->notes() }}</td>
            <td>{{ $message->present()->tags() }}</td>


            <td><a class="btn btn-primary btn-sm" href="{{ route('mensajes.edit', $message->id) }} ">Editar</a>
            
            <form style="display:inline" action=" {{route('mensajes.destroy', $message->id)}} " method="post">
                @csrf   
                @method("DELETE")
                <button class="btn btn-danger btn-sm" type="submit">Eliminar</button>
            </form> 
            
            </td>
            
            </tr>

            @endforeach

           

        </tbody>
    </table>
    <div class="container" style=" width:50%;" >
    {!!$messages
    ->fragment('hash') // para agregar hashes
    ->appends(
        // [
        // 'sorted' =>request('sorted'),
        // 'likes' =>request('likes')
  
        // ] 
        // o
        request()->query()

        // )->links(/*acepta una vista como parametro si se desea para cambiar el diseño*/'pagination.custom')
        )->links('pagination::bootstrap-4'); !!}
    </div>
    
@endsection