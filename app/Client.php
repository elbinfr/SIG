<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $connection = 'smsdb';

    protected $table = 'client';

    public function corporates()
    {
    	return $this->hasMany('App\Corporate', 'client_id');
    }
    
}
