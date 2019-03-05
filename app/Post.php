<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title', 'content'
    ];
    
    public function tags()
    {
        return $this->belongsToMany('App\Tag', 'post_tag')->withTimestamps();
    }
    
    public function getTagIds()
    {
        $ids = [];
        foreach ($this->tags as $tag) {
            $ids[] = $tag->id;
        }
        return $ids;
    }
    
    public function getTagTitles()
    {
        $titles = [];
        foreach ($this->tags as $tag) {
            $titles[] = $tag->title;
        }
        return implode(', ', $titles);
    }
}
