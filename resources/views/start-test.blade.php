@extends('layouts.app')

@section('content')
    <check-button test="4" user-id="{{json_encode(Auth::user()->id)}}" :question="{{json_encode($questions)}}" :test="{{json_encode($tests)}}"></check-button>



@endsection()