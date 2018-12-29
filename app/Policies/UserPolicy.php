<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function before($user, $ability) //se ejecutara antes que todo
    {
        if($user->isAdmin()){
            return true;
        }
    }

    public function permite_ver_editar(User $authUser, User $user)
    {
        return $authUser->id == $user->id;
    }

    public function destroy(User $authUser, User $user)
    {
        return $authUser->id == $user->id;
    }
}
