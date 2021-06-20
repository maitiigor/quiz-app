@extends('layouts.admin')
@section('content')
    <div class="col-8 justify-content-center">
        <table class="table table-responsive">
            <thead>
                <tr>
                    <th>
                        Test ID
                    </th>
                    <th>
                        Subject
                    </th>
                    <th>
                        Class
                    </th>
                    <th>
                        Status
                    </th>
                </tr>
            <thead>
            <tbody>
                @foreach($tests as $test)
                    <tr>
                        <td>
                            {{$test->id}}
                        </td>
                        <td>
                            {{$test->subject->name}}
                        </td>
                        <td>
                            {{$test->form->name}}
                        </td>
                        <td>
                            @if($test->status == 0)
                                Active/<a href="{{route('edit.test',[$test->id])}}">Edit</a>
                                @else
                                Inactive
                                @endif

                        </td>
                    </tr>
                   @endforeach
            </tbody>
        </table>


    </div>
    @extends('layouts.sidebar')
@endsection