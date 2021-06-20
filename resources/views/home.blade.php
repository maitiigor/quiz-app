@extends('layouts.app')

@section('content')
<div class="container">


    <follow-button user-id="{{Auth::user()->id}}" follows="{{$follows ?? ''}}"></follow-button>

    <div class="row">
        @foreach(Auth::user()->posts as $post)
            <div class="col-md-4"  >
                {{$post['caption']}}
            </div>
        @endforeach
        </div>
    <div class="row">
        <div class="col-12">
            <h2 class="text-center">Take Your Test</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <h2> Subject</h2>
        </div>
        <div class="col-6">
            <h2> Class</h2>
        </div>
    </div>
    <br>
    <div class="row">
        @foreach($tests as $test)
        <div class="col-6">
            <h3><a href="{{route('test.index',[$test->id])}}">{{$test->subject->name}}</a></h3>
        </div>
            <div class="col-6">
                <h3>{{$test->form->name}}
            </div>
        @endforeach
    </div>

   <!-- <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                   @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>-->
</div>

@endsection
