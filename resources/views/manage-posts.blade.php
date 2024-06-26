@extends('layouts.app')

@section('title', 'Manage Resources')

@section('content')
<div class="container mt-5">
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <div class="row mb-3 justify-content-end">
        <div class="col-md-12">
            <form action="{{ route('posts.index') }}" method="GET">
                <div class="input-group search-bar">
                    <input type="text" name="search" class="form-control rounded-pill search-input" placeholder="Search posts...">
                    <div class="input-group-append" style="margin-left: 10px;">
                        <button type="submit" class="btn btn-primary rounded-pill px-4">Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Button to create a new post -->
    <a href="{{ route('posts.create') }}" class="btn btn-primary mb-3">Create New Post</a>

    @if($posts->count())
        @foreach($posts as $post)
            <div class="card mb-3">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-10">
                            <h3 class="card-title">
                                <a href="{{ route('public-posts.show', $post->id) }}">{{ $post->title }}</a>
                            </h3>
                            <p class="card-text">{{ Str::limit($post->content, 100) }}</p>
                        </div>
                        <div class="col-md-2 text-right">
                            <div class="d-inline-block">
                                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning btn-sm mr-10">Edit Post</a>
                                <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this post?')">Delete Post</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <h5 class="mt-3">Comments: {{ $post->comments->count() }}</h5>
                    <!-- Comments section -->
                    @foreach($post->comments as $comment)
                        <div class="ml-4 mb-2">
                            <p><strong>{{ $comment->user->name }}:</strong> {{ $comment->content }}</p>
                            <!-- Edit and Delete buttons for the comment -->
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    @if(auth()->user()->isAdmin() || auth()->user()->id == $comment->user_id)
                                        <a href="{{ route('comments.edit', $comment->id) }}" class="btn btn-warning btn-sm">Edit Comment</a>
                                        <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this comment?')">Delete Comment</button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    @else
        <p class="text-center">No post found with the given title or content.</p>
    @endif
    <div class="d-flex justify-content-center">
        {{ $posts->links('pagination::bootstrap-4') }}
    </div>
</div>
@endsection
