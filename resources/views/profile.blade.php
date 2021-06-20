@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
        <div class="col-md-4 pl-5 pl-5">
            <img src="storage/{{$user->profile->profile_pic}} " class="rounded-circle" style="height: 200px">
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Profile</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                        Name
                        </div>
                        <div class="col-md-8">
                                {{Auth::user()->name}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            email
                        </div>
                        <div class="col-md-8">
                            {{$user->email}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            Profession
                        </div>
                        <div class="col-md-8">
                            {{$user->profile->profession}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            Describe your self
                        </div>
                        <div class="col-md-8">
                            {{$user->profile->description}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            Phone Number
                        </div>
                        <div class="col-md-8">
                            {{$user->profile->phone_number}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            Date of Birth
                        </div>
                        <div class="col-md-8">
                            {{$user->profile->date_birth}}
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <a href="profile/{{$user->profile->id}}"> Edit Profile </a>
                    </div>
                </div>
            </div>
     </div>
        <div class="row justify-content-center font-weight-bolder">
             Previous Posts
        </div>
        <div class="row">
            @foreach(Auth::user()->posts as $post)
                <div class="col-md-4 ">
                    {{$post['caption']}}
                    <a href="welcome/{{$post->id}}"><img src="storage/{{$post['image']}}" class="w-100"></a>
                </div>
            @endforeach
        </div>
        </div>
    </div>
@endsection
