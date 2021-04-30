<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Page extends Model
{
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany('App\Tag', 'page_tag')->withTimestamps();
    }

    public function scopeWhereTag($query, $tag_name)
    {
        // 多対多の検索
        return $query->whereHas('tags', function ($query) use ($tag_name) {
            $query->where('tags.name', $tag_name);
        });
    }

    public function scopeWhereTagPage($query, $tagNames)
    {
        return $query->whereHas('tags', function ($query) use ($tagNames) {
            $query->whereIn('tags.name', $tagNames);
        });
    }
}
