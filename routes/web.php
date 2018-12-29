<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('testr', function () {
//     $user = new App\Role;
//     $user->name = 'estudiante';
//     $user->display_name = "Estudiante";
//     $user->description = "Tiene derechos de Estudiante";
//     $user->save();

//     return $user;       
// });

// Route::get('test', function () {
//     $user = new App\User;
//     $user->name = 'martin';
//     $user->email = 'est@correo.com';
//     // $user->role = 'estudiante';
//     $user->password = bcrypt('123123');
//     $user->save();

//     return $user;       
// });


//Para escuchar las peticiones que se están haciendo

// DB::listen(function($query){
//  echo "<pre>$query->sql</pre>";
// //  echo "<pre>$query->time</pre>";
// });

//Para enlazar o vincular

// Route::get('job', function(){

//     dispatch(new App\Jobs\SendEmail);

//     return "listo";
// });

Route::get('/', 'PagesController@home')->name('home');//->middleware('example');

Route::resource('mensajes', 'MessagesController');
Route::resource('usuarios', 'UsersController');

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout');


// Route::get('contactame/{titulo?}', 'PagesController@contacto')->name('contacto'); //poner nombre a la ruta, tambien se puede usar el 'as' => 'nombre de la ruta'[function]
// Route::post('contacto', 'PagesController@mensajes');

// Route::get('saludos/{nombre?}', 'PagesController@saludos')->name('hola');


// Route::get('mensaje', 'MessagesController@index')->name('messages.index');
// Route::get('mensaje/create', 'MessagesController@create')->name('messages.create');
// Route::post('mensaje', 'MessagesController@store')->name('messages.store');
// Route::get('mensaje/{id}', 'MessagesController@show')->name('messages.show');
// Route::get('mensaje/{id}/edit', 'MessagesController@edit')->name('messages.edit');
// Route::put('mensaje/{id}', 'MessagesController@update')->name('messages.update');
// Route::delete('mensaje/{id}', 'MessagesController@destroy')->name('messages.destroy');

// Route::get('contactame/{titulo?}', function ($titulo = 'prueba') {
    
//     $html = '<h1>Contactos desde variable</h1>';

//     return view('contactos', compact('titulo' , 'html')); //Compact sirve para enviar

// })->name('contacto'); //poner nombre a la ruta, tambien se puede usar el 'as' => 'nombre de la ruta'[function]




Route::get('saludos/{nombre?}', function ($nombre = 'Invitado'){

$consolas = [
    "Play Station 4",
    "Xbox One",
    "Wii U"];

    // $consolas = [];

    // $consolas = [
    //         "Play Station 4",
    //     ];

    return view('saludos', compact('consolas', 'nombre'));

})->where('nombre', '[a-zA-Z]+')->name('hola'); //Validador con el nombre y la declaración.

// Route::get('holas', function () {
//    return view('saludos', ['nombre' => 'Juan Manuel']); 
// })->name('hola');

// o se puede usar para este ultimo ejemplo el with

// Route::get('holas', function () {
//     return view('saludos')->with( ['nombre' => 'Juan Manuel']); 
//  });
// //usando 
//  Route::get('holas/{nombre?}', function ($nombre = 'martin') {
//     return view('saludos', compact('nombre'));
//  });