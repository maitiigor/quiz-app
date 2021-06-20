<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
class Form extends Model
{
    //
    use Notifiable;

    protected $fillable = [
      'name',
    ];

    public function subject(){
      return $this->HasMany(Subject::class);
    }
    public function profile(){
        $this->HasMany(Profile::class);
    }
    public function form(){
        $this->HasOne(Form::class);
    }
}
