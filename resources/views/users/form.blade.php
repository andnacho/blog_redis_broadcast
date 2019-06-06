@csrf

<div class="form-group">
    <label for="avatar">
    <input type="file" name="avatar">
    {!! $errors->first('avatar', '<span class="alert">:message</span>')!!}</label> 
  
</div>

<div class="form-group">
    <label for="nombre">Nombre
        {{-- Con el value old('nombre') guarda el valor anterior que tenia --}}
    <input type="text" class="form-control" name="name" value="{{$user->name ?? old('name') }}">
    {{-- De esta manera se les da formato --}}
        {!! $errors->first('name', '<span class="alert">:message</span>')!!}</label> 
</div>
{{-- --}}

<div class="form-group">
    <label for="email">Email
    <input type="text"  class="form-control" name="email" value="{{$user->email ?? old('email') }}">
    {!! $errors->first('email', '<span class="alert">:message</span>')!!}</label>
    
</div>

@unless ($user->id)
<div class="form-group">
    <label for="password" >Password
    <input type="password" class="form-control"  name="password">
    {!! $errors->first('password', '<span class="alert">:message</span>')!!}</label>
</div>
<div class="form-group">
        <label for="password_confirmation">Confirmar Password
        <input type="password" class="form-control"  name="password_confirmation">
        {!! $errors->first('password', '<span class="alert">:message</span>')!!}</label>
    </div>
@endunless


@foreach ($roles as $id => $name)
<div class="form-check">
    <label class="form-check-label">
        <input type="checkbox"
        class="form-check-input"
        name="roles[]"
        value="{{ $id }}" {{ $user->roles->pluck('id')->contains($id) ? 'checked' : ""}}>
        {{$name}}

    </label>
   
</div>
@endforeach
{!! $errors->first('roles', '<span class="alert my-3">:message</span>')!!}

<hr>