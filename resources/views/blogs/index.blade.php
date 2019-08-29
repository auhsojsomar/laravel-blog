@extends('layouts.app')

@section('content')
  <a href="/blogs/create" class="btn btn-primary mb-4">Create Blog</a>
    @foreach ($blogs as $blog)
    <div class="row bg-dark p-4 text-white mb-5 align-items-center">
      <div class="col-md-4">
        <img src="/storage/image/{{$blog->cover_image}}" class="w-100" alt="">
      </div>
      <div class="col-md-8">
        <blockquote class="blockquote">
            <a href="/blogs/{{$blog->id}}" class="card-title text-white h2 d-block">{{$blog->title}}</a>
            <p class="card-text">{{$blog->body}}</p>
            <div class="blockquote-footer">
              <span class="text-white">Created by 
                {{ $blog->user_id === Auth::id() ? 'You' : $blog->user->name }}
              </span> <br>
              <small>{{$blog->created_at->format('F j, Y \a\t h:i A')}}</small>
            </div>
        </blockquote>
      </div>
    </div>  
  @endforeach
  {{$blogs->links()}}
@endsection