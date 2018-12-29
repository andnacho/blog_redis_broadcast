@extends('layouts.layout')

@section('contenido')
    <h1>Login</h1>

    <form class="form-inline" method="POST">
        @csrf
        <div class="form-group mr-2">
                <input class="form-control" type="email" name="email" id="email" placeholder="Email">
        </div>
        <div class="form-group">
                <input class="form-control" type="password" name="password" id="email" placeholder="Contraseña">
        </div>
        <div class="form-group">
                <input class="btn btn-primary" id="entrar" type="submit" value="entrar">
        </div>
    </form>
    <br>
@endsection