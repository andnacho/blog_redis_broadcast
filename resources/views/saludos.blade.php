@extends('layouts.layout')

@section('contenido')
    

    <div><h1>Saludos <?php echo $nombre;?></h1></div>
    
    <example-component></example-component>

    <ul>
    {{-- @foreach ($consolas as $consola)
    <li>{{$consola}}</li>
    @endforeach  Para Repetir sin embargo hay problemas si el array está vació por lo que se usa forelse con el empty si está vació--}}

    @forelse ($consolas as $consola)
    <li>{{$consola}}</li>
    @empty
    <p>No hay ninguna consola</p>
    </ul>
    @endforelse 

    @if (count($consolas)=== 1)
        <p>Solo tienes una consola</p>

    @elseif(count($consolas)>1)
     <p>Tienes muchas consolas</p>
    @else
    <p>No tienes consolas</p>
    @endif

    @php
        $html ="<a onclick='alert(\"xss\")' href='#'>Link</a>";
    @endphp
    
    {!! Purify::clean($html) !!}

    @endsection