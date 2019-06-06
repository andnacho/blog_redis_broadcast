@extends('layouts.layout')

@section('contenido')
    
<h1>Crear usuario</h1>

<form class="form" method="post" action="{{ route('usuarios.store')}}" enctype="multipart/form-data">
               
        @include('users.form', ['user' => new App\User])
               
        <p><input type="submit" class="btn btn-primary mt-3" value="Guardar"></p>


    </form>

@endsection