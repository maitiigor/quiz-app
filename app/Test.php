<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Test extends Model
{
    //
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'subject_id','form_id','duration','status',
    ];
    public  function question(){
        return $this->BelongsTo(Question::class);
    }
    public function user(){
        return $this->BelongsTo(User::class);
    }
    public function subject(){
        return $this->belongsTo(Subject::class);
    }
    public function form(){
        return $this->belongsTo(Form::class);
}
    public function score(){
        return $this->hasMany(Score::class);
    }
}
