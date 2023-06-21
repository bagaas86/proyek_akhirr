<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class pengembalian extends Model
{
    use HasFactory;

    // public function detailPeminjaman2($id_pengembalian)
    // {
    //     return DB::table('pengembalian')
    //     ->join('peminjaman', 'peminjaman.id_peminjaman','=','pengembalian.id_peminjaman')
    //     ->join('users', 'peminjaman.id_user','=','users.id')
    //     ->where('pengembalian.id_pengembalian', $id_pengembalian)->first();
    // }

    public function detailPeminjaman($id_peminjaman)
    {
        return DB::table('pengembalian')
        ->join('peminjaman', 'peminjaman.id_peminjaman','=','pengembalian.id_peminjaman')
        ->join('users', 'peminjaman.id_user','=','users.id')
        ->where('pengembalian.id_peminjaman', $id_peminjaman)->first();
    }

    public function tampilPengembalian($dari, $sampai)
    {
        return DB::table('pengembalian')
        ->join('peminjaman','pengembalian.id_peminjaman','=','peminjaman.id_peminjaman')
        ->join('users', 'peminjaman.id_user','=','users.id')
        ->whereBetween('waktu_awal', [$dari, $sampai])
        ->whereBetween('waktu_akhir', [$dari, $sampai])->get();
    }

    public function tampilPengembalians($dari, $sampai, $filter)
    {
        return DB::table('pengembalian')
        ->join('peminjaman','pengembalian.id_peminjaman','=','peminjaman.id_peminjaman')
        ->join('users', 'peminjaman.id_user','=','users.id')
        ->where('peminjaman.jenis_peminjaman', 'LIKE', '%'.$filter.'%')
        // ->where('peminjaman.jenis_peminjaman', $filter)
        ->whereBetween('waktu_awal', [$dari, $sampai])
        ->whereBetween('waktu_akhir', [$dari, $sampai])->get();
    }


    // User
    public function addData($pengembalian)
    {
        DB::table('pengembalian')->insert($pengembalian);
    }

    public function checkPengembalian($id_peminjaman)
    {
        return DB::table('pengembalian')->where('id_peminjaman', $id_peminjaman)->count();
    }

    public function editData($id_peminjaman, $data)
    {
        return DB::table('pengembalian')->where('id_peminjaman', $id_peminjaman)->update($data);
    }

    public function myPengembalian($id)
    {
        return DB::table('pengembalian')
        ->join('peminjaman','pengembalian.id_peminjaman','=','peminjaman.id_peminjaman')
        ->join('users', 'peminjaman.id_user','=','users.id')
        ->orderBy('waktu_pengajuan', 'DESC')->get();
    }



    
}
