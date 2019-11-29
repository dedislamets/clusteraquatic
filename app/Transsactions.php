<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transsactions extends Model
{
    protected $table 		= 'new_transaksi';
    protected $primaryKey 	= 'id';
    protected $fillable   	= ['warga_id','periode','pembayaran'];
}
