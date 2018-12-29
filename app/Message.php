<?php

namespace App;

use App\Note;
use App\Presenters\MessagePresenter;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    // Para cambiar el nombre de la tabla se puede usar la propiedad protected $table = 'nombre de la tabla';

    //Se usa para especificar que variables van a ser guardadas por eloquent
    protected $fillable = ['nombre', 'email', 'mensaje'];

    public function user(){
    return $this->belongsTo(User::class);
    }

    public function note(){
        return $this->morphOne(Note::class, 'notable');
    // return $this->hasOne(Note::class);
    }

    public function tags(){
    return $this->morphToMany(Tag::class, 'taggable')->withTimestamps();        
    }

    public function present(){

    return new MessagePresenter($this);
    
    }
}
