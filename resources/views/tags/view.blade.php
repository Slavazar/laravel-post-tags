@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col">
        <a class="btn btn-secondary" href="{{ url('tags') }}" role="button">Return</a>
        <a class="btn btn-primary" href="{{ url('tags/edit/' . $tag->id) }}" role="button">Edit</a>
        <a class="btn btn-success" href="{{ url('tags/add') }}" role="button">New Tag</a>
        <div>&nbsp;</div>
    </div>
</div>
<div class="row">
    <div class="col">
        <h2>Tag</h2>
        @if ($status = session()->get('status'))
            <div class="alert alert-info" role="alert">{{ $status }}</div>
        @endif
    </div>
</div>
<div class="row">
    <div class="col">
        <h3>Title</h3>
        <div class="mb-3">{{ $tag->title }}</div>
        <h3>Created</h3>
        <div class="mb-3">{{ $tag->created_at }}</div>
        <h3>Updated</h3>
        <div>{{ $tag->updated_at }}</div>
    </div>
</div>
<hr>
<div class="row">
    <div class="col">
        <h3>Related Posts</h3>
        @foreach ($tag->posts as $post)
        <div class="row mb-3">
            <div class="col-md-4">{{ $post->title }}</div>
            <div class="col-md-4"><a href="{{ url('/posts/view/' . $post->id) }}">View</a></div>
        </div>
        @endforeach
    </div>
</div>
@endsection
    