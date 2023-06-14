<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\pengguna;
use App\Models\peminjaman;
use App\Models\item;
use App\Models\keranjang;
use App\Models\approval;
use DB;
use Auth;

class c_history extends Controller
{
    public function __construct()
    {
        $this->peminjaman = new peminjaman();
        $this->item = new item();
        $this->keranjang = new keranjang();
        $this->approval = new approval();
    }

    public function index()
    {
        $id = Auth::user()->id;
        $data =[
            'history' => $this->peminjaman->myData($id),
        ];
        return view('user.history.index', $data);
    }

    public function history()
    {
        $id = Auth::user()->id;

        $data =[
            'history' => $this->peminjaman->myData($id),
        ];
        return view('user.history.history', $data);
    }

    public function detailHistory($id_peminjaman)
    {
        $data =[
            'keranjang' => $this->keranjang->detailPeminjaman($id_peminjaman),
            'peminjaman'=> $this->peminjaman->detailPeminjaman2($id_peminjaman),
            'approval' => $this->approval->detailData($id_peminjaman),
            'supir' => $this->keranjang->detailPeminjamanSupir($id_peminjaman),
        ];
        
        return view('user.history.detail', $data);
    }
}
