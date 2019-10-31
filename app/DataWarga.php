<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataWarga extends Model
{
    protected $table 		= 'data_warga';
    protected $primaryKey 	= 'id';
    protected $fillable   	= ['warga_id','pembayaran','nama','	no_rumah','blok','no_telp','no_hp','no_rt'];
}
