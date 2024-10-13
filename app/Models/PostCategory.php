<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PostCategory extends Model
{
    protected $table = 'post_category';

    protected $fillable = [
        'name',
    ];

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class, 'category_id');
    }
}
