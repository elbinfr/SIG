<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IncomingMessage extends Model
{
    //
    protected $connection = 'smsdb';

    protected $table = "incoming_message";

}
