<?php

namespace App\Models;

use App\Events\TaskCreated;
use App\Events\TaskUpdated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Arr;

class Task extends Model implements HasTags
{
    use HasFactory, SoftDeletes;


    protected $fillable = ['title', 'body', 'owner_id'];

    protected $dispatchesEvents = [
        'created' => TaskCreated::class,
        'updated' => TaskUpdated::class,
    ];

    protected $attributes = [
        'type' => 'new'
    ];

//    protected $appends = [
//        'double_type'
//    ];

    protected $dates = [
        'viewed_at'
    ];

    protected $casts = [
        'completed' => 'boolean',
        'options' => 'array',
        'viewed_at' => 'datetime:d.m.Y'
    ];

    public function getTypeAttribute($value)
    {
        return ucfirst($value);
    }

    public function setTypeAttribute($value)
    {
        $this->attributes['type'] = ucfirst(strtolower($value));
    }

//    public function getDoubleTypeAttribute()
//    {
//        return str_repeat($this->type, 2);
//    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function steps()
    {
        return $this->hasMany(Step::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function history()
    {
        return $this->belongsToMany(User::class, 'task_histories')->withPivot(['before', 'after'])->withTimestamps();
    }

    protected static function boot()
    {
        parent::boot();

        static::updating(function (Task $task) {

            $after = $task->getDirty();
            $task->history()->attach(auth()->id(), [
                'before' => json_encode(Arr::only($task->fresh()->toArray(), array_keys($after))),
                'after' => json_encode($after)
            ]);
        });

        static::created(function () {
            Cache::tags(['tasks'])->flush();
        });

        static::updated(function () {
            Cache::tags(['tasks'])->flush();
        });

        static::deleted(function () {
            Cache::tags(['tasks'])->flush();
        });

    }

    /**
     * @param $attributes
     * @return Model
     */
    public function addStep($attributes)
    {
        return $this->steps()->create($attributes);
    }

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function isCompleted()
    {
        return (bool) $this->completed;
    }

    public function isNotCompleted()
    {
        return (bool) !$this->completed;
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

    /**
     * @param Builder $query
     * @param $type
     * @return Builder
     */
    public function scopeOfType(Builder $query, $type): Builder
    {
        return $query->where('type', $type);
    }

    public function scopeNew(Builder $query): Builder
    {
        return $query->ofType('new');
    }

    public function company()
    {
        return $this->hasOneThrough(Company::class, User::class, 'id', 'owner_id');
    }

    public function comment()
    {
        return $this->morphToMany('App\Comment', 'commentable');
    }
}
