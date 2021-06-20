<?php

namespace App\Http\Controllers;

use App\Profile;
use App\Question;
use App\Report;
use App\Score;
use App\Test;
use Illuminate\Http\Request;
use App\User;
use App\Subject;
use App\Post;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Profile $profile,$test_id)
    {

        $test = Test::with('subject','form')->where('id','=',$test_id)->first();
        return view('test', compact('test'));

        //$posts = $user->posts();
        //$form = Profile::query()->select('form_id')->where('user_id','=',$user);
        //dd();
        //$follows = (auth()->user()) ? auth()->user()->following->contains($user->id):false;

    }
    public function create(Question $question,Test $testt,$test){

        $questions = $question->all()->where('test_id','=',$test);
        $tests =$testt->where('id',$test)->first();
        return view('start-test',compact('questions','tests'));
    }
    public function test(Question $question,$test){

        $questions = $question->all()->where('test_id','=',$test);
        return $questions;
    }
    public function submit($userId, $subjectId, $testId, $score, Request $request){
        /*Score::create([
           'user_id' => $userId,
           'subject_id' => $subjectId,
            'test_id' => $testId,
            'score' => $score

            }

        ]);*/
        foreach( $request as $answers){
            Report::create([
                $answers->question,
                $answers->option

            ]);
        }

        $results = json_decode($request->input('my_props'));

        return response('success');

    }
    public function result(){
        return view('/result');
    }
}
