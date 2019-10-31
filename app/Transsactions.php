<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transsactions extends Model
{
    protected $table 		= 'transaksi';
    protected $primaryKey 	= 'id';
    protected $fillable   	= ['warga_id','pembayaran'];
}
