<?php

namespace App\Models;

use App\Events\TaskCreated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class Task extends Model implements HasTags
{
    use HasFactory, SoftDeletes;


    protected $fillable = ['title', 'body', 'owner_id'];

    protected $dispatchesEvents = [
        'created' => TaskCreated::class,
    ];

    protected $attributes = [
        'type' => 'new'
    ];

    protected $appends = [
        'double_type'
    ];

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('onlyNew', function (Builder $builder) {
            $builder->new();
        });
    }

    public function getTypeAttribute($value)
    {
        return ucfirst($value);
    }

    public function setTypeAttribute($value)
    {
        $this->attributes['type'] = ucfirst(strtolower($value));
    }

    public function getDoubleTypeAttribute()
    {
        return str_repeat($this->type, 2);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function steps()
    {
        return $this->hasMany(Step::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
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
    public function scopeIncomplete(Builder $query): Builder
    {
        return $query->where('completed', 0);
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
}
