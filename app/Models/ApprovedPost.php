<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ApprovedPost extends Pivot
{
    protected $table = 'approved_post';

    protected $fillable = [
        'post_id',
        'approved_by'
    ];

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class, 'post_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public static function create(array $attributes): self
    {
        return new self($attributes);
    }
}
