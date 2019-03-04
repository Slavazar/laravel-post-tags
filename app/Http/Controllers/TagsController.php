<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tags = new Tag();
        
        $filter = $request->query('filter');
        
        if ($filter) {
            if (isset($filter['title'])) {
                $tags = $tags->where('title', 'like', '%' . $filter['title'] . '%');
            }
        }
        
        $tags = $tags->paginate(10);
        
        return view('tags.index', ['tags' => $tags]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tags.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|min:2|max:100',
        ]);
        
        $tag = Tag::create($validatedData);
        
        $request->session()->flash('status', 'The tag was added successfully');
        
        return redirect('/tags/edit/' . $tag->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  integer  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tag = Tag::findOrFail($id);
        return view('tags.view', ['tag' => $tag]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  integer  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tag = Tag::findOrFail($id);
        return view('tags.edit', ['tag' => $tag]);
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
        $tag = Tag::findOrFail($id);
        
        $validatedData = $request->validate([
            'title' => 'required|min:2|max:100',
        ]);
        
        $result = $tag->fill($validatedData)->save();
        
        $request->session()->flash('status', 'The tag was updated successfully');
        
        return redirect('/tags/edit/' . $tag->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  integer  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $tag = Tag::findOrFail($id);
        
        $tag->delete();
        
        $posts = $tag->posts;
        
        foreach ($posts as $post) {
            $post->tags()->detach($tag->id);
        }
        
        $request->session()->flash('status', 'The tag was deleted successfully');
        
        return redirect('/tags');
    }
}
