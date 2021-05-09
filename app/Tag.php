<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'name',
        'user_id',
    ];

    public function getHashtagAttribute(): string
    {
        return '#' . $this->name;
    }
}
