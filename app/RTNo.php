<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RTNo extends Model
{
    protected $table 		= 'no_rt';
    protected $primaryKey 	= 'id';
    protected $fillable   	= ['no_rt'];
}
