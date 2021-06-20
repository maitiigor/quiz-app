<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Profile extends Model
{
    use Notifiable;
    // user profile function
    protected $fillable = [
        'description', 'date_birth', 'profession', 'phone_number','Profile_pic','user_id','for'
    ];
    public function user(){

       return $this->belongsTo(User::class);
    }
    public function followers(){
        return $this->belongsToMany(User::class);
    }
    public function form(){
        return $this->belongsTo(Form::class);
    }
}
