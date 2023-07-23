<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class peminjaman extends Model
{
    use HasFactory;

    public function allData()
    {
        return DB::table('peminjaman')->get();
    }

    public function addData($data)
    {
        DB::table('peminjaman')->insert($data);
    }

    public function updatePeminjaman($id_peminjaman, $data)
    {
        return DB::table('peminjaman')->where('id_peminjaman', $id_peminjaman)->update($data);
    }
    
    public function checkID()
    {
        return DB::table('peminjaman')->count();
    }
    public function maxIdPeminjaman()
    {
        return DB::table('peminjaman')->max('id_peminjaman');
    }

    public function myData($id)
    {
        return DB::table('peminjaman')->join('approvals', 'peminjaman.id_peminjaman','=','approvals.id_peminjaman')->where('peminjaman.id_user', $id)->orderBy('waktu_pengajuan', 'DESC')->get();
    }


    public function detailPeminjaman2($id_peminjaman)
    {
        return DB::table('peminjaman')->join('users', 'peminjaman.id_user','=','users.id')
        ->where('id_peminjaman', $id_peminjaman)->first();
    }

    public function tampilPeminjamann($dari, $sampai)
    {
        return DB::table('peminjaman')->join('users', 'peminjaman.id_user','=','users.id')
        ->join('approvals', 'peminjaman.id_peminjaman','=','approvals.id_peminjaman')
        ->whereBetween('waktu_awal', [$dari, $sampai])
        ->whereBetween('waktu_akhir', [$dari, $sampai])
        ->get();
    }

    public function tampilPeminjamans($dari, $sampai, $filter)
    {
        return DB::table('peminjaman')->join('users', 'peminjaman.id_user','=','users.id')
        ->join('approvals', 'peminjaman.id_peminjaman','=','approvals.id_peminjaman')
        ->where('peminjaman.jenis_peminjaman', 'LIKE', '%'.$filter.'%')
        // ->where('peminjaman.jenis_peminjaman', $filter)
        ->whereBetween('waktu_awal', [$dari, $sampai])
        ->whereBetween('waktu_akhir', [$dari, $sampai])
        ->get();
    }

  

    public function myPengembalian($id)
    {
        return DB::table('peminjaman')
        ->where('peminjaman.id_user', $id)
        ->where('peminjaman.status_peminjaman', "Pengajuan Diterima")
        ->Orwhere('peminjaman.status_peminjaman', "Proses Pengembalian")
        ->Orwhere('peminjaman.status_peminjaman', "Pengembalian Ditolak")
        ->Orwhere('peminjaman.status_peminjaman', "Pengembalian Diterima")
        ->orderBy('waktu_pengajuan', 'DESC')->get();
    }



    // Dashboard
        // Admin
        public function totalPengajuan_Peminjaman()
        {
            return DB::table('peminjaman')->count();
        }
        public function totalPengajuanDiterima_Peminjaman()
        {
            return DB::table('peminjaman')->where('status_peminjaman', "Pengajuan Diterima")->count();
        }

        // user
        public function totalPengajuan_Saya($id)
        {
            return DB::table('peminjaman')->where('id_user', $id)->count();
        }






   

    

   

    

    

}
