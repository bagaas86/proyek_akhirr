<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\pengguna;
use App\Models\peminjaman;
use App\Models\item;
use App\Models\keranjang;
use DB;
use Auth;

class c_history extends Controller
{
    public function __construct()
    {
        $this->peminjaman = new peminjaman();
        $this->item = new item();
        $this->keranjang = new keranjang();
    }

    public function index()
    {
        $id = Auth::user()->id;

        $data =[
            'history' => $this->peminjaman->myData($id),
        ];
        return view('user.history.index', $data);
    }

    public function detailHistory($id_peminjaman)
    {
        $data =[
            'keranjang' => $this->keranjang->detailPeminjaman($id_peminjaman),
            'peminjaman'=> $this->peminjaman->detailPeminjaman($id_peminjaman),
        ];
        
        return view('user.history.detail', $data);
    }
}
