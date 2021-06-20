@extends('layouts.app')

@section('content')
    <div>
        @foreach (explode('&', $answers) as $chunk) {
        $param = explode("=", $chunk);

        @if ($param) {
        {{printf("Value for parameter \"%s\" is \"%s\"<br/>\n", urldecode($param[0]), urldecode($param[1]))}}
        }
        @endif
        }
            @endforeach
    </div>



@endsection()