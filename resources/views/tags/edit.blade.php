@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col">
        <a class="btn btn-secondary" href="{{ url('tags') }}" role="button">Return</a>
        <a class="btn btn-primary" href="{{ url('tags/view/' . $tag->id) }}" role="button">View</a>
        <a class="btn btn-success" href="{{ url('/tags/add') }}" role="button">New Tag</a>
        <div>&nbsp;</div>
    </div>
</div>
<div class="row">
    <div class="col">
        <h2>Edit Tag</h2>
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
        <form action="{{ url('/tags/edit/' . $tag->id) }}" method="post">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="">Title</label>
                <input type="text" name="title" class="form-control" id="" value="{{ old('title') ? old('title') : $tag->title }}" placeholder="Enter a title">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection
