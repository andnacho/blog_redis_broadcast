<?php

namespace App;

use App\Message;
use App\Presenters\UserPresenter;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function setPasswordAttribute($password){
    
        $this->attributes['password'] = bcrypt($password);

    }

    public function roles(){
        return $this->belongsToMany(Role::class, 'assigned_roles')->withTimestamps();
    }

    public function hasRoles(array $roles){
        
        //Se reemplaza todo lo de abajo

        return $this->roles->pluck('name')->intersect($roles)->count();

        // //para relacione de muchos
        // foreach ($roles as $role) 
        //     {
        //         # code...
                
              
        //              foreach($this->roles as $userRole)
        //          {
        //              if($userRole->name === $role)
        //              {   

        //                  return true;
                    
        //              }
        //              }
        //     }       
           
        }

public function isAdmin(){
    return $this->hasRoles(['admin']);
}

public function messages(){
return $this->hasMany(Message::class);
}

public function note(){
    return $this->morphOne(Note::class, 'notable');
// return $this->hasOne(Note::class);
} //polimorco de uno a uno a mucho con morphMany()

public function tags(){

    return $this->morphToMany(Tag::class, 'taggable')->withTimestamps(); 

    } //Polimorfico de muchos a mucho
 
        //Para relaciones de uno

        // foreach($roles as $role)
        // {
        //     if($this->roles->name === $role)
        //     {   
        //     return true;
        //     }
        // }
        //   return false;
        // }

        public function present(){
        return new UserPresenter($this);
        }


}
