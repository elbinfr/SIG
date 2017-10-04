<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Corporate extends Model
{
    protected $connection = 'smsdb';

    protected $table = 'corporates';

    public function client()
    {
    	return $this->belongsTo('App\Client');
    }
    
}
