<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GameSummary extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'game_summaries';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at'];
}
