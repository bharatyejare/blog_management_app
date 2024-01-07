@extends('layouts.app')  <!-- Make sure to adjust this based on your layout structure -->

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create Post</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('posts.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" name="title" >
                            @error('title')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                            </div>
                            <div class="form-group">
                            <label for="category_id">Select Category:</label>
                            <select class="form-control" name="category_id" id="category_id">
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                            </select>
                            </div>
                            <div class="form-group">
                                <label for="content">Content</label>
                                <textarea class="form-control" id="content" name="content" rows="4" ></textarea>
                                    @error('content')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                            </div>
                            <div class="create_button">
                            <button type="submit" class="btn btn-primary">Create Post</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
