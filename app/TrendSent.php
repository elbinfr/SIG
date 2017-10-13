<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrendSent extends Model
{
    protected $connection = 'smsdb';

    protected $table = 'trend_sent';
}
