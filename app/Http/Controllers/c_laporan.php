<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UpdateBarangRequest;
use App\Models\item;
use App\Models\peminjaman;
use DB;
use File;

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
        $h[0] = "Belum Ada Kelompok Tani";
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
}
