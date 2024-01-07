@extends('layouts.app')  {{-- Assuming you have a default app layout --}}

@section('content')
<div class="container">
    
    <a href="{{ route('posts.create') }}" class="btn btn-primary mb-3">Create Post</a>
    @if(session('notif.success'))
    <div class="alert alert-success">
    {{ session('notif.success') }}
    </div>
    @endif
    
    @if (count($posts) > 0)
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Content</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->content }}</td>
                        <td>{{ $post->created_at }}</td>
                        <td>{{ $post->updated_at }}</td>
                        <td>
                            <a href="{{ route('posts.show', $post->id) }}" class="btn btn-info btn-sm">Show</a>
                            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No posts available.</p>
    @endif
</div>
@endsection
