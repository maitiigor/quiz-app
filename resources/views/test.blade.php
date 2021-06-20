@extends('layouts.app')

@section('content')

    <div class="container">]
       <div class="row">
           <div class="col-12">
                <h2>
                    Instructions answer all questions
                </h2>
                   <br><h3>Subject :{{$test->subject->name}}</h3>
                   <br><h3>Class :{{$test->form->name}}</h3>
            </div>

       </div>
        <div class="col-12 align-self-md-auto">
            <a  href="{{route('test.create',$test->id)}}" class="btn btn-primary">continue</a>
        </div>

    </div>


@endsection()