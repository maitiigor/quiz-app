<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>

       <nav class="navbar navbar-expand-lg bg-dark navbar-dark" >
            @if (Route::has('login'))
               <ul class="navbar-nav m-auto">
                   <li class="nav-item">
                       <a href="" class="nav-link pr-5"> Home </a>
                   </li>
                   <li class="nav-item">
                       <a href="" class="nav-link pr-5"> Profile </a>
                   </li>
                   <li class="nav-item">
                       <a href=""class="nav-link pr-5"> About </a>
                   </li>
               </ul>
                <ul class="navbar-nav ml-auto">
                    @auth
                        <li class="nav-item pl-5">
                        <a href="{{ url('/home') }}">Home</a>
                        </li>
                    @else
                        <li class="nav-item pl-5">
                        <a href="{{ route('login') }}" class="nav-link">Login</a>
                        </li>
                    <li class="nav-item pl-5">
                            <a href="{{ route('register') }}" class="nav-link">Register</a>
                     </li>
            @endif
                    @endauth
                </ul>
       </nav>
    <div class="container">
        <nav class="navbar">
            <li class="navbar-nav">
                <a href="{{route('index.post')}}" class="page-link">
                    Post
                </a>
            </li>
       </nav>

        <div class="row">
            @foreach(Auth::user()->posts as $post)
            <div class="col-md-4 ">
                    {{$post['caption']}}
                    <a href="welcome/{{$post->id}}"><img src="storage/{{$post['image']}}" class="w-100"></a>
            </div>
            @endforeach
        </div>

    </div>
    </body>
</html>
