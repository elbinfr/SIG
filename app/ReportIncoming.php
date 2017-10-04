<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportIncoming extends Model
{
    protected $connection = 'smsdb';

    protected $table = "reportincomingmessagepos";
}
