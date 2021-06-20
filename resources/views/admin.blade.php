@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="col-4">
            <span class="fa fa-user fa-4x"></span>
            Number of users{{$users}}
        </div>
        <div class="col-4"></div>
        <div class="col-4"></div>
    </div>
@extends('layouts.sidebar')
@endsection

