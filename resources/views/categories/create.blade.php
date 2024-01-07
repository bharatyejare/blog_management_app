@extends('layouts.app')  <!-- Make sure to adjust this based on your layout structure -->

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create Category</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('categories.store') }}">
                            @csrf
                            <input type="hidden" name="session_id" value="{{ $sessionId }}">
                            <div class="form-group">
                                <label for="title">Category Name</label>
                                <input type="text" class="form-control" id="categoryname" name="categoryname" >
                            @error('category')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                            </div>

                            <div class="form-group">
                                <label for="content">Remarks</label>
                                <textarea class="form-control" id="slug" name="slug" rows="4" ></textarea>
                                    @error('remarks')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                            </div>
                            <div class="create_button">
                            <button type="submit" class="btn btn-primary">Create Category</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
