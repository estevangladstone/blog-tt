<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Negotiation extends Model
{
    protected $table = 'negotiations';

    public function findByToken ($token) {
    	return self::findOrFail($token);
    }

    public function messages () {
    	return $this->hasMany('App\Message');
    }
}
