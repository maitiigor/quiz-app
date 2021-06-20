<?php

namespace App\Http\Controllers;

use App\Profile;
use Illuminate\Http\Request;
use App\User;
use App\Post;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class PostsController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
public function index(){
    return view('/post');
}
public function create(Request $request){
    $this->validate($request,[
        'image'=> 'required','image',
        'caption' => 'required',
    ]);
    $user = Auth::user();

    // $user->name = $request->name;
    //$user->email = $request->email;
    //$user->save();
    //$request['user_id'] = Auth::user()->id;
    $userId  =$request['user_id'] = Auth::user()->id;
    $imagePath = $request['image']->store('upload','public');
    $image = Image::make(public_path("storage/{$imagePath}"))->fit(500,500);
    $image->save();

    Post::create([
        'caption' => $request['caption'],
        'image' => $imagePath,
        'user_id' =>  $userId,
    ]);
    return redirect('/');


}
public  function show(\App\Post $post){
     return view ('show',compact('post'));
}
}
