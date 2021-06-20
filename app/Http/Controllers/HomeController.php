<?php

namespace App\Http\Controllers;

use App\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\profile;
use App\Subject;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->user();
        $profile= Profile::with('user','form')->first();
        $form = $profile->form->id;
        $tests = Test::with('form','subject')->where('form_id','=',$form)->get();
        //$follows = (auth()->user()) ? auth()->user()->following->contains($user->id):false;
        return view('home', compact('user','tests'));
    }
    public function profile()
    {
        return view('profile');
    }
    public function showprofile(){
       $user = Auth::user();
       profile::with(['user',]);
       return view('profile',['user'=>$user]);
    }
    public function editprofile(){
        $user = Auth::user();
        profile::with(['user',]);
        return view('updateprofile',['user'=>$user,]);
    }
    public function update(Request $request){
        $this->validate($request,[
            'email' => 'required|unique:users',
        ]);
        $user = Auth::user();

       // $user->name = $request->name;
        //$user->email = $request->email;
        //$user->save();
        $imagePath = $request['profile_pic']->store('profile','public');
        $image = Image::make(public_path("storage/{$imagePath}"))->fit(500,500);
        $image->save();
        User::with(['user,'])->update($request->only(['email','name']));
        profile::with(['user,'])->update([
            'description' => $request['description'],
            'profession' => $request['profession'],
            'date_birth' => $request['date_birth'],
            'phone_number'=> $request['phone_number'],
            'profile_pic' =>  $imagePath,
        ]);

        return back();

    }
}
