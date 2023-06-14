<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class pengembalian extends Model
{
    use HasFactory;

    public function detailPeminjaman2($id_pengembalian)
    {
        return DB::table('pengembalian')
        ->join('peminjaman', 'peminjaman.id_peminjaman','=','pengembalian.id_peminjaman')
        ->join('users', 'peminjaman.id_user','=','users.id')
        ->where('pengembalian.id_pengembalian', $id_pengembalian)->first();
    }

    public function detailPeminjaman($id_peminjaman)
    {
        return DB::table('pengembalian')
        ->join('peminjaman', 'peminjaman.id_peminjaman','=','pengembalian.id_peminjaman')
        ->join('users', 'peminjaman.id_user','=','users.id')
        ->orwhere('peminjaman.status_peminjaman', "Pengajuan Diterima")
        ->orwhere('peminjaman.status_peminjaman', "Proses Pengembalian")
        ->orwhere('peminjaman.status_peminjaman', "Pengembalian Ditolak")
        ->orwhere('peminjaman.status_peminjaman', "Pengembalian Diterima")
        ->where('pengembalian.id_peminjaman', $id_peminjaman)->first();
    }


    // User
    public function addData($data)
    {
        DB::table('pengembalian')->insert($data);
    }

    public function checkPengembalian($id_peminjaman)
    {
        return DB::table('pengembalian')->where('id_peminjaman', $id_peminjaman)->count();
    }

    public function editData($id_peminjaman, $data)
    {
        return DB::table('pengembalian')->where('id_peminjaman', $id_peminjaman)->update($data);
    }

    
}
