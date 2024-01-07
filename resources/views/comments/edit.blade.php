@extends('layouts.app')  <!-- Adjust this based on your layout file -->

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Comments</div>
                    <div class="card-body">
                    <form method="POST" action="{{ route('comments.update',$comment->id) }}">
                            @csrf
                            @method('PUT') <!-- Use PUT method for updating -->
                            <div class="form-group">
                                <label for="content">Comment</label>
                                <textarea class="form-control" id="comment" name="comment" rows="4">{{$comment->content}}</textarea>
                            </div>
                            <div class="create_button">
                            <button type="submit" class="btn btn-primary">Update Comments</button></div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection