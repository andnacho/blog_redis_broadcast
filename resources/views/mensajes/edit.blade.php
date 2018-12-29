@extends('layouts.layout')

@section('contenido')

<h1>Editar el mensaje de {{ $message->nombre }}</h1>
   
<form class="form" method="post" action="{{ route('mensajes.update', $message->id) }}">
        @method('PUT')
     
        @include('mensajes.form', [
            'btnText' => 'Actualizar',
            'showFields' => $message->user_i
        ])
        

    </form>
    
@endsection