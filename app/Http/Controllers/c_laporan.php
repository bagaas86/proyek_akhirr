<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UpdateBarangRequest;
use App\Models\item;
use DB;
use File;

class c_laporan extends Controller
{
    public function __construct()
    {
        $this->item = new item();
    }
    public function index()
    {
        return view('admin.laporan.index');
    }

    public function chartBMN()
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
}
