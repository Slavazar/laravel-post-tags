<?php
$tagIds = $post->getTagIds();
?>
@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col">
        <a class="btn btn-secondary" href="{{ url('posts') }}" role="button">Return</a>
        <a class="btn btn-primary" href="{{ url('posts/view/' . $post->id) }}" role="button">View</a>
        <a class="btn btn-success" href="{{ url('/posts/add') }}" role="button">New Post</a>
        <div>&nbsp;</div>
    </div>
</div>
<div class="row">
    <div class="col">
        <h2>Edit Post</h2>
    </div>
    @if ($status = session()->get('status'))
        <div class="col-lg-12">
            <div class="alert alert-info" role="alert">{{ $status }}</div>
        </div>
    @endif
</div>
<div class="row">
    <div class="col">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ url('/posts/edit/' . $post->id) }}" method="post">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="">Title</label>
                <input type="text" name="title" class="form-control" id="" value="{{ old('title') ? old('title') : $post->title }}" placeholder="Enter a title">
            </div>
            <div class="form-group">
                <label for="">Description</label>
                <textarea name="content" class="form-control" id="" placeholder="Enter content">{{ old('content') ? old('content') : $post->content }}</textarea>
            </div>
            <div class="form-group">
                <label for="">Tags</label>
                <select class="form-control" name="tag_id[]" multiple="multiple">
                    @foreach($tags as $tag)
                        @if (old('tag_id'))
                            @if (in_array($tag->id, old('tag_id')))
                                <option selected="selected" value="{{ $tag->id }}">{{ $tag->title }}</option>
                            @else
                                <option value="{{ $tag->id }}">{{ $tag->title }}</option>
                            @endif
                        @else
                            @if (in_array($tag->id, $tagIds))
                                <option selected="selected" value="{{ $tag->id }}">{{ $tag->title }}</option>
                            @else
                                <option value="{{ $tag->id }}">{{ $tag->title }}</option>
                            @endif
                        @endif
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection
