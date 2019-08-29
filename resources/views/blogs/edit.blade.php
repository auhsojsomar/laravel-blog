@extends('layouts.app')

@section('content')
  <form action="/blogs/{{$blog->id}}" method="POST" enctype="multipart/form-data">
    <input name="_method" type="hidden" value="PUT">
    {{ csrf_field() }}
    <div class="form-group">
      <label for="title">Title</label>
      <input type="text" name="title" id="title" class="form-control" value="{{$blog->title}}">
    </div>
    <div class="form-group">
      <label for="body">Content</label>
      <textarea name="body" id="body" rows="10" class="form-control">{{$blog->body}}</textarea>
    </div>
    <div class="form-group">
      <input type="file" name="cover_image">
    </div>
    <button type="submit" class="form-control">Submit</button>
  </form>
@endsection