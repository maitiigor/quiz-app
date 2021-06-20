@extends('layouts.admin')
@section('content')
    <edit-questions v-bind:questions="{{json_encode($questions)}}" v-bind:exams="{{json_encode($exam)}}" v-bind:subjects="{{json_encode($subjects)}}" v-bind:forms="{{json_encode($forms)}}" >

    </edit-questions>
    @extends('layouts.sidebar')
@endsection