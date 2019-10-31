<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Members extends Model
{
    protected $table 		= 'warga';
    protected $primaryKey 	= 'id';
    protected $fillable   	= ['nort_id','nama','no_rumah','blok','no_telp','no_hp'];
}
