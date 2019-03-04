<?php
?>
@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col">
        <a class="btn btn-secondary" href="{{ url('/posts') }}" role="button">Return</a>
        <div>&nbsp;</div>
    </div>
</div>
<div class="row">
    <div class="col">
        <h2>Add Posts</h2>
    </div>
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
        <form action="{{ url('/posts/add') }}" method="post">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="">Title</label>
                <input type="text" name="title" class="form-control" id="" value="{{ old('title') }}" placeholder="Enter a title">
            </div>
            <div class="form-group">
                <label for="">Content</label>
                <textarea name="content" class="form-control" id="" placeholder="Enter content">{{ old('description') }}</textarea>
            </div>
            <div class="form-group">
                <label for="">Tags</label>
                <select class="form-control" name="tag_id[]" multiple="multiple">
                    @foreach($tags as $tag)
                        @if (old('tag_id') && in_array($tag->id, old('tag_id')))
                            <option selected="selected" value="{{ $tag->id }}">{{ $tag->title }}</option>
                        @else
                            <option value="{{ $tag->id }}">{{ $tag->title }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection
