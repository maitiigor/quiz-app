<?php

namespace App\Http\Controllers;

use App\Question;
use App\Subject;
use App\Test;
use App\Form;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin');
    }
    public function userCount(){
        $users = DB::table('users')->count('id');
        return view('admin',compact('users'));
    }
    public function  setExam(){
       $subjects = Subject::all();
        return view('/admin/setexam', compact('subjects'));
    }
    public function  examCreate(Request $request,$subject,$form,$duration){
        $time = new \DateTime();
        $result = Test::create([
            'subject_id' => $subject,
            'form_id' => $form,
            'duration' => $time->setTime(0,$duration,0),
            'status' => 0,

        ]);
        $test_id =$result->id;

        $status ='';
        foreach (json_decode($request->input('my_props')) as $data){


         $create = Question::create([
             'subject_id' => $subject,
             'form_id' => $form,
             'test_id' => $test_id,
             'question' => $data->question,
             'option1' => $data->option1,
             'option2' => $data->option2,
             'option3' => $data->option3,
             'option4' => $data->option4,
             'answer' => $data->answer,
         ]);
        $status .= $create;
        }
        if($status){
        return \response()->json(['message' => 'success']);
        }
        else{
            return \response()->json(['message' => 'failed']);
        }
    }
    public function editExam()
    {
        $tests = Test::all();

        return view('admin/edit', compact('tests'));
    }
     public function editTest($test){
        $questions = Question::query()->select(['*'])->where('test_id','=', $test)->get();
        $exam = Test::with('subject','form')->where('id','=',$test)->get();
        $subjects = Subject::all();
        $forms = Form::all();
        return view('admin/edit-test', compact('questions','exam','forms','subjects'));
    }
    public function updateTest(Request $request,$test,$subject,$form,$duration){
        $time = new \DateTime();

        $testUpdate = Test::query()->where('id','=',$test)->update([
            'subject_id' =>$subject,
            'form_id' => $form,
            'duration' =>  $time->setTime(0,$duration,0),
            ]);



        $oldData = Question::all()->where('test_id', '=', $test);
        $array = array();
        $k = 0;
        foreach ($oldData as $old) {
            $array[$k] = $old->id;
            $k++;
        }
        $k = 0;

        $status='';
        $status1='';
        $deleted='';
        foreach(json_decode($request->input('del')) as  $del){
            if($del){
                $delete = Question::destroy($del);
                $deleted .= $delete;
            }

        }
        foreach (json_decode($request->input('my_props')) as $data) {
            if ($data->id) {

                 $update= Question::where('id', '=', $array[$k])->update([
                     'subject_id' => $subject,
                     'form_id' => $form,
                     'test_id' => $test,
                     'question' => $data->question,
                     'option1' => $data->option1,
                     'option2' => $data->option2,
                     'option3' => $data->option3,
                     'option4' => $data->option4,
                     'answer' => $data->answer,
                 ]);
                 $status .= $update;
            }

            else{
              $create =  Question::create([
                     'subject_id' => $subject,
                     'form_id' => $form,
                     'test_id' => $test,
                     'question' => $data->question,
                     'option1' => $data->option1,
                     'option2' => $data->option2,
                     'option3' => $data->option3,
                     'option4' => $data->option4,
                     'answer' => $data->answer,
                 ]);
              $status1 .= $create;
             }
             $k++;
         }
        if($status && $status1){
             return \response()->json(['message' => 'success']);
        }
        elseif($status){
            return \response()->json(['message' => 'success']);
        }
         else{
             return \response()->json(['message' => 'failed']);
        }


    }
}
