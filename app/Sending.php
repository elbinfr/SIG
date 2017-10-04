<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sending extends Model
{
    protected $connection = 'smsdb';

    protected $table = 'sendings';

    public function scopeDateRange($query, $array)
    {
        return $query->whereDate('scheduled_start_date', '>=', $array[0])
                        ->whereDate('scheduled_start_date', '<=', $array[1]);
    }

}
