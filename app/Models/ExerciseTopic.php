<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ExerciseTopic extends Model
{
    protected $table = 'exercise_topic';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'exercise_id',
        'topic_id',
    ];

    /**
     * Get the exercise that this record belongs to.
     */
    public function exercise(): BelongsTo
    {
        return $this->belongsTo(Exercise::class);
    }

    /**
     * Get the topic that this record belongs to.
     */
    public function topic(): BelongsTo
    {
        return $this->belongsTo(Topic::class);
    }
}
