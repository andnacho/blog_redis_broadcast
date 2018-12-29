<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Role;
use App\User;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){
        // $this->middleware(['auth', 'role:admin']); //Pasar parametros al middleware
        $this->middleware('auth', ['except' => ['show', 'destroy']]);
        $this->middleware('role:admin', ['except' => ['edit', 'show', 'update']]);

    }

    public function index()
    {
        //

        $users = User::with(['roles', 'note', 'tags'])->get();

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        
        $roles = Role::pluck('display_name', 'id');

        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CreateUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    
    {
        //
        $user = User::create($request->all());
        $user->roles()->attach($request->roles);


        return redirect()->route('usuarios.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $user = User::find($id);

        // $this->authorize('permite_ver_editar', $user);

        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
      $user = User::findOrFail($id);

      $this->authorize('permite_ver_editar', $user);

         $roles = Role::pluck('display_name', 'id'); //Al ponerle id, lo utilizará como llave
       
        return  view('users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        //

        $user = User::findOrFail($id);
        
        $this->authorize('permite_ver_editar', $user);

        $user->update($request->only('name', 'email'));

        // $user->roles()->attach($request->roles);

        //Para evitar repetisiones se usa método llamado sync
        $user->roles()->sync($request->roles);

        return back()->with('info', 'Usuario actualizado');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $user = User::findOrFail($id);

        $this->authorize('destroy', $user);

        $user->delete(); 
        return back();
    }
}
