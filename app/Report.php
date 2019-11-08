<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $table 		= 'report';
    protected $primaryKey 	= 'id';
    protected $fillable   	= ['departement', 'pic', 'anggaran_tahun', 'flexibity_rate', 'anggaran_bulan','ytd','current_month', 'bulan','saving_ytd'];
}
