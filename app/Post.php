<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Post extends Model
{
    //
    use Notifiable;
    protected $fillable = [
        'caption', 'image','user_id',
    ];
    public function User(){
        $this->belongsTo(User::class);
    }
}
