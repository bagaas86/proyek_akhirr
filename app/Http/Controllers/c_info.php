<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\keranjang;
use App\Models\item;
use DB;

class c_info extends Controller
{
    public function __construct()
    {
        $this->keranjang = new keranjang();
        $this->item = new item();
    }

    public function index()
    {
        $data = [
            'item' => $this->item->itemReady(),
        ];

        return view ('admin.info.index' ,$data);
    }

    public function infoDetail($id_item)
    {
        $detail = DB::table('keranjangs')
                ->join('peminjaman', 'keranjangs.id_peminjaman','=','peminjaman.id_peminjaman')   
                ->join('items', 'keranjangs.id_item','=','items.id_item')
                ->where('keranjangs.id_item', $id_item)
                ->get();
        $nama_item = DB::table('items')
                ->where('id_item', $id_item)
                ->first();

        $data = [
            'keranjang' => $detail,
            'identitas' => $nama_item, 
        ];

        return view ('admin.info.detail' ,$data);
    }

    public function dataInfo($id_item)
    {
        $detail = DB::table('keranjangs')
                ->join('peminjaman', 'keranjangs.id_peminjaman','=','peminjaman.id_peminjaman')   
                ->join('items', 'keranjangs.id_item','=','items.id_item')
                ->where('keranjangs.id_item', $id_item)
                ->where('peminjaman.status_peminjaman', "Pengajuan Diterima" )
                ->get();
        $nama_item = DB::table('items')
                ->where('id_item', $id_item)
                ->first();

        $data = [
            'keranjang' => $detail,
            'identitas' => $nama_item, 
        ];

        return view ('admin.peminjaman.info' ,$data);
    }
}
