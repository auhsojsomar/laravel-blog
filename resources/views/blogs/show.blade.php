@extends('layouts.app')

@section('content')
  <div class="card mb-3">
    <div class="card-body border border-dark">
      <a href="" class="card-title text-dark h2 d-block">{{$blog->title}}</a>
      <p class="card-text">{{$blog->body}}</p>
    </div>
    <div class="card-footer bg-dark text-light">
      <small>{{$blog->created_at->format('F j, Y \a\t h:i A')}}</small>
    </div>
  </div>  
  @if (auth()->check())
    @if (auth()->user()->id === $blog->user_id)
      <a href="/blogs/{{$blog->id}}/edit" class="btn btn-warning">Edit</a>
      <form action="/blogs/{{$blog->id}}" method="POST" class="d-inline-block">
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="DELETE">
        <button class="btn btn-danger">Delete</button>
      </form>
    @endif 
  @endif
@endsection