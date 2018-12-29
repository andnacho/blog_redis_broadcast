@extends('layouts.layout')

@section('contenido')

    <h1>Todos los usuarios</h1>

    

    <a href="{{ route('usuarios.create') }}" class="btn btn-success float-right mb-3">Crear nuevo usuario</a>

    <table class="table">
        <thead>

            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Role</th>
                <th>Notas</th>
                <th>Tags</th>
                <th>Acciones</th>
            </tr>

        </thead>
        <tbody>

            @foreach ($users as $user)
                
            <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->present()->link() }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->present()->roles() }}</td>
            <th>{{ $user->present()->notes() }}</td>
            <th>{{ $user->present()->tags()  }}</td>
            <td><a class="btn btn-primary btn-sm" href="{{ route('usuarios.edit', $user->id) }}">Editar</a>
                
            
            <form style="display:inline" action="{{route('usuarios.destroy', $user->id)}}"  method="post">
                @csrf   
                @method("DELETE")

                <button class="btn btn-danger btn-sm" type="submit">Eliminar</button>
            </form> 
            </td>
            
            </tr>

            @endforeach

        </tbody>
    </table>
@endsection