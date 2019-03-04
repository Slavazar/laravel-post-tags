<?php

namespace App\Http\Controllers;

use App\Post;
use App\Tag;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $posts = new Post();
        
        $filter = $request->query('filter');
        
        if ($filter) {
            if (isset($filter['title'])) {
                $posts = $posts->where('title', 'like', '%' . $filter['title'] . '%');
            }
        }
        
        $posts = $posts->with('tags')->paginate(10);
        
        return view('posts.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::get();
        
        return view('posts.add', ['tags' => $tags]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->input();
        
        $validatedData = $request->validate([
            'title' => 'required|min:3|max:100',
            'content' => 'required|min:5|max:500',
        ]);
        
        $post = Post::create($validatedData);
        
        if (isset($input['tag_id'])) {
            $tagIds = [];

            foreach ($input['tag_id'] as $tagid) {
                $tagIds[] = $tagid;
            }

            $post->tags()->sync($tagIds);
        }
        
        $request->session()->flash('status', 'The post was added successfully');
        
        return redirect('/posts/edit/' . $post->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  integer  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.view', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  integer  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        
        $tags = Tag::get();
        
        return view('posts.edit', [
            'post' => $post,
            'tags' => $tags
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  integer  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        
        $validatedData = $request->validate([
            'title' => 'required|min:3|max:100',
            'content' => 'required|min:5|max:500',
        ]);
        
        $result = $post->fill($validatedData)->save();
        
        $input = $request->input();
        
        if (isset($input['tag_id'])) {
            $tagIds = [];

            foreach ($input['tag_id'] as $tagid) {
                $tagIds[] = $tagid;
            }

            $post->tags()->sync($tagIds);
        } else {
            $post->tags()->sync([]);
        }
        
        $request->session()->flash('status', 'The post was updated successfully');
        
        return redirect('/posts/edit/' . $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  integer  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        
        $post->delete();
        
        $post->tags()->sync([]);
        
        $request->session()->flash('status', 'The post was deleted successfully');
        
        return redirect('/posts');
    }
}
