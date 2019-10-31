<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentMonth extends Model
{
    protected $table 		= 'bulan_pembayaran';
    protected $primaryKey 	= 'id';
    protected $fillable   	= ['bulan_pembayaran'];
}
