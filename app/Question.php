<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Question extends Model
{
    //
    use Notifiable;
    protected $fillable = [
        'test_id','form_id','subject_id','question','option1','option2','option3','option4','answer',
    ];

    public function test(){
        return $this->belongsTo(Test::class);
    }
    public function subject(){
        return $this->belongsTo(Subject::class);
    }
}
