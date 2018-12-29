@csrf

@if($showFields)
{{-- @unless(isset($message) && $message->user_id) --}}
{{-- @if (auth()->guest()) --}}

<div class="form-group">
    <label for="nombre">Nombre
               {{-- Con el value old('nombre') guarda el valor anterior que tenia --}}
   <input class="form-control" type="text" name="nombre" value="{{ $message->nombre ?? old('nombre')}}"></label> 
           {{-- De esta manera se les da formato --}}
    {!! $errors->first('nombre', '<span class="alert btn-danger" >:message</span>')!!}
</div>

<div class="form-group">
       <label for="email">Correo Electronico
       <input class="form-control" type="email" name="email" value="{{ $message->email ?? old('email')}}"></label>
       {!! $errors->first('email', '<span class="alert btn-danger">:message</span>')!!}
       
</div>

@endif

@if(auth()->check())
    <input class="form-control" type="text" name="nombre" value="{{ auth()->user()->name}}" hidden>
    <input class="form-control" type="email" name="email" value="{{ auth()->user()->email}}" hidden>

@endif

<div class="form-group">
        <label for="mensaje" value="mensaje">Mensaje
        <textarea class="form-control" name="mensaje">{{ $message->mensaje ?? old('mensaje') }}</textarea></label>
        {!! $errors->first('mensaje', '<span class="alert btn-danger">:message</span>')!!}
</div>

{{-- <p><input class="btn btn-primary" type="submit" value=" {{ isset($btnText) ? $btnText : 'Guardar' }} "></p> --}}
{{-- <p><input class="btn btn-primary" type="submit" value=" {{ $btnText ?? 'Guardar' }} "></p> --}}
<p><input class="btn btn-primary" type="submit" name="b" value="{{ $btnText ?? 'Guardar' }} "></p>