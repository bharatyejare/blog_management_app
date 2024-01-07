@extends('layouts.app')  <!-- Adjust this based on your layout file -->

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Category</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('categories.update', $category->id) }}">
                            @csrf
                            @method('PUT') <!-- Use PUT method for updating -->

                            <div class="form-group">
                                <label for="title">Category Name</label>
                                <input type="text" class="form-control" id="categoryname" name="categoryname" value="{{ $category->name }}">
                            </div>

                            <div class="form-group">
                                <label for="content">Remarks</label>
                                <textarea class="form-control" id="slug" name="slug" rows="4">{{ $category->slug }}</textarea>
                            </div>
                            <div class="create_button">
                            <button type="submit" class="btn btn-primary">Update Category</button></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection