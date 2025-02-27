<?php

namespace App\Models;

use Database\Factories\PostFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    /** @use HasFactory<PostFactory> */
    use HasFactory;

    protected $table = 'posts';
    protected $guarded = [];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (Post $post) {
            $post->slug = $post->slug ?? str($post->title)->slug();
        });
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'post_tags', 'post_id', 'tag_id');
    }

    public function child_posts(User $user): Collection
    {
        return $this->hasMany(Post::class, 'post_id', 'id')->where(function ($query) use ($user) {
            $query->where('user_id', '=', $user->id)->orWhere('is_public', '=', 1);
        })->get();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
