@extends('layouts.app')  <!-- Adjust this based on your layout file -->

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Post</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('posts.update', $post->id) }}">
                            @csrf
                            @method('PUT') <!-- Use PUT method for updating -->

                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}">
                            </div>
                            <div class="form-group">
                            <label for="category_id">Select Category:</label>
                            <select class="form-control" name="category_id" id="category_id">
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}" @if($category->id == $post->category_id) selected @endif>{{ $category->name }}</option>
                            @endforeach
                            </select>
                            </div>
                            <div class="form-group">
                                <label for="content">Content</label>
                                <textarea class="form-control" id="content" name="content" rows="4">{{ $post->content }}</textarea>
                            </div>
                            <div class="create_button">
                            <button type="submit" class="btn btn-primary">Update Post</button></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection