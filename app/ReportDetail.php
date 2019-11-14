<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportDetail extends Model
{
    protected $table 		= 'detail_report';
    protected $primaryKey 	= 'id';
    protected $fillable   	= ['dept', 'keterangan', 'debit', 'credit', 'saldo', 'bulan'];
}
