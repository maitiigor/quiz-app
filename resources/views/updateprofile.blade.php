@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="col-md-4">
            <img src="storage{{$user->profile->profile_pic}}">
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Profile page
                    </div>
                    <div class="card-body">
                    <form method="post" action="{{route('update.profile')}}" enctype="multipart/form-data">
                        {{csrf_field()}}
                        {{method_field('patch')}}
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right"> Name </label>
                            <div class="col-md-8">
                                <input type="text" name="name" id="name" value="{{Auth::user()->name}}" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right"> Email </label>
                            <div class="col-md-8">
                                <input type="text" name="email" id="email" value="{{Auth::user()->email}}" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone number" class="col-md-4 col-form-label text-md-right"> Phone number </label>
                            <div class="col-md-8">
                                <input type="text" name="phone_number" id="phone_number" value="{{$user->profile->phone_number}}" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="form_id" class="col-md-4 col-form-label text-md-right"> Class </label>
                            <div class="col-md-8">
                                <select>
                                    <option>

                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Profession" class="col-md-4 col-form-label text-md-right"> Profession </label>
                            <div class="col-md-8">
                                <input type="text" name="profession" id="Profession" value="{{$user->profile->profession}}" class="form-control">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right"> Description </label>
                            <div class="col-md-8">
                                <input type="text" name="description" id="description" value="{{$user->profile->description}}" class="form-control">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="date of birth" class="col-md-4 col-form-label text-md-right"> Date of Birth </label>
                            <div class="col-md-8">
                                <input type="text" name="date_birth" id="date of birth" value="{{$user->profile->date_birth}}" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="profile_pic" class="col-md-4 col-form-label text-md-right"> Profile Picture </label>
                            <div class="col-md-8">
                                <input type="file" name="profile_pic" id="profile_pic" class="form-control-file">
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Update Profile
                                </button>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
