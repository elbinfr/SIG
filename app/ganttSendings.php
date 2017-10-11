<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ganttSendings extends Model
{
    protected $connection = 'smsdb';

    protected $table = 'gantt_sendings';
}
