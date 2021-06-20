<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
class Score extends Model
{
    //
    use Notifiable;

    protected $fillable = [
        'test_id','user_id','score',
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
}


