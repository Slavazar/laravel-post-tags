<?php
$filter = request()->query('filter');
$filterTitle = '';

if ($filter) {
    if (isset($filter['title'])) {
        $filterTitle = $filter['title'];
    }
}
?>
@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col">
        <a class="btn btn-primary" href="{{ url('/posts/add') }}" role="button">Add Posts</a>
        <div>&nbsp;</div>
    </div>
</div>
<div class="row">
    <div class="col">
        <h2>Posts</h2>
        @if ($status = session()->get('status'))
            <div class="alert alert-info" role="alert">{{ $status }}</div>
        @endif
    </div>
</div>
<div class="row mb-4">
    <div class="col">
        <form action="{{ url('/posts') }}">
            <div class="form-row align-items-center">
                <div class="col-sm-3 my-1">
                    <label class="sr-only" for="inlineFormInputName">Title</label>
                    <input type="text" name="filter[title]" value="{{ $filterTitle }}" class="form-control" id="inlineFormInputName" placeholder="Enter a title">
                </div>
                <div class="col-auto my-1">
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <a href="{{ url('/posts') }}" class="btn btn-primary">Clear</a>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Title</th>
                    <th scope="col">Tags</th>
                    <th scope="col">Created</th>
                    <th scope="col">Updated</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($posts as $post)
                    <tr>
                    <th scope="row">{{ $post->id }}</th>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->getTagTitles() }}</td>
                    <td>{{ $post->created_at }}</td>
                    <td>{{ $post->updated_at }}</td>
                    <td>
                        <a class="btn btn-success" href="{{ url('/posts/view/' . $post->id) }}" role="button"><i class="fa fa-eye"></i></a>
                        <a class="btn btn-primary" href="{{ url('/posts/edit/' . $post->id) }}" role="button"><i class="fa fa-edit"></i></a>
                        <a class="btn btn-danger item-delete" href="#" role="button" data-item-id="{{ $post->id }}"><i class="fa fa-trash"></i></a>
                        <form class="item-delete-form" action="{{ url('/posts/delete/' . $post->id) }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {!! $posts->appends(request()->except('page'))->render() !!}
        </div>
    </div>
</div>
<script type="text/javascript">
$(function() {
    $(".item-delete").click(function(event) {
        var itemId = $(this).data('item-id');
        var confirmed = confirm('Are you sure to delete #' + itemId + '?');

        if (confirmed == false) {
            event.preventDefault();
        } else {
            $(this).next('.item-delete-form').submit();
        }
    });
    
});
</script>
@endsection
    
