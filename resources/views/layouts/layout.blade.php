{{-- {{dd(auth()->user()->roles->toArray())}} --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/app.css">

    <script>

        window.Laravel = {
            csrfToken: "{{ csrf_token() }}"
        }

    </script>

    <title>Mi sitio</title>


</head>
<body>

        <header>


           <?php function activaMenu($url){
                return request()->is($url) ? 'active' : '';
            }?>

            <nav class="navbar navbar-expand-sm navbar-light">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                  <a class="navbar-brand" href="#">Home</a>
                  <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                        <li class="nav-item {{activaMenu('saludos/*')}}">
                            <a class="nav-link" href="{{ route('hola', 'alfredo') }}">Saludo <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item {{request()->is('mensajes/create') ? 'active' : ''}}">
                            <a class="nav-link" href="{{ route('mensajes.create') }}">Contactos</a>
                        </li>
                        @if (auth()->check())
                        <li class="nav-item {{request()->is('mensajes') ? 'active' : ''}}">
                                <a class="nav-link" href="{{ route('mensajes.index') }}">Mensajes</a>
                        </li>
                        @if (auth()->user()->hasRoles(['admin'] ))
                         <li class="nav-item {{request()->is('usuarios') ? 'active' : ''}}">
                             <a class="nav-link" href="{{ route('usuarios.index') }}">Usuarios</a>
                         </li>
                      
                        @endif
                        
                        
                        @endif
                  </ul>          
                        
                  {{-- <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                  </form> --}}

         @if (auth()->guest())
             <ul class="navbar-nav">
                 <li class="nav-item">
                      <a id="login" class="{{request()->is('login') ? 'active' : ''}}" href="/login">Login</a>
                </li>
            </ul>
         @elseif (auth()->check())
             
            <ul class="navbar-nav">
             <li class="nav-item dropdown">
                    <a class="btn dropdown-toggle btn-secondary active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      {{ auth()->user()->name }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                    <a class="ml-2 dropdown-item" href="/usuarios/{{auth()->id()}}">Mi cuenta</a>
                    <a class="ml-2 dropdown-item" href="/logout">Cerrar session</a>
                    </div>
                                               
                </li>
            </ul>
                @endif
            

                  </ul>
              
                </div>
              </nav>

        {{-- <h1>{{request()->url()}}</h1> --}}
        {{-- <h1>{{request()->is('/')? 'Estás en el home' : 'No estás en el home'}}</h1>
        <a href="{{ route('hola', 'alfredo') }}" class={{activaMenu('saludos/*')}}>Saludo</a> <!--El comodin permite escribir cualquier cosa-->
        <a href="{{ route('mensajes.create') }}"  class={{request()->is('mensajes/create') ? 'active' : ''}}>Contactos</a>

        @if (auth()->check())
        <a href="{{ route('mensajes.index') }}"  class={{request()->is('mensajes') ? 'active' : ''}}>Mensajes</a>
        <a href="/logout">Cerrar sessión de {{ auth()->user()->name }}</a>
        @endif
        @if (auth()->guest())
        <a href="/login"  class={{request()->is('login') ? 'active' : ''}}>Login</a>    
        @else 
        @endif --}}
            
            </header>
            <div class="container">
            @yield('contenido')
                
                <hr>
                <footer>Copiar no es valido ®{{date('Y')}}</footer>
            </div>
          
<script src="/js/app.js"></script>
</body>
</html>