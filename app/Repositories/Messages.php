<?php

namespace App\Repositories;

use App\Message;

class Messages implements MessagesInterface
{
    public function getPaginated(){
  
            return  $messages = Message::with(['user', 'note', 'tags'])
            // ->latest()
            ->orderBy('created_at', request('sorted', 'DESC'))
            //ASC
            ->paginate(10)
            ;
     

    }

    public function store($request){

    $message =  Message::create($request->all());

    // $message->user_id = auth()->id();
    // $message->save();

    
   if(auth()->check()){
    auth()->user()->messages()->save($message);
    }


    return $message;
    }

    public function findById($id){

            return Message::findOrFail($id);
        
    }

    public function update($request, $id){
    
        return Message::findOrFail($id)->update($request->all());   
    
    }

    public function destroy($id){
    
        return Message::findOrFail($id)->delete();
            
    }

}