<?php

use App\User;
use App\Role;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::truncate();
        Role::truncate();
        DB::table('assigned_roles')->truncate();
      
            # code...
           $user = User::create([
                'name' => "Andres",
                'email' => "prueba@correo.com" ,
                'password' => "123123",
           ]);

            $role = Role::create([
                'name' => 'admin',
                'display_name' => 'Administrador',
                'description' => 'Administrador del sitio web'
            ]);

            $user->roles()->save($role);
}

}
