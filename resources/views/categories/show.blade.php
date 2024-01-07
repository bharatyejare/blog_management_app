@extends('layouts.app') {{-- Assuming you have a layout file --}}

@section('content')
    <div class="container mt-4">
        
        <div class="row">
            <div class="col-md-8 offset-md-2">
            <a href="javascript:history.back()">Go Back</a>
            <div class="card">
            
  <div class="card-header">
    Category details
  </div>
  <div class="card-body">
    <span class="card-title"><b>Category Name </b>: {{$category->name}}</span></div>
    <div class="card-body">
    <span class="card-text"><b>Remarks </b>: {{$category->slug}}</span>
    <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
  </div>
</div>
            </div>
        </div>
    </div>
@endsection
