@extends('layouts.layout')

@section('contenido')

    {{-- Sirve para hacer codigo php sin protección html --}}
   
    <h2>Escribeme</h2>

    @if(session()->has('info'))
<h3>{{session('info')}}</h3>
    @else

    <div class="container">
            <form method="post" action="{{ route('mensajes.store') }}">
        
                @include('mensajes.form',[
                    'message' => new App\Message,
                    'showFields' => auth()->guest(),
                    ])
                             
                </form>  
    </div>
  
    @endif
    
@endsection