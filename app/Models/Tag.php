<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function posts() {
        return $this->morphedByMany('App\Models\Post', 'taggable');
    }

    public function comments() {
        return $this->morphedByMany('App\Models\Comment', 'taggable');
    }
}
