<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Post extends Model
{
    public $timestamps = false;

    protected $table = 'post';

    protected $fillable = [
        'user_id',
        'title',
        'place',
        'description',
        'start_date_time',
        'end_date_time',
        'capacity_limit',
        'category_id',
        'post_strike_count',
        'approved'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(PostCategory::class, 'category_id');
    }

    public function reports(): HasMany
    {
        return $this->hasMany(Report::class, 'post_id');
    }

    public function attendances(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'attendance', 'post_id', 'user_id');
    }

    public function approvedBy(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'approved_post', 'post_id', 'approved_by');
    }

    public static function create(array $attributes): self
    {
        return new self($attributes);
    }
}
