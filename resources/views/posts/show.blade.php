@extends('layouts.app') {{-- Assuming you have a layout file --}}

@section('content')
<div class="container mt-4">

  <div class="row">
    <div class="col-md-8 offset-md-2">
      <a href="javascript:history.back()">Go Back</a>
      <div class="card">

        <div class="card-header">
          Post details
        </div>
        <?php
        if (!empty($post)) {
        ?>
        <div class="card-body">
          <span class="card-title"><b>Title </b>: {{$post->title}}</span>
        </div>
        <div class="card-body">
          <span class="card-text"><b>Content </b>: {{$post->content}}</span>
        </div>
        @foreach($categories as $category)
        @if($category->id == $post->category_id)
        <div class="card-body">
          <span class="card-text"><b>Category </b>: {{$category->name}}</span>
        </div>
        @endif
        @endforeach
        <?php
        }
        ?>
      </div>
    </div>
  </div>
</div>
<!-- Form for adding new comment -->
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <!-- <div class="card"> -->
      <!-- <div class="card-header">Add Comment</div> -->

      <div class="card-body">
        <form method="POST" action="{{ route('comments.store') }}">
          @csrf
          <?php
          if(!empty($postId)){
          ?>
          <input type="hidden" name="post_id" value="{{ $postId }}">
          <?php
          }
          ?>
          <div class="form-group">
            <label for="content">Comment</label>
            <textarea class="form-control" id="comment" name="comment" rows="4"></textarea>
            @error('comment')
            <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>
          <div class="create_button">
            <button type="submit" class="btn btn-primary">Add Comment...</button>
          </div>
        </form>
      </div>
      <!-- </div> -->
    </div>
  </div>

</div>

<div class="container mt-4">

  <div class="row">
    <div class="col-md-8 offset-md-2">
      <div class="card">

        <div class="card-header">
          Comment details
        </div>
        <?php
       //echo "<pre>";print_r($comments_details);die();
        if (!empty($comments_details)) {
        foreach($comments_details as $value){
        ?>
        <div class="card">
          <div class="card-body">
            <div class="" style="margin-left: 100%;">
              <i class="fas fa-ellipsis-vertical" data-bs-toggle="dropdown" aria-expanded="false"></i>
              <ul class="dropdown-menu">
                <li>
                  <span class="dropdown-item">
                 
                  <a href="{{ url('/comments/' . $value->id . '/edit') }}" class="fas fa-pen mx-2"></a>
                  </span>
                </li>
                <li>
                  <span class="dropdown-item">
                    <form action="{{ route('comments.destroy', $value->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                  </span>
                </li>
              </ul>
            </div>
            <span class="card-title">{{$value->name}}</span>
          </div>
          <div class="card-body">
            <span class="card-text">{{$value->content}}</span>
          </div>
        </div>
        <?php
          }
        }
        ?>
      </div>
    </div>
  </div>
</div>
@endsection