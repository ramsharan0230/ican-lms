<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimeSet extends Model
{
    protected $table = 'time_set';

    protected $fillable = [
        'start_date',
        'end_date',
    ];
}
