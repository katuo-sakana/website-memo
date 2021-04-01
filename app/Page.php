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
}
