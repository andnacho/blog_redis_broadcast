@extends('layouts.layout')

@section('contenido')

    <h1>Cuentas</h1>
   <table class="table">
       
           <tr>
               <th>Nombre</th>
               <td>{{$user->name }}</td>
               
             
           </tr>
       
           <tr>
            <th>Email</th>
            <td>{{ $user->email}}</td>
           </tr>
           <tr>
            <th>Roles</th>
            <td>
                <?php $p = 0;?>
               @foreach ($user->roles as $role)
                     @if ($p>0)
                         /
                     @endif
                    {{$role->display_name}}
                    <?php $p++;?>
                    
               
                
                @endforeach 
            
            </td>
           </tr>
       
   </table>

   @can('permite_ver_editar', $user)
     <a href="{{$user->id}}/edit" class="btn btn-primary">Editar</a>
   @endcan
   @can('destroy', $user)
       
  
   <form style="display:inline" action="{{route('usuarios.destroy', $user->id)}}"  method="post">
    @csrf   
    @method("DELETE")

    <button class="btn btn-danger btn" type="submit">Eliminar</button>

    @endcan
</form> 

    

@endsection