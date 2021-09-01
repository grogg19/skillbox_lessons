<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Step extends Model implements HasTags
{
    use HasFactory;

    protected $fillable = ['description', 'completed'];

    protected $touches = [
        'task'
    ];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function complete($completed = true)
    {
        $this->update(['completed' => $completed]);
    }

    public function incomplete()
    {
        $this->complete(false);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeIncompleted(Builder $query): Builder
    {
        return $query->where('completed', false);
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeCompleted(Builder $query): Builder
    {
        return $query->where('completed', true);
    }

    public function owner()
    {
        return $this->hasOneThrough(User::class, Task::class, 'id', 'id', 'task_id', 'owner_id');
    }
}
