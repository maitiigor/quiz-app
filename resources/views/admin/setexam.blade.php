@extends('layouts.admin')
@section('content')
    <div class="col-8 justify-content-center">

                <h3 class="text-center">Questions</h3>
                <set-questions :subjects="{{$subjects}}"></set-questions>

               <!-- <script>
                    function generate() {

                        let a = parseInt(document.getElementById("quesno").value);
                        let questions = document.getElementById("questions");

                        for (let i = 0; i < a; i++) {
                            let input = document.createElement("input");
                            questions.appendChild(input);
                        }
                    }
                </script>
                -->

    </div>
@extends('layouts.sidebar')
@endsection