@extends('layouts.app')
@section('content')
<div class="container">
    <form method="post" action="{{route('create.post')}}"enctype="multipart/form-data">
    {{csrf_field()}}
<div class ="form-group">
    <label for="caption" class="col-md-4 col-form-label text-md-right">Caption</label>

    <div class="col-md-6">
        <input id="caption" type="text" class="form-control @error('caption') is-invalid @enderror" name="caption" value="{{ old('caption') }}" required autocomplete="name" autofocus>

        @error('caption')
        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
        @enderror
    </div>
</div>
    <div class="form-group row">
        <label for="image" class="col-md-4 col-form-label text-md-right">Post Image</label>

        <div class="col-md-6">
            <input id="image" type="file" class="form-control-file @error('image') is-invalid @enderror" name="image" value="{{ old('image') }}" required autocomplete="name" autofocus>

            @error('image')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
        </div>
</div>
    <div class="form-group row justify-content-center">
    <div class="col-md-6 offset-6">
        <button type="submit" class="btn btn-primary">
            Post
        </button>
    </div>
    </div>
    </form>
@endsection
