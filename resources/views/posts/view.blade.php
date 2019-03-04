@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col">
        <a class="btn btn-secondary" href="{{ url('posts') }}" role="button">Return</a>
        <a class="btn btn-primary" href="{{ url('posts/edit/' . $post->id) }}" role="button">Edit</a>
        <a class="btn btn-success" href="{{ url('posts/add') }}" role="button">New Post</a>
        <div>&nbsp;</div>
    </div>
</div>
<div class="row">
    <div class="col">
        <h2>Post</h2>
        @if ($status = session()->get('status'))
            <div class="alert alert-info" role="alert">{{ $status }}</div>
        @endif
    </div>
</div>
<div class="row">
    <div class="col">
        <h3>Title</h3>
        <div>{{ $post->title }}</div>
        <div>&nbsp;</div>
        <h3>Content</h3>
        <div>{!! nl2br($post->content) !!}</div>
        <div>&nbsp;</div>
        <h3>Tags</h3>
        <div>{{ $post->getTagTitles() }}</div>
        <div>&nbsp;</div>
        <h3>Created</h3>
        <div>{{ $post->created_at }}</div>
        <div>&nbsp;</div>
        <h3>Updated</h3>
        <div>{{ $post->updated_at }}</div>
        <div>&nbsp;</div>
    </div>
</div>
@endsection
    