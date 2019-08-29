@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a href="/blogs/create" class="btn btn-primary mb-3">Create Blog</a>
                    <h2>Your Posts</h2>
                    <table class="table">
                        <thead>
                            <th style="width:70%">Title</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach ($blogs as $blog)
                                <tr>
                                    <td>{{$blog->title}}</td>
                                    <td><a href="/blogs/{{$blog->id}}/edit" class="btn btn-warning">Edit</a><form class="d-inline" action="/blogs/{{$blog->id}}" method="POST">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button class="btn btn-danger" type="submit">Delete</button>
                                    </form></td>
                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
