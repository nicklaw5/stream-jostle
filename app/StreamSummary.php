<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StreamSummary extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'stream_summaries';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at'];
}
