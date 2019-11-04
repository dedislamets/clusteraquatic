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
use DB;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;

class DashboardController extends Controller
{
    public function index()
    {
    	return 1;
    }

    public function import(Request $request)
    {
        
        if ($request->hasFile('file') && $request->input('jenis') == "iuran") {
            dd("masuk iuran");
            $extension = File::extension($request->file->getClientOriginalName());
            if ($extension == "xlsx" || $extension == "xls" || $extension == "csv") {
                $path   = $request->file->getRealPath();
                config(['excel.import.startRow' => 4]);
                $data   = Excel::selectSheetsByIndex(0)->load($path)->get();
                

                //truncate
                $trun_rt = RTNo::truncate();
                $trun_member = Members::truncate();
                $trun_transaction = Transsactions::truncate();
                $rt_data = [];
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
                        $warga_id = Members::where('nama', $value['nama_pemilik'])->first();
                        $warga_id = $warga_id['id'];

                        $bulan_pembayaran = [
                            'jan_19'    => !empty($value['jan_19']) ? $value['jan_19'] : 0,
                            'feb_19'    => !empty($value['feb_19']) ? $value['feb_19'] : 0,
                            'mar_19'    => !empty($value['mar_19']) ? $value['mar_19'] : 0,
                            'apr_19'    => !empty($value['apr_19']) ? $value['apr_19'] : 0,
                            'mei_19'    => !empty($value['mei_19']) ? $value['mei_19'] : 0,
                            'juni_19'   => !empty($value['juni_19']) ? $value['juni_19'] : 0,
                            'jul_19'     => !empty($value['jul19']) ? $value['jul19'] : 0,
                            'agust_19'  => !empty($value['agust_19']) ? $value['agust_19'] : 0,
                            'sep_19'    => !empty($value['sep_19']) ? $value['sep_19'] : 0,
                            'okt_19'    => !empty($value['okt_19']) ? $value['okt_19'] : 0,
                            'nov_19'    => !empty($value['nov_19']) ? $value['nov_19'] : 0,
                            'des_19'    => !empty($value['des_19']) ? $value['des_19'] : 0,
                        ];

                        $model_transaksi             = new Transsactions();
                        $model_transaksi->warga_id   = $warga_id;
                        $model_transaksi->pembayaran = json_encode($bulan_pembayaran);
                        $insert_transaksi            = $model_transaksi->save();

                    }
                }

                if ($insert_rt && $insert_warga && $insert_transaksi) {
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
        }else if ($request->hasFile('file') && $request->input('jenis') == "ppl") {
           
            $extension = File::extension($request->file->getClientOriginalName());
            if ($extension == "xlsx" || $extension == "xls" || $extension == "csv") {
                $path   = $request->file->getRealPath();

                config(['excel.import.startRow' => 5]);
                $data   = Excel::selectSheetsByIndex(0)->load($path)->get();
                 dd($data->toArray());
                // foreach ($data->toArray() as $key => $value) {

                //     foreach ($value as $row) {
                       
                //     }
                // }
                 
            }
        }
    }

    public function dataTransactions(Request $request)
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

        $update_data = [];
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
            $data_warga = Members::where('id', $value->warga_id)->first();
            $nama_pemilik = $data_warga['nama'];
            $blok = $data_warga['blok'];
            $rt_data = RTNo::where('id', $data_warga['nort_id'])->first();
            $rt_data = $rt_data['no_rt'];

            $pembayaran = json_decode($value->pembayaran, true);
            $data_pembayaran = [];
            $i = 0;
            foreach ($pembayaran as $keys => $values) {
                if (!empty($filter_month)) {
                    if (in_array($keys, $filter_month)) {  
                       if (!empty($filter['status']) && count($filter['status']) == 1 && $filter['status'][0] == 'sudah' && !empty($values)) {
                            $data_pembayaran['nama_pemilik'] = $nama_pemilik;
                            $data_pembayaran['blok'] = $blok;
                            $data_pembayaran['rt'] = $rt_data;
                            $data_pembayaran[$keys] = is_numeric($values) ? number_format($values, '2', ',', '.') : $values;
                       }
                       if (!empty($filter['status']) && count($filter['status']) == 1 && $filter['status'][0] == 'belum' && empty($values)) {
                            $data_pembayaran['nama_pemilik'] = $nama_pemilik;
                            $data_pembayaran['blok'] = $blok;
                            $data_pembayaran['rt'] = $rt_data;
                            $data_pembayaran[$keys] = is_numeric($values) ? number_format($values, '2', ',', '.') : $values;
                       }
                       if (empty($filter['status'])) {
                           $data_pembayaran = [];
                       } 

                       if(!empty($filter['status']) && count($filter['status']) == 2){
                            $data_pembayaran['nama_pemilik'] = $nama_pemilik;
                            $data_pembayaran['blok'] = $blok;
                            $data_pembayaran['rt'] = $rt_data;
                            $data_pembayaran[$keys] = is_numeric($values) ? number_format($values, '2', ',', '.') : $values;
                       }

                    }
                }
                $i++;
            }

            if (!empty($data_pembayaran)) {
                $transaksi = $data_pembayaran;
                $update_data[] = $transaksi;
            }

            if (empty($data_pembayaran)) {
                $update_data = [];
            }
        }

        if (!empty($update_data[0])) {
            $column_table = array_keys($update_data[0]);
        } else{
            $column_table = [
                "nama_pemilik",
                "blok",
                "rt",
                "jan_19",
                "feb_19",
                "mar_19",
                "apr_19",
                "mei_19",
                "juni_19",
                "agust_19",
                "sep_19",
                "okt_19",
                "nov_19",
                "des_19"
            ];
        }

        $transsactions['keys'] = $column_table;
        $transsactions['data'] = $update_data;

        return response()->json($transsactions);
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
}
