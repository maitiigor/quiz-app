<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
class Subject extends Model
{
    //
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    public function question(){
        return $this->hasMany(Question::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function test(){
        return $this->hasMany(Test::class);
    }
}
