<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'messages';

    protected $fillable = ['body', 'user_id', 'negotiation_id'];

    public function negotiation () {
    	return $this->belongsTo('App\Negotiation');
    }
}
