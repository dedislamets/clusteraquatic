<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Excel;
use File;
use App\RTNo;
use App\Members;
use App\Transsactions;
use App\DataWarga;
use App\Report;
use App\ReportDetail;
use DB;


class DashboardController extends Controller
{
    public function index()
    {
    	return 1;
    }

    public function import(Request $request)
    {
        set_time_limit(0);
        if ($request->hasFile('file') && $request->input('jenis') == "iuran") {
           
            $extension = File::extension($request->file->getClientOriginalName());
            if ($extension == "xlsx" || $extension == "xls" || $extension == "csv") {
                $path   = $request->file->getRealPath();
                config(['excel.import.startRow' => 4]);
                $data   = Excel::selectSheetsByIndex(0)->load($path)->get()->toArray();
                //truncate
                $trun_rt = RTNo::truncate();
                $trun_member = Members::truncate();
                $trun_transaction = Transsactions::truncate();
                $rt_data = [];
                $log = [];
                foreach ($data as $key => $value) {

                    if (!empty($value['nama_pemilik'])) {
                        // Insert No RT
                        $rt = $value['rt'];

                        if (!in_array($rt, $rt_data)) {
                            $rt_data[]          = $rt;
                            $model_nort         = new RTNo();
                            $model_nort->no_rt  = $rt;
                            $insert_rt          = $model_nort->save();
                        }
                        // Insert warga
                        $nort_id = RTNo::where('no_rt', $value['rt'])->first();
                        $nort_id = $nort_id['id'];
                            $model_warga            = new Members();
                            $model_warga->nort_id   = $nort_id;
                            $model_warga->nama      = !empty($value['nama_pemilik']) ? $value['nama_pemilik'] : '-';
                            $model_warga->no_rumah  = !empty($value['no_rumah']) ? $value['no_rumah'] : '-';
                            $model_warga->blok      = !empty($value['blok']) ? $value['blok'] : '-';
                            $model_warga->no_telp   = !empty($value['telp._rumah']) ? $value['telp._rumah'] : 0;  
                            $model_warga->no_hp     = !empty($value['handphone']) ? $value['handphone'] : '-';  
                            $insert_warga           = $model_warga->save();

                        // Insert Transaktion
                        $warga_id = Members::where('nama', $value['nama_pemilik'])
                                    ->where('no_rumah', $value['no_rumah'])->first();
                        $warga_id = $warga_id['id'];


                        $tahun = date("Y");
                        
                        if (array_key_exists("jan_19",$value)) {  
                            $model_transaksi             = new Transsactions();
                            $model_transaksi->warga_id   = $warga_id;
                            $model_transaksi->periode    = "01-". $tahun;
                            $model_transaksi->pembayaran = (empty($value["jan_19"])? 0 : $value["jan_19"] );
                            $insert_transaksi            = $model_transaksi->save();
                        }
                        if (array_key_exists("feb_19",$value)) {  
                            $model_transaksi             = new Transsactions();
                            $model_transaksi->warga_id   = $warga_id;
                            $model_transaksi->periode    = "02-". $tahun;
                            $model_transaksi->pembayaran = (empty($value["feb_19"])? 0 : $value["feb_19"] );
                            $insert_transaksi            = $model_transaksi->save();
                        }
                        if (array_key_exists("mar_19",$value)) {  
                            $model_transaksi             = new Transsactions();
                            $model_transaksi->warga_id   = $warga_id;
                            $model_transaksi->periode    = "03-". $tahun;
                            $model_transaksi->pembayaran = (empty($value["mar_19"])? 0 : $value["mar_19"] );
                            $insert_transaksi            = $model_transaksi->save();
                        }
                        if (array_key_exists("apr_19",$value)) {  
                            $model_transaksi             = new Transsactions();
                            $model_transaksi->warga_id   = $warga_id;
                            $model_transaksi->periode    = "04-". $tahun;
                            $model_transaksi->pembayaran = (empty($value["apr_19"])? 0 : $value["apr_19"] );
                            $insert_transaksi            = $model_transaksi->save();
                        }
                        if (array_key_exists("mei_19",$value)) {  
                            $model_transaksi             = new Transsactions();
                            $model_transaksi->warga_id   = $warga_id;
                            $model_transaksi->periode    = "05-". $tahun;
                            $model_transaksi->pembayaran = (empty($value["mei_19"])? 0 : $value["mei_19"] );
                            $insert_transaksi            = $model_transaksi->save();
                        }
                        if (array_key_exists("juni_19",$value)) {  
                            $model_transaksi             = new Transsactions();
                            $model_transaksi->warga_id   = $warga_id;
                            $model_transaksi->periode    = "06-". $tahun;
                            $model_transaksi->pembayaran = (empty($value["juni_19"])? 0 : $value["juni_19"] );
                            $insert_transaksi            = $model_transaksi->save();
                        }
                        if (array_key_exists("jul19",$value)) {  
                            $model_transaksi             = new Transsactions();
                            $model_transaksi->warga_id   = $warga_id;
                            $model_transaksi->periode    = "07-". $tahun;
                            $model_transaksi->pembayaran = (empty($value["jul19"])? 0 : $value["jul19"] );
                            $insert_transaksi            = $model_transaksi->save();
                        }
                        if (array_key_exists("agust_19",$value)) {  
                            $model_transaksi             = new Transsactions();
                            $model_transaksi->warga_id   = $warga_id;
                            $model_transaksi->periode    = "08-". $tahun;
                            $model_transaksi->pembayaran = (empty($value["agust_19"])? 0 : $value["agust_19"] );
                            $insert_transaksi            = $model_transaksi->save();
                        }
                        if (array_key_exists("sep_19",$value)) {  
                            $model_transaksi             = new Transsactions();
                            $model_transaksi->warga_id   = $warga_id;
                            $model_transaksi->periode    = "09-". $tahun;
                            $byar=0;
                            if(!empty( trim($value["sep_19"]) )){
                                $byar = trim($value["sep_19"]);
                            }
                            $model_transaksi->pembayaran = $byar;
                            $insert_transaksi            = $model_transaksi->save();
                        }
                        if (array_key_exists("okt_19",$value)) {  
                            $model_transaksi             = new Transsactions();
                            $model_transaksi->warga_id   = $warga_id;
                            $model_transaksi->periode    = "10-". $tahun;
                            $model_transaksi->pembayaran = (empty($value["okt_19"])? 0 : $value["okt_19"] );
                            $insert_transaksi            = $model_transaksi->save();
                        }
                        if (array_key_exists("nov_19",$value)) {  
                            $model_transaksi             = new Transsactions();
                            $model_transaksi->warga_id   = $warga_id;
                            $model_transaksi->periode    = "11-". $tahun;
                            $model_transaksi->pembayaran = (empty($value["nov_19"])? 0 : $value["nov_19"] );
                            $insert_transaksi            = $model_transaksi->save();
                        }
                        if (array_key_exists("des_19",$value)) {  
                            $model_transaksi             = new Transsactions();
                            $model_transaksi->warga_id   = $warga_id;
                            $model_transaksi->periode    = "12-". $tahun;
                            $model_transaksi->pembayaran = (empty($value["des_19"])? 0 : $value["des_19"] );
                            $insert_transaksi            = $model_transaksi->save();
                        }


                        // $bulan_pembayaran = [
                        //     'jan_19'    => !empty($value['jan_19']) ? $value['jan_19'] : 0,
                        //     'feb_19'    => !empty($value['feb_19']) ? $value['feb_19'] : 0,
                        //     'mar_19'    => !empty($value['mar_19']) ? $value['mar_19'] : 0,
                        //     'apr_19'    => !empty($value['apr_19']) ? $value['apr_19'] : 0,
                        //     'mei_19'    => !empty($value['mei_19']) ? $value['mei_19'] : 0,
                        //     'juni_19'   => !empty($value['juni_19']) ? $value['juni_19'] : 0,
                        //     'jul_19'    => !empty($value['jul19']) ? $value['jul19'] : 0,
                        //     'agust_19'  => !empty($value['agust_19']) ? $value['agust_19'] : 0,
                        //     'sep_19'    => !empty($value['sep_19']) ? $value['sep_19'] : 0,
                        //     'okt_19'    => !empty($value['okt_19']) ? $value['okt_19'] : 0,
                        //     'nov_19'    => !empty($value['nov_19']) ? $value['nov_19'] : 0,
                        //     'des_19'    => !empty($value['des_19']) ? $value['des_19'] : 0,
                        // ];

                        // $model_transaksi             = new Transsactions();
                        // $model_transaksi->warga_id   = $warga_id;
                        // $model_transaksi->pembayaran = json_encode($bulan_pembayaran);
                        // $insert_transaksi            = $model_transaksi->save();
                        

                    }
                }
                if ($insert_rt && $insert_warga && $insert_transaksi) {
                    $result = [
                        'status' => true,
                        'message' => 'Import success',
                        'data' => $log
                    ];

                    return response()->json($result, 200);
                } else{
                    $result = [
                        'status' => true,
                        'message' => 'Import failed',
                    ];

                    return response()->json($result, 200);
                }
            }
        }else if ($request->hasFile('file') && $request->input('jenis') == "ppl") {
           
            $extension = File::extension($request->file->getClientOriginalName());

            if ($extension == "xlsx" || $extension == "xls" || $extension == "csv") {

                // Worksheet Main
                $path   = $request->file->getRealPath();
                config(['excel.import.startRow' => 3]);
                $data   = Excel::selectSheets("Upload")->load($path)->get();
                
                $get_date = date("m-Y");
                $insert_report = false;
                $trun_report = Report::where('bulan',$get_date)->delete();
                foreach ($data as $key => $value) {

                    if (!empty($value['departement'])) {
                        $model_report            = new Report();
                        $model_report->departement        = !empty($value['departement']) ? $value['departement'] : '';
                        $model_report->pic               = !empty($value['pic']) ? $value['pic'] : '';
                        $model_report->anggaran_tahun    = !empty($value['anggaran_tahun_semua_dept']) ? $value['anggaran_tahun_semua_dept'] : '0';
                        $model_report->flexibity_rate    = !empty($value['flexibity_rate']) ? $value['flexibity_rate'] : 0;
                        $model_report->anggaran_bulan    = !empty($value['anggaran_bulan']) ? $value['anggaran_bulan'] : 0;
                        $model_report->ytd               = !empty($value['ytd']) ? $value['ytd'] : 0; 
                        $model_report->current_month     = !empty($value['current_month']) ? $value['current_month'] : 0; 
                        $model_report->bulan             = $get_date;  
                        $model_report->saving_ytd        = !empty($value['saving_ytd']) ? $value['saving_ytd'] : 0;  
                       
                        $insert_report                   = $model_report->save();

                        
                    }
                }

                // Worksheet Detail
                config(['excel.import.startRow' => 6]);
                $data_detail   = Excel::selectSheets("Report detail")->load($path)->get();
                //dd($data_detail);
                $trun_report_detail = ReportDetail::where('bulan',$get_date)->delete();
                foreach ($data_detail as $key => $value) {
                    if (!empty($value['dept']) || !empty($value['keterangan'])) {
                        $model_report_detail                = new ReportDetail();
                        $model_report_detail->voucher_no    = !empty($value['voucher_no']) ? $value['voucher_no'] : '';
                        $model_report_detail->dept          = !empty($value['dept']) ? $value['dept'] : '';
                        $model_report_detail->keterangan    = !empty($value['keterangan']) ? $value['keterangan'] : '';
                        $model_report_detail->debit         = !empty($value['debit']) ? $value['debit'] : '0';
                        $model_report_detail->credit        = !empty($value['credit']) ? $value['credit'] : 0;
                        $model_report_detail->saldo         = !empty($value['saldo_balance']) ? $value['saldo_balance'] : 0; 
                        $model_report_detail->bulan         = $get_date;  
                        $model_report_detail->save();
                        
                    }
                }

                if ($insert_report) {
                    $result = [
                        'status' => true,
                        'message' => 'Import success',
                    ];

                    return response()->json($result, 200);
                } else{
                    $result = [
                        'status' => true,
                        'message' => 'Import failed',
                    ];

                    return response()->json($result, 200);
                }
            }
        }
    }

    public function dataTransactions(Request $request)
    {
        $input = $request->all();
        $filter = isset($input['data']) ? $input['data'] : [];
        
        $filter_query = array();
        $month = isset($filter['month'])? $filter['month'] : '';
        $year = isset($filter['year'])? $filter['year'] : '';
        if($month !=""){
            $filter_query['month'] = implode("-". $year ."','",$month). "-" .$year ;
        }
        $rt = isset($filter['rt'])? $filter['rt'] : '';
        if($rt !=""){
            $filter_query['rt'] = implode("','",$rt);
        }
        $status = isset($filter['status'])? $filter['status'] : '';
        if($status !=""){
            $filter_query['status'] = $status;
        }
        
        $operator="";
        if(in_array('belum',$filter_query['status']) && in_array('sudah',$filter_query['status'])){

        }elseif (in_array('belum',$filter_query['status'])) {
            $operator = "=";
        }elseif (in_array('sudah',$filter_query['status'])) {
            $operator = ">";
        }


        $query_bayar = "";
        $query = "SELECT warga.nama,nort_id,blok,no_rumah,trans.* FROM warga INNER JOIN (
                    SELECT
                        warga_id, ";
                    if (strpos($filter_query['month'], '01-2019') !== false) {
                        $query .= "SUM(CASE WHEN (periode = '01-2019') THEN pembayaran ELSE 0 END) AS Januari,";
                        $query_bayar .= " Januari ". $operator ." 0 and";
                    }
                    if (strpos($filter_query['month'], '02-2019') !== false) {
                        $query .= "SUM(CASE WHEN (periode = '02-2019') THEN pembayaran ELSE 0 END) AS Februari,";
                        $query_bayar .= " Februari ". $operator ." 0 and";
                    }
                    if (strpos($filter_query['month'], '03-2019') !== false) {
                        $query .= "SUM(CASE WHEN (periode = '03-2019') THEN pembayaran ELSE 0 END) AS Maret,";
                        $query_bayar .= " Maret ". $operator ." 0 and";
                    }
                    if (strpos($filter_query['month'], '04-2019') !== false) {
                        $query .= "SUM(CASE WHEN (periode = '04-2019') THEN pembayaran ELSE 0 END) AS April,";
                        $query_bayar .= " April ". $operator ." 0 and";
                    }
                    if (strpos($filter_query['month'], '05-2019') !== false) {
                        $query .= "SUM(CASE WHEN (periode = '05-2019') THEN pembayaran ELSE 0 END) AS Mei,";
                        $query_bayar .= " Mei ". $operator ." 0 and";
                    }
                    if (strpos($filter_query['month'], '06-2019') !== false) {
                        $query .= "SUM(CASE WHEN (periode = '06-2019') THEN pembayaran ELSE 0 END) AS Juni,";
                        $query_bayar .= " Juni ". $operator ." 0 and";
                    }
                    if (strpos($filter_query['month'], '07-2019') !== false) {
                        $query .= "SUM(CASE WHEN (periode = '07-2019') THEN pembayaran ELSE 0 END) AS Juli,";
                        $query_bayar .= " Juli ". $operator ." 0 and";
                    }
                    if (strpos($filter_query['month'], '08-2019') !== false) {
                        $query .= "SUM(CASE WHEN (periode = '08-2019') THEN pembayaran ELSE 0 END) AS Agustus,";
                        $query_bayar .= " Agustus ". $operator ." 0 and";
                    }
                    if (strpos($filter_query['month'], '09-2019') !== false) {
                        $query .= "SUM(CASE WHEN (periode = '09-2019') THEN pembayaran ELSE 0 END) AS September,";
                        $query_bayar .= " September ". $operator ." 0 and";
                    }
                    if (strpos($filter_query['month'], '10-2019') !== false) {
                        $query .= "SUM(CASE WHEN (periode = '10-2019') THEN pembayaran ELSE 0 END) AS Oktober,";
                        $query_bayar .= " Oktober ". $operator ." 0 and";
                    }
                    if (strpos($filter_query['month'], '11-2019') !== false) {
                        $query .= "SUM(CASE WHEN (periode = '11-2019') THEN pembayaran ELSE 0 END) AS November,";
                        $query_bayar .= " November ". $operator ." 0 and";
                    }
                    if (strpos($filter_query['month'], '12-2019') !== false) {
                        $query .= "SUM(CASE WHEN (periode = '12-2019') THEN pembayaran ELSE 0 END) AS Desember,";
                        $query_bayar .= " Desember ". $operator ." 0 and";
                    }
        $query = substr($query, 0, -1);
        $query .= " FROM new_transaksi ";

                    if(!empty($filter_query)){
                        $query .= " WHERE ";
                        if(isset($filter_query['month']) ){
                            $query .="periode IN('". $filter_query['month'] ."')";
                        }

                    }
        $query .="  GROUP BY warga_id
                ) trans ON trans.warga_id=warga.id ";

                if(!empty($filter_query)){
                    $query .= " WHERE ";
                    if(isset($filter_query['rt']) ){
                        $query .=" nort_id IN('". $filter_query['rt'] ."')";
                    }

                    if(count($filter_query['status'])<=1){
                        $query .= " and" . substr($query_bayar, 0, -3);
                    }
                }
        $query .=" ORDER BY nama";

        $data = DB::select(DB::raw($query));
        $data_pembayaran = [];
        $update_data = [];

        $column_table = [
                "nama_pemilik",
                "blok",
                "rt"
            ];

        foreach ($data as $key => $value) {
            $rt_data        = RTNo::where('id', $value->nort_id)->first();
            $rt_data        = $rt_data['no_rt'];

            $data_pembayaran['nama_pemilik'] = $value->nama;
            $data_pembayaran['blok']         = $value->blok;
            $data_pembayaran['rt']           = $rt_data;

            if (strpos($filter_query['month'], '01-2019') !== false) {
                $data_pembayaran['Januari']      = number_format($value->Januari) ;
                array_push($column_table, "Januari");
            }
            if (strpos($filter_query['month'], '02-2019') !== false) {
                $data_pembayaran['Februari']     = number_format($value->Februari);
                array_push($column_table, "Februari");
            }
            if (strpos($filter_query['month'], '03-2019') !== false) {
               $data_pembayaran['Maret']        = number_format($value->Maret);
               array_push($column_table, "Maret");
            }
            if (strpos($filter_query['month'], '04-2019') !== false) {
                $data_pembayaran['April']        = number_format($value->April);
                array_push($column_table, "April");
            }
            if (strpos($filter_query['month'], '05-2019') !== false) {
               $data_pembayaran['Mei']       = number_format($value->Mei);
               array_push($column_table, "Mei");
            }
            if (strpos($filter_query['month'], '06-2019') !== false) {
                $data_pembayaran['Juni']      = number_format($value->Juni);
                array_push($column_table, "Juni");
            }
            if (strpos($filter_query['month'], '07-2019') !== false) {
                $data_pembayaran['Juli']      = number_format($value->Juli);
                array_push($column_table, "Juli");
            }
            if (strpos($filter_query['month'], '08-2019') !== false) {
               $data_pembayaran['Agustus']      = number_format($value->Agustus);
               array_push($column_table, "Agustus");
            }
            if (strpos($filter_query['month'], '09-2019') !== false) {
               $data_pembayaran['September']      = number_format($value->September);
               array_push($column_table, "September");
            }
            if (strpos($filter_query['month'], '10-2019') !== false) {
               $data_pembayaran['Oktober']      = number_format($value->Oktober);
               array_push($column_table, "Oktober");
            }
            if (strpos($filter_query['month'], '11-2019') !== false) {
               $data_pembayaran['November']      = number_format($value->November);
               array_push($column_table, "November");
            }
            if (strpos($filter_query['month'], '12-2019') !== false) {
               $data_pembayaran['Desember']      = number_format($value->Desember);
               array_push($column_table, "Desember");

            }
            
            
            $update_data[] = $data_pembayaran;
        }

        if (!empty($update_data[0])) {
            $column_table = array_keys($update_data[0]);
        } 

        $transsactions['keys'] = $column_table;
        $transsactions['data'] = $update_data;

        return response()->json($transsactions);
    }

    public function pieChart_new(Request $request)
    {
        $input = $request->all();
        $filter = isset($input['data']) ? $input['data'] : [];
        
        $filter_query = array();
        $month = isset($filter['month'])? $filter['month'] : '';
        $year = isset($filter['year'])? $filter['year'] : '';
        if($month !=""){
            $filter_query['month'] = implode("-". $year ."','",$month). "-" .$year ;
        }
        $rt = isset($filter['rt'])? $filter['rt'] : '';
        if($rt !=""){
            $filter_query['rt'] = implode("','",$rt);
        }
        $status = isset($filter['status'])? $filter['status'] : '';
        if($status !=""){
            $filter_query['status'] = $status;
        }
        
        $operator="";
        if(in_array('belum',$filter_query['status']) && in_array('sudah',$filter_query['status'])){

        }elseif (in_array('belum',$filter_query['status'])) {
            $operator = "=";
        }elseif (in_array('sudah',$filter_query['status'])) {
            $operator = ">";
        }


        $query_bayar = "";
        $query = "SELECT warga.nama,nort_id,blok,no_rumah,trans.* FROM warga INNER JOIN (
                    SELECT
                        warga_id, ";
                    if (strpos($filter_query['month'], '01-2019') !== false) {
                        $query .= "SUM(CASE WHEN (periode = '01-2019') THEN pembayaran ELSE 0 END) AS Januari,";
                        $query_bayar .= " Januari ". $operator ." 0 and";
                    }
                    if (strpos($filter_query['month'], '02-2019') !== false) {
                        $query .= "SUM(CASE WHEN (periode = '02-2019') THEN pembayaran ELSE 0 END) AS Februari,";
                        $query_bayar .= " Februari ". $operator ." 0 and";
                    }
                    if (strpos($filter_query['month'], '03-2019') !== false) {
                        $query .= "SUM(CASE WHEN (periode = '03-2019') THEN pembayaran ELSE 0 END) AS Maret,";
                        $query_bayar .= " Maret ". $operator ." 0 and";
                    }
                    if (strpos($filter_query['month'], '04-2019') !== false) {
                        $query .= "SUM(CASE WHEN (periode = '04-2019') THEN pembayaran ELSE 0 END) AS April,";
                        $query_bayar .= " April ". $operator ." 0 and";
                    }
                    if (strpos($filter_query['month'], '05-2019') !== false) {
                        $query .= "SUM(CASE WHEN (periode = '05-2019') THEN pembayaran ELSE 0 END) AS Mei,";
                        $query_bayar .= " Mei ". $operator ." 0 and";
                    }
                    if (strpos($filter_query['month'], '06-2019') !== false) {
                        $query .= "SUM(CASE WHEN (periode = '06-2019') THEN pembayaran ELSE 0 END) AS Juni,";
                        $query_bayar .= " Juni ". $operator ." 0 and";
                    }
                    if (strpos($filter_query['month'], '07-2019') !== false) {
                        $query .= "SUM(CASE WHEN (periode = '07-2019') THEN pembayaran ELSE 0 END) AS Juli,";
                        $query_bayar .= " Juli ". $operator ." 0 and";
                    }
                    if (strpos($filter_query['month'], '08-2019') !== false) {
                        $query .= "SUM(CASE WHEN (periode = '08-2019') THEN pembayaran ELSE 0 END) AS Agustus,";
                        $query_bayar .= " Agustus ". $operator ." 0 and";
                    }
                    if (strpos($filter_query['month'], '09-2019') !== false) {
                        $query .= "SUM(CASE WHEN (periode = '09-2019') THEN pembayaran ELSE 0 END) AS September,";
                        $query_bayar .= " September ". $operator ." 0 and";
                    }
                    if (strpos($filter_query['month'], '10-2019') !== false) {
                        $query .= "SUM(CASE WHEN (periode = '10-2019') THEN pembayaran ELSE 0 END) AS Oktober,";
                        $query_bayar .= " Oktober ". $operator ." 0 and";
                    }
                    if (strpos($filter_query['month'], '11-2019') !== false) {
                        $query .= "SUM(CASE WHEN (periode = '11-2019') THEN pembayaran ELSE 0 END) AS November,";
                        $query_bayar .= " November ". $operator ." 0 and";
                    }
                    if (strpos($filter_query['month'], '12-2019') !== false) {
                        $query .= "SUM(CASE WHEN (periode = '12-2019') THEN pembayaran ELSE 0 END) AS Desember,";
                        $query_bayar .= " Desember ". $operator ." 0 and";
                    }
        $query = substr($query, 0, -1);
        $query .= " FROM new_transaksi ";

                    if(!empty($filter_query)){
                        $query .= " WHERE ";
                        if(isset($filter_query['month']) ){
                            $query .="periode IN('". $filter_query['month'] ."')";
                        }

                    }
        $query .="  GROUP BY warga_id
                ) trans ON trans.warga_id=warga.id ";

                if(!empty($filter_query)){
                    $query .= " WHERE ";
                    if(isset($filter_query['rt']) ){
                        $query .=" nort_id IN('". $filter_query['rt'] ."')";
                    }

                    if(count($filter_query['status'])<=1){
                        $query .= " and" . substr($query_bayar, 0, -3);
                    }
                }
        $query .=" ORDER BY nama";

        $data = DB::select(DB::raw($query));

        $chart_empty = [];
        $chart = [];
        print("<pre>".print_r($data,true)."</pre>");
        foreach ($data as $key => $value) {

        }

        // $belum_bayar = count($chart_empty);
        // $sudah_bayar = count($chart);
        // $total       = count($chart) + count($chart_empty);
    }

    public function pieChart(Request $request)
    {
        $input = $request->all();
        $filter = isset($input['data']) ? $input['data'] : [];
        $query_duplicate = DB::select( DB::raw('SELECT warga_id, count(warga_id) FROM `transaksi` GROUP BY warga_id HAVING COUNT(warga_id) > 1') );
        $wargaid_duplicate = [];
        foreach ($query_duplicate as $val_duplicate) {
            $wargaid_duplicate[] = $val_duplicate->warga_id;
        }

        $data_notin = [];
        $datas = Transsactions::whereIn('warga_id', $wargaid_duplicate)->get();
        foreach ($datas as $rec_warga) {
            $pembayaran = json_decode($rec_warga['pembayaran']);
            $data_notin[] = $rec_warga['id'];
        }

        $chart_empty = [];
        $chart = [];
        $id_notin = json_encode($data_notin);
        $id_notin = str_replace('[', '', str_replace(']', '', $id_notin));
        $filter_data = json_encode($filter['rt']);
        $filter_data = str_replace('[', '', str_replace(']', '', $filter_data));
        $query = empty($filter['rt']) ?  'SELECT a.* FROM `transaksi` a INNER JOIN warga b on a.warga_id = b.id WHERE a.id NOT IN ('.$id_notin.')' : 'SELECT a.* FROM `transaksi` a INNER JOIN warga b on a.warga_id = b.id WHERE a.id NOT IN ('.$id_notin.') AND b.nort_id IN('.$filter_data.')';
        $data = DB::select(DB::raw($query));

        if (!empty($filter['month'])) {
            $filter_month = [];
            foreach ($filter['month'] as $val_month) {
                $filter_month[] = $val_month.'_'.date('y');
            }
        }

        foreach ($data as $key => $value) {
            $pembayaran = json_decode($value->pembayaran, true);
            foreach ($pembayaran as $keys => $values) {
                if (!empty($filter_month)) {
                    if (in_array($keys, $filter_month)) {   
                        if (empty($values)) {
                            $chart_empty[] = $values;
                        } else{
                            $chart[] = $values;
                        }
                    }
                } else {
                    if (empty($values)) {
                        $chart_empty[] = $values;
                    } else{
                        $chart[] = $values;
                    }
                }
                
            }
        }
        $belum_bayar = count($chart_empty);
        $sudah_bayar = count($chart);
        $total       = count($chart) + count($chart_empty);

        $perbandingan_belum = $belum_bayar / $total * 100;
        $perbandingan_sudah = $sudah_bayar / $total * 100;

        if (!empty($filter['status']) && count($filter['status']) == 1 && $filter['status'][0] == 'sudah') {
            $pieChart['data'] = [[
                'value' => $perbandingan_sudah,
                'name' => 'Sudah Bayar'
            ]];
            $pieChart['legend'] = ['Sudah Bayar'];
        } elseif (!empty($filter['status']) && count($filter['status']) == 1 && $filter['status'][0] == 'belum') {
            $pieChart['data'] = [[
                'value' => $perbandingan_belum,
                'name' => 'Belum Bayar'
            ]];
            $pieChart['legend'] = ['Belum Bayar'];
        } elseif (empty($filter['status'])) {
            $pieChart['data'] = [
                'value' => 0,
                'name' => '0'
            ];
            $pieChart['legend'] = [];
        } else{        
            $pieChart['data'] = [
                [
                    'value' => floatval(preg_replace('/[^\d.]/', '', number_format($perbandingan_belum, 2))),
                    'name' => 'Belum'
                ],
                [
                    'value' => floatval(preg_replace('/[^\d.]/', '', number_format($perbandingan_sudah, 2))),
                    'name' => 'Sudah'
                ],
            ];
            $pieChart['legend'] = ['Sudah', 'Belum'];
        }

        $chartResponse['byStatus'] = $pieChart;

        return response()->json($chartResponse);
    }

    public function total_warga(Request $request)
    {
        $filter = $request->query();
        $query_duplicate = DB::select( DB::raw('SELECT warga_id, count(warga_id) FROM `transaksi` GROUP BY warga_id HAVING COUNT(warga_id) > 1') );
        $wargaid_duplicate = [];
        foreach ($query_duplicate as $val_duplicate) {
            $wargaid_duplicate[] = $val_duplicate->warga_id;
        }

        $data = DataWarga::whereNotIn('warga_id', $wargaid_duplicate)->count();
        if (!empty($filter)) {
            $data = DataWarga::whereNotIn('warga_id', $wargaid_duplicate)->where('no_rt', $filter['no_rt'])->count();
        }

        return response()->json($data);
    }

    public function data_rt()
    {
        $data = RTNo::all();

        $data_rt = [];
        foreach ($data as $key => $value) {
            $data_rt['id'][] = $value['id'];
            $data_rt['data'][] = $value['no_rt'];
        }

        return response()->json($data_rt);
    }

    public function reportData()
    {
        $data = Report::all();

        return response()->json($data);
    }
    public function reportDataDetail()
    {
        $data = [];
        $data['data'] = ReportDetail::all();
        $bulan = date("m-Y");

        $total = DB::select( DB::raw("SELECT sum(credit) as credit,sum(debit) as debit, sum(saldo) as saldo FROM `detail_report` WHERE bulan='" . $bulan . "'") );

        foreach ($total as $val) {
            $data['credit'] = $val->credit;
            $data['debit'] = $val->debit;
            $data['saldo'] = $val->debit - $val->credit;
        }
        return response()->json($data);
    }
}
