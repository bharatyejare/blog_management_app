@extends('layouts.app')  {{-- Assuming you have a default app layout --}}

@section('content')
<div class="container">
    
    <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">Create Category</a>
    @if(session('notif.success'))
    <div class="alert alert-success">
    {{ session('notif.success') }}
    </div>
    @endif
    @if ($categories->count() > 0)
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Category Name</th>
                    <th>Remark</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->slug }}</td>
                        <td>{{ $category->created_at->format('Y-m-d H:i:s') }}</td>
                        <td>{{ $category->updated_at->format('Y-m-d H:i:s') }}</td>
                        <td>
                            <a href="{{ route('categories.show', $category->id) }}" class="btn btn-info btn-sm">Show</a>
                            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display: inline;">
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
        <p>No Category available.</p>
    @endif
</div>
@endsection
