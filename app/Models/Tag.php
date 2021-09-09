<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function tasks()
    {
        return $this->morphedByMany(Task::class, 'taggable');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function steps()
    {
        return $this->morphedByMany(Step::class, 'taggable');
    }


    /**
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'name';
    }

    /**
     * @return mixed
     */
    public static function tagsCloud()
    {
        return (new static())->has('tasks')->get();
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function () {
            Cache::tags(['tags'])->flush();
        });
        static::updated(function () {
            Cache::tags(['tags'])->flush();
        });
    }
}
