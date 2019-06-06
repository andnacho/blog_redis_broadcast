@extends('layouts.layout')

@section('contenido')
    <h1>Editar usuario</h1>

    @if (session()->has('info'))
        <div class="alert alert-success">{{session('info')}}</div>
          
    @endif

    <form class="form" method="post" action="{{ route('usuarios.update', $user->id) }}" enctype="multipart/form-data">
        @method('PUT')
    <img  width=100px src="{{ Storage::url($user->avatar) }}">
        
        @include('users.form')
               
        <p><input type="submit" class="btn btn-primary mt-3" value="Enviar"></p>


    </form>
@endsection