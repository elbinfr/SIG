<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enterprise extends Model
{
    protected $table = 'enterprises';

    protected $fillable = [
    	'id',
    	'business_name',
    	'short_name',
    	'status',
    	'client_id'
    ];

    public function users()
    {
    	return $this->hasMany('App\User', 'enterprise_id');
    }
    
}
