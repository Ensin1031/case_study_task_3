<?php

namespace App\Models;

use Database\Factories\TagFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /** @use HasFactory<TagFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'is_deleted',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (Tag $tag) {
            $tag->slug = $tag->slug ?? str($tag->title)->slug();
        });
    }

    public function posts(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'post_tags', 'tag_id', 'post_id');
    }
}
