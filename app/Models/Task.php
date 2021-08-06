<?php

namespace App\Models;

use App\Mail\TaskCreated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'body', 'owner_id'];

    public static function boot()
    {
        parent::boot();

        static::created(function ($task) {
            Mail::to($task->owner->email)->send(
                new TaskCreated($task)
            );
        });
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
}
