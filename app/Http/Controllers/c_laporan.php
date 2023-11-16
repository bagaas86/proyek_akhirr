<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UpdateBarangRequest;
use App\Models\item;
use App\Models\peminjaman;
use DB;
use File;
use Auth;
use PDF;

class c_laporan extends Controller
{
    public function __construct()
    {
        $this->item = new item();
        $this->peminjaman = new peminjaman();
    }
    public function index()
    {
        return view('admin.laporan.index');
    }

    public function chartPanen()
    {
        $poktan = $this->item->allData();

        $i = 0;
        $h[0] = "Belum Ada BMN";
        $v[0] = 0;
        if($poktan <> null){
            foreach($poktan as $poktans)
            {
                $h[$i] = $poktans->nama_item;
                $v[$i] = $poktans->jumlah_item;
                $i = $i+1;
            }
        }
       
        $data = [
            'h' => $h,
            'v' => $v,
        ];

        return $data;
    }

    public function chartPeminjaman(Request $request)
    {
        $dari = $request->dari." "."00:00:00";
        $sampai = $request->sampai." "."23:59:59";
        $peminjaman= DB::table('peminjaman')
            ->select('jenis_peminjaman', DB::raw('COUNT(*) as jumlah'))
            ->whereBetween('waktu_awal', [$dari, $sampai])
            ->whereBetween('waktu_akhir', [$dari, $sampai])
            ->groupBy('jenis_peminjaman')
            ->get();
        
        $i = 0;
        $h[0] = "Belum Ada Peminjaman";
        $v[0] = 0;
        if($peminjaman <> null){
            foreach($peminjaman as $peminjamans)
            {
                $h[$i] = $peminjamans->jenis_peminjaman;
                $v[$i] = $peminjamans->jumlah;
                $i = $i+1;
            }
        }
       
        $data = [
            'h' => $h,
            'v' => $v,
        ];

        return $data;
    }

    public function tablePeminjaman(Request $request)
    {
  
        $dari = $request->dari." "."00:00:00";
        $sampai = $request->sampai." "."23:59:59";
  
        
        $data =[
            'peminjaman'=> $this->peminjaman->Laporan($dari, $sampai)
        ];


        return view ('admin.laporan.table', $data);
    }

    public function cetakLaporan(Request $request)
    {
     
        $dari = $request->dari." "."00:00:00";
        $sampai = $request->sampai." "."23:59:59";
        $data =[
            'peminjaman'=> $this->peminjaman->Laporan($dari, $sampai)
        ];
        $pdf = PDF::loadView('admin.laporan.cetak', $data)->setPaper('legal', 'landscape');
        $path = public_path('pdf/');
        $fileNameBarang =  'laporan.pdf' ;
        $pdf->save($path . '/' . $fileNameBarang);
        $pdf = public_path('pdf/'.$fileNameBarang);
        return response()->download($pdf);
    }

    public function hari(Request $request)
    {
        $data1 = strtotime($request->bulan1);
        $data2 = strtotime($request->bulan2);
        $kalender = CAL_GREGORIAN;
        $bulan = date('m', $data1);
        $tahun = date('Y', $data1);

        $bulan2 = date('m', $data2);
        $tahun2 = date('Y', $data2);

        $hari = cal_days_in_month($kalender, $bulan, $tahun);
        $hari2 = cal_days_in_month($kalender, $bulan2, $tahun2);
        return $hari2;
    }
}
